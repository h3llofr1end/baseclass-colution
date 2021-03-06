<?php

namespace app\base;

class Config
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getValue($key)
    {
        if(isset($this->config[$key])) {
            return $this->config[$key];
        }
        throw new \InvalidArgumentException('Key not found in config');
    }

    public function getCollectionItem($key, $name)
    {
        $collection = $this->getValue($key);
        if(isset($collection[$name])) {
            return $collection[$name];
        }
        throw new \InvalidArgumentException('Key not found in collection');
    }
}