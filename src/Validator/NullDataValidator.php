<?php

namespace PHPassword\Api\Validator;


use PHPassword\Api\ApiDataInterface;

class NullDataValidator implements DataValidatorInterface
{
    /**
     * @param string $action
     * @param ApiDataInterface $data
     */
    public function validate(string $action, ApiDataInterface $data): void
    {

    }
}