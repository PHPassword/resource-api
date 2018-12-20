<?php

namespace PHPassword\Api\Validator;


use PHPassword\Api\ApiDataInterface;

interface DataValidatorInterface
{
    /**
     * @param ApiDataInterface $data
     * @return bool
     */
    public function validate(string $action, ApiDataInterface $data): void;
}