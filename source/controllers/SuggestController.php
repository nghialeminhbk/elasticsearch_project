<?php 
    class SuggestController extends Controller{
        function __construct(){
           
        }

        function index($search){
            $model = $this->model('SuggestModel');
            $this->view("suggestion_view", ['rs' => $model->getResult($search),
                                            'search' => $search]);
        }
    }

?>