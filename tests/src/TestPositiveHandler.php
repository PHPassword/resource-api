<?php

namespace PHPassword\Api;


use PHPassword\Api\Handler\ResourceApiHandlerInterface;

class TestPositiveHandler implements ResourceApiHandlerInterface
{
    /**
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     */
    public function create(ApiDataInterface $data): ApiDataInterface
    {
        return new TestEmptyApiData();
    }

    /**
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     */
    public function update(ApiDataInterface $data): ApiDataInterface
    {
        return new TestEmptyApiData();
    }

    /**
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     */
    public function delete(ApiDataInterface $data): ApiDataInterface
    {
        return new TestEmptyApiData();
    }

    /**
     * @param ApiDataInterface $data
     * @return ApiDataInterface
     */
    public function get(ApiDataInterface $data): ApiDataInterface
    {
        return new TestEmptyApiData();
    }
}