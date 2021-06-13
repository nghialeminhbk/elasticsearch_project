<?php

require_once('connect.php');

if(!$exist){
    throw new Exception("Index - companydatabase đang không tồn tại");
}else{
    $search = $_GET['suggest']??'';
    $params = [
        'index'=>'companydatabase',
        'type'=> 'employees',
        'body' => [
            'query' => [
                'bool' => [
                    'should' => [
                        'wildcard' => [
                            'FirstName' => [
                                'value' => $search.'*'
                            ]
                        ]
                    ]
                ]
            ],
            'aggs' => [
                'auto_complete' => [
                    'terms' => [
                        'field' => 'FirstName.keyword',
                        'size' => 10,
                        'order' => [
                            '_key' => 'desc'
                        ]
                    ]
                ]
            ]
        ]
    ];
    $rs = $client->search($params);
    // echo "<pre>";
    // var_dump($rs['hits']['hits']);
    // echo "</pre>";
    $items = $rs['hits']['hits'];
    echo "<ul>";
    echo "<li onclick=\"choose('$search')\" id='user--input' ><span>$search</span></li>";
    foreach($items as $item){ ?>
        <li onclick="choose('<?=$item['_source']['FirstName']?> <?=$item['_source']['LastName']?>')"><?=$item['_source']['FirstName']?> <?=$item['_source']['LastName']?></li>
    <?php }
    echo "</ul>";
}
?>