<?php

use app\base\SimpleItem;
use app\base\CollectionItem;

$config = [
    'confField' => 'value',
    'nestedField' => [
        'key' => 'foo'
    ],
    'item' => [
        new SimpleItem()
    ],
    'collection' => [
        'item1' => new CollectionItem(),
        'item2' => new CollectionItem(),
    ]
];

$obj = new MyClass($config);
$key = $obj->getKey();
$item = $obj->getSomeCollectionItem('item1');