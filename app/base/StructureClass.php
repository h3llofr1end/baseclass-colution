<?php

namespace app\base;

use app\exceptions\TypeException;

abstract class StructureClass
{
    private $config;

    abstract function getSomeItem();
    abstract function getSomeCollectionItem($name);
    abstract function getKey();

    public function __construct($config)
    {
        $this->config = new Config($config);
    }

    /**
     * @param string $configKey
     * 
     * @throw InvalidArgumentException
     */
    final public function getConfiguredItem($configKey)
    {
        try {
            $value = $this->getConfig()->getValue($configKey);
            if(is_a($value, SimpleItem::class)) {
                return $value;
            }
            throw new TypeException('Item is not a SimpleItem class');
        } catch (\InvalidArgumentException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $configKey
     * @param string $name
     * 
     * @throw InvalidArgumentException
     */
    final public function getConfiguredCollectionItem($configKey, $name)
    {
        try {
            $collectionItem = $this->getConfig()->getCollectionItem($configKey, $name);
            if(is_a($collectionItem, CollectionItem::class)) {
                return $collectionItem;
            }
            throw new TypeException('Item is not a CollectionItem class');
        } catch (\InvalidArgumentException $e) {
            return $e->getMessage();
        }
    }

    /**
     * Return config item
     * @return Config
     */
    final public function getConfig()
    {
        return $this->config;
    }
}