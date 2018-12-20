<?php

namespace PHPassword\Api;


use PHPassword\Api\Handler\ResourceApiHandlerInterface;

class TestNegativeHandler implements ResourceApiHandlerInterface
{
    /**
     * @param ApiDataInterface $data
     * @throws \Exception
     */
    public function create(ApiDataInterface $data): ApiDataInterface
    {
        throw new \Exception('Test');
    }

    /**
     * @param ApiDataInterface $data
     * @throws \Exception
     */
    public function update(ApiDataInterface $data): ApiDataInterface
    {
        throw new \Exception('Test');
    }

    /**
     * @param ApiDataInterface $data
     * @throws \Exception
     */
    public function delete(ApiDataInterface $data): ApiDataInterface
    {
        throw new \Exception('Test');
    }

    /**
     * @param ApiDataInterface $data
     * @throws \Exception
     */
    public function get(ApiDataInterface $data): ApiDataInterface
    {
        throw new \Exception('Test');
    }
}