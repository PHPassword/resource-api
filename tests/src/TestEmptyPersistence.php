<?php

namespace PHPassword\Api;


class TestEmptyPersistence implements PersistenceInterface
{
    public function create(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $data;
    }

    public function update(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $data;
    }

    public function delete(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $data;
    }

    public function get(string $type, ApiDataInterface $data): ApiDataInterface
    {
        return $data;
    }


}