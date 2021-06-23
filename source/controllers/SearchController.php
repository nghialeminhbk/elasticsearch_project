<?php 
    class SearchController extends Controller{
        function __construct(){
           
        }

        function index($search, $page = 1, $limits = 6){
            $model = $this->model('SearchModel');
            $this->view("search_view", ['rs' => $model->getResult($search, $page, $limits), 
                                        'limits' => $limits,
                                        'currPage'=> $page]);
        }
    }
?>