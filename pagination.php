<?php
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
        echo '<button class="btn btn-outline-dark" onclick="_search('.$nextPage.')"><i class="fas fa-chevron-right"></i></button>';
    }
    
?>