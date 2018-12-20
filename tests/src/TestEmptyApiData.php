<?php

namespace PHPassword\Api;


class TestEmptyApiData implements ApiDataInterface
{
    public function get(string $name)
    {
        return null;
    }

    public function getAll(): array
    {
        return [];
    }

}