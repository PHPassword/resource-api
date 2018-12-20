<?php

namespace PHPassword\Api;


interface ApiDataInterface
{
    /**
     * @param string $name
     * @return mixed
     */
    public function get(string $name);

    /**
     * @return array
     */
    public function getAll(): array;
}