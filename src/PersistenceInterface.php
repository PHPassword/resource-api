<?php

namespace PHPassword\Api;


interface PersistenceInterface
{
    public function create(string $type, ApiDataInterface $data): ApiDataInterface;

    public function update(string $type, ApiDataInterface $data): ApiDataInterface;

    public function delete(string $type, ApiDataInterface $data): ApiDataInterface;

    public function get(string $type, ApiDataInterface $data): ApiDataInterface;
}