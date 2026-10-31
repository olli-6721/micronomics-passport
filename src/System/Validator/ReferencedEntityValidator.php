<?php

namespace Micronomics\Passport\System\Validator;

use Micronomics\Passport\Framework\Client\AbstractClient;
use Micronomics\Passport\Framework\Exception\InternalException;
use Micronomics\Passport\System\Validator\Constraints\ReferencedEntityConstraint;
use Micronomics\Passport\System\Validator\Exception\ReferencedEntityNotFoundException;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class ReferencedEntityValidator extends ConstraintValidator
{
    protected array $clients = [];

    public function __construct(
        #[AutowireIterator('framework.client')] iterable $clients
    ){
        foreach($clients as $client){
            $this->clients[$client::class] = $client;
        }
    }

    /**
     * @param mixed $value
     * @param ReferencedEntityConstraint $constraint
     * @return void
     * @throws InternalException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if(!is_string($value) || !Uuid::isValid($value)) {
            throw new UnexpectedValueException(
                value: $value,
                expectedType: 'string<uuid>'
            );
        }

        /**
         * @var AbstractClient|null $client
         */
        $client = $this->clients[$constraint->clientClass] ?? null;

        if($client === null) {
            throw new InternalException(
                message: sprintf("No client found for class '%s' (entity: %s::%s)",
                    $constraint->clientClass,
                    $constraint->entityName,
                    $value
                )
            );
        }

        if($client->find($constraint->entityName, $value) === null){
            throw new ReferencedEntityNotFoundException(
                entityName: $constraint->entityName,
                entityId: $value,
            );
        }
    }
}
