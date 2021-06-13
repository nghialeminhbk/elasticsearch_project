<?php

require_once('connect.php');

if(!$exist){
    throw new Exception("Index - companydatabase đang không tồn tại");
}else{
    $search = $_GET['search']??'';
    $currPage = $_GET['page']??1;
    $limits = 10;
    if($search != ''){
        $params = [
            'index'=>'companydatabase',
            'type'=> 'employees',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $search,
                        'fields' => ["FirstName", "LastName", "Interests", "Address", "MaritalStatus", "Designation"],
                        "fuzziness" => 10
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
        $rs = $client->search($params);
        // result of search query
        $items = null;
        $total = $rs['hits']['total']['value'];
        // total pages results
        $totalPages = ceil($total/$limits);
        // time response
        $time_query = $rs['took']/1000;

        echo "<p class='notification'>Number of results returned: $total ( $time_query seconds)</p><br><br><br>";
        if($total > 0){
            $items = $rs['hits']['hits'];
            foreach($items as $item){
                $FirstName = $item['_source']['FirstName'];
                $LastName = $item['_source']['LastName'];
                $Address = $item['_source']['Address'];
                $Interests = $item['_source']['Interests'];
                $mariage = $item['_source']['MaritalStatus'];
                $age = $item['_source']['Age'];
                $salary = $item['_source']['Salary'];
                $position = $item['_source']['Designation'];
                $sex = $item['_source']['Gender'];
                if(isset($item['highlight']['FirstName'])){
                    $FirstName = implode(" ",$item['highlight']['FirstName']);
                }
                if(isset($item['highlight']['LastName'])){
                    $LastName = implode(" ",$item['highlight']['LastName']);
                }
                if(isset($item['highlight']['Interests'])){
                    $Interests = implode(" ",$item['highlight']['Interests']);
                }
                if(isset($item['highlight']['Address'])){
                    $Address = implode(" ",$item['highlight']['Address']);
                }
                if(isset($item['highlight']['Designation'])){
                    $position = implode(" ",$item['highlight']['Designation']);
                }
                echo " <div class='a_part_content_search'>
                         <h2 class='name'>$FirstName $LastName</h2>
                         <p class=''><span>Gender:</span> $sex</p>
                         <p class=''><span>Mariage:</span> $mariage</p>
                         <p class=''><span>Position:</span> $position</p>
                         <p class=''><span>Salary:</span> $salary</p>
                         <p class='Address'><span>Address:</span> $Address</p>
                         <p class='Interests'><span>Interests:</span> $Interests</p>
                       </div>";
            }
            echo '<div class="pagination">';
            require_once('pagination.php');
            echo '</div>';
        }else{
            echo 'No result!';
        }
    }
}
?>
