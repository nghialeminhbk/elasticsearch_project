<?php

require_once "./vendor/autoload.php";
 use Elasticsearch\ClientBuilder;
    $hosts = [
        [   
            'host' => 'localhost',
            'port' => '9200',
            'scheme' => 'http'
        ]
    ];

$client = ClientBuilder::create()->setHosts($hosts)->build();

$exist = $client->indices()->exists(['index'=>'companydatabase']);

?>