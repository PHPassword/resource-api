<?php

namespace PHPassword\Api\Handler;


use PHPassword\Api\ApiDataInterface;

interface ResourceApiHandlerInterface
{
    /**
     * @param ApiDataInterface $data
     * @param $type
     * @return ApiDataInterface
     */
    public function create(ApiDataInterface $data): ApiDataInterface;

    /**
     * @param ApiDataInterface $data
     * @param $type
     * @return ApiDataInterface
     */
    public function update(ApiDataInterface $data): ApiDataInterface;

    /**
     * @param ApiDataInterface $data
     * @param $type
     * @return ApiDataInterface
     */
    public function delete(ApiDataInterface $data): ApiDataInterface;

    /**
     * @param ApiDataInterface $data
     * @param $type
     * @return ApiDataInterface
     */
    public function get(ApiDataInterface $data): ApiDataInterface;
}