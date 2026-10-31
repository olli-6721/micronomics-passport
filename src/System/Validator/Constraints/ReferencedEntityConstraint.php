<?php

namespace Micronomics\Passport\System\Validator\Constraints;

use Micronomics\Passport\System\Validator\ReferencedEntityValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ReferencedEntityConstraint extends Constraint
{
    public function __construct(
        protected(set) string $clientClass,
        protected(set) string $entityName,
        mixed $options = null, ?array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
    }

    public function validatedBy(): string
    {
        return ReferencedEntityValidator::class;
    }
}
