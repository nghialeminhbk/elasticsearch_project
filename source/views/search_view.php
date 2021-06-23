<?php
// result of search query
$rs = $data['rs'];
$limits = $data['limits'];
$currPage = $data['currPage'];
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
        echo '<button class="btn btn-outline-dark mr-1" onclick="_search('.'1'.')"><i class="fas fa-angle-double-left"></i></button>';
        if($currPage>2){
            $prevPage = $currPage-1;
            echo '<button class="btn btn-outline-dark mr-1" onclick="_search('.$prevPage.')"><i class="fas fa-chevron-left"></i></button>';
        }
        for($i = 1; $i<=$totalPages; $i++){
            if($currPage == $i){
                echo '<button class="btn btn-dark mr-1" disabled>'.$currPage.'</button>';
            }else if($i >= $currPage - 1 && $currPage + 1 >= $i){
                echo '<button class="btn btn-outline-dark mr-1" onclick="_search('.$i.')">'.$i.'</button>';
            }
        }
        if($currPage <= $totalPages - 2){
            $nextPage = $currPage + 1;
            echo '<button class="btn btn-outline-dark mr-1" onclick="_search('.$nextPage.')"><i class="fas fa-chevron-right"></i></button>';
        }
        echo '<button class="btn btn-outline-dark" onclick="_search('.$totalPages.')"><i class="fas fa-angle-double-right"></i></button>';
    echo '</div>';
}else{
    echo 'No result!';
}
?>