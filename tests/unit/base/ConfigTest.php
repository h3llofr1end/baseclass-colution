<?php

namespace tests\unit\base;

use app\base\CollectionItem;
use app\base\Config;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testCanCreateAndGetValue()
    {
        $configData = [
            'myValue' => 'helloworld',
            'otherValue' => 'test'
        ];
        $config = new Config($configData);
        $this->assertEquals('helloworld', $config->getValue('myValue'));
        $this->assertEquals('test', $config->getValue('otherValue'));
    }

    public function testCantGetValueNonExistingKey()
    {
        $configData = [
            'myValue' => 'helloworld',
        ];
        $config = new Config($configData);
        $this->expectException(InvalidArgumentException::class);
        $config->getValue('otherValue');
    }

    public function testCanGetCollectionItem()
    {
        $configData = [
            'myValue' => 'helloworld',
            'collection' => [
                'item1' => new CollectionItem()
            ]
        ];
        $config = new Config($configData);
        $this->assertNotNull($config->getCollectionItem('collection', 'item1'));
        $this->assertTrue(is_a($config->getCollectionItem('collection', 'item1'), CollectionItem::class));
    }

    public function testCantGetCollectionItemIfSendWrongCollectionKeyname()
    {
        $configData = [
            'myValue' => 'helloworld',
            'collection' => [
                'item1' => new CollectionItem()
            ]
        ];
        $config = new Config($configData);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Key not found in config');
        $value = $config->getCollectionItem('collection2', 'item1');
    }

    public function testCantGetCollectionItemIfSendWrongItemKeyname()
    {
        $configData = [
            'myValue' => 'helloworld',
            'collection' => [
                'item1' => new CollectionItem()
            ]
        ];
        $config = new Config($configData);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Key not found in collection');
        $config->getCollectionItem('collection', 'item2');
    }
}