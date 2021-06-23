<?php 
    class Controller{
        function model($model){
            require_once "./source/models/".$model.".php";
            return new $model;
        }

        function view($view, $data=[]){
            require_once "./source/views/".$view.".php";
        }
    }
?>
