<?php

namespace tests\unit;

use app\base\CollectionItem;
use PHPUnit\Framework\TestCase;
use app\BaseClass;
use app\base\SimpleItem;
use app\exceptions\TypeException;
use app\base\Config;

class BaseClassTest extends TestCase
{
    public function testCanGetKey()
    {
        $config = [
            BaseClass::CONFIG_KEY_CONFFIELD => 'helloworld'
        ];
        $class = new BaseClass($config);
        $this->assertEquals('helloworld', $class->getKey());
    }

    public function testCanGetSimpleItem()
    {
        $config = [
            BaseClass::CONFIG_KEY_CONFFIELD => 'helloworld',
            BaseClass::CONFIG_KEY_SOME_ITEM_NAME => new SimpleItem(),
        ];
        $class = new BaseClass($config);
        $this->assertTrue(is_a($class->getSomeItem(), SimpleItem::class));
    }

    public function testCanGetSimpleCollectionItem()
    {
        $config = [
            BaseClass::CONFIG_KEY_CONFFIELD => 'helloworld',
            BaseClass::CONFIG_KEY_SOME_ITEM_NAME => new SimpleItem(),
            BaseClass::CONFIG_KEY_SOME_COLLECTION_NAME => [
                'item1' => new CollectionItem()
            ]
        ];
        $class = new BaseClass($config);
        $this->assertTrue(is_a($class->getSomeCollectionItem('item1'), CollectionItem::class));
    }

    public function testCanGetConfiguredItem()
    {
        $configData = [
            'default' => 'test',
            'configuredItem' => new SimpleItem(),
        ];
        $class = new BaseClass($configData);
        $this->assertTrue(is_a($class->getConfiguredItem('configuredItem'), SimpleItem::class));
    }

    public function testCantGetConfiguredItemIfWrongClass()
    {
        $configData = [
            'default' => 'test',
            'configuredItem' => new \DateTime(),
        ];
        $class = new BaseClass($configData);
        $this->expectException(TypeException::class);
        $class->getConfiguredItem('configuredItem');
    }

    public function testCanGetConfiguredCollectonItem()
    {
        $configData = [
            'default' => 'test',
            'collection' => [
                'item1' => new CollectionItem()
            ]
        ];
        $class = new BaseClass($configData);
        $this->assertTrue(is_a($class->getConfiguredCollectionItem('collection', 'item1'), CollectionItem::class));
    }

    public function testCantGetConfiguredCollectionItemIfWrongClass()
    {
        $configData = [
            'default' => 'test',
            'collection' => [
                'item1' => new \DateTime()
            ]
        ];
        $class = new BaseClass($configData);
        $this->expectException(TypeException::class);
        $class->getConfiguredCollectionItem('collection', 'item1');
    }

    public function testCanGetConfig()
    {
        $configData = [
            'default' => 'test',
            'collection' => [
                'item1' => new \DateTime()
            ]
        ];
        $class = new BaseClass($configData);
        $this->assertTrue(is_a($class->getConfig(), Config::class));
    }
}