<?php

namespace PHPassword\Api;


use PHPassword\Api\Validator\DataValidatorInterface;

class TestNegativeValidator implements DataValidatorInterface
{
    /**
     * @param string $action
     * @param ApiDataInterface $data
     * @throws \Exception
     */
    public function validate(string $action, ApiDataInterface $data): void
    {
        throw new \Exception('Test');
    }
}