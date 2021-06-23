<?php 
    class App{
        protected $controller = "Home";
        protected $action = "index";
        protected $params = [];
        public function __construct(){
            //Array ( [0] => Homes [1] => SayHi [2] => 1 [3] => 23 )
            $arr = $this->UrlProcess();

            // Xu ly controller
            if(!empty($arr)){
                if(file_exists("./source/controllers/".$arr[0].".php")){
                    $this->controller = $arr[0];
                    unset($arr[0]); // loai bo controller khoi mang -> de lay params ben duoi
                }
            }
           

            require_once "./source/controllers/".$this->controller.".php";
            $this->controller = new $this->controller;

            // Xu ly action
            if(isset($arr[1])){
                if(method_exists($this->controller, $arr[1])){
                    $this->action = $arr[1];
                }
                unset($arr[1]); // loai bo action khoi mang
            }

            //Xu li params
            $this->params = $arr?array_values($arr):[];
            
            call_user_func_array([$this->controller, $this->action], $this->params);

        }

        function UrlProcess(){
            if(isset($_GET["url"])){
                return explode("/",filter_var(trim($_GET["url"], "/")));
            }

        }
    }
?>