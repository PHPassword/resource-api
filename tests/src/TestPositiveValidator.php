<?php

namespace PHPassword\Api;


use PHPassword\Api\Validator\DataValidatorInterface;

class TestPositiveValidator implements DataValidatorInterface
{
    /**
     * @param string $action
     * @param ApiDataInterface $data
     * @return bool
     */
    public function validate(string $action, ApiDataInterface $data): void
    {

    }
}