<?php
    class SearchModel extends DB{
        function getResult($search, $page = 1, $limits){
            $currPage = $page;
            if($search != ''){
                $params = [
                    'index'=>'data',
                    'type'=> 'employees',
                    'body' => [
                        'query' => [
                            'multi_match' => [
                                'query' => $search,
                                'fields' => ["FirstName", "LastName", "Interests", "Address", "MaritalStatus", "Designation"],
                                "fuzziness" => "AUTO"
                                ]
                            ],
                            'highlight' =>[
                                'pre_tags' => ["<strong style='color: #f18121'>"],
                                'post_tags' => ["</strong>"],
                                'fields' => [
                                    'Designation' => new stdClass(),
                                    'FirstName' => new stdClass(),
                                    'LastName' => new stdClass(),
                                    'Interests' => new stdClass(),
                                    'Address' => new stdClass()
                                ]
                            ],
                            'from'=> ($currPage-1)*$limits,
                            'size' => $limits
                    ]
                ];
                $rs = $this->client->search($params);
                return $rs;
            }
        }
    }

?>