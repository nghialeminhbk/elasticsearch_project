<?php 
    class SuggestModel extends DB{
        function getResult($search){
            $params = [
                'index'=>'data',
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
            $rs = $this->client->search($params);
            return $rs;
            }
        }

?>