<?php

namespace app;

use app\base\CollectionItem;
use app\base\SimpleItem;
use app\base\StructureClass;

class BaseClass extends StructureClass 
{
    const CONFIG_KEY_CONFFIELD = 'confField';
    const CONFIG_KEY_SOME_ITEM_NAME = 'item';
    const CONFIG_KEY_SOME_COLLECTION_NAME = 'collection';

    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function getSomeItem(): SimpleItem {
        return $this->getConfiguredItem(self::CONFIG_KEY_SOME_ITEM_NAME);
    }

    public function getSomeCollectionItem($name): CollectionItem {
        return $this->getConfiguredCollectionItem(self::CONFIG_KEY_SOME_COLLECTION_NAME, $name);
    }

    public function getKey()
    {
        return $this->getConfig()->getValue(self::CONFIG_KEY_CONFFIELD);
    }
}