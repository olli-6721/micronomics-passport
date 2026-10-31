<?php

namespace Micronomics\Passport\System\Validator\Exception;

use Symfony\Component\Validator\Exception\ValidatorException;

class ReferencedEntityNotFoundException extends ValidatorException
{
    public function __construct(
        protected string $entityName,
        protected string $entityId,

    )
    {
        parent::__construct(
            message: sprintf("Referenced entity '%s::%s' not found.", $this->entityName, $entityId)
        );
    }
}
