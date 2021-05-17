<?php
    class Core{
        private $url;
        private $currentController='Pages';
        private $currentMethod='home';
        private $params=[];

        public function __construct(){
            $url=$this -> getUrl();

            if(isset($url[0])){
                if(file_exists('../app/controller/'.$url[0].'.php')){
                    $this -> currentController= ucwords($url[0]);

                    unset($url[0]);
                }
            }
            // else{
            //     header('location: '.ROOT.'pages/home');
            // }

            require_once('../app/controller/'.strtolower($this -> currentController).'.php');
            
            if(isset($url[1])){
                if(method_exists($this -> currentController, $url[1])){
                    $this -> currentMethod=$url[1];

                    unset($url[1]);
                }
            }

            $this -> currentController= new $this -> currentController;
            $this -> params=$url ? array_values($url):[];

            call_user_func_array([$this -> currentController, $this -> currentMethod], $this -> params);
        }
        public function getUrl(){
            if(isset($_GET['url'])){
                $url=rtrim($_GET['url'], '/' );
                $url=filter_var($url, FILTER_SANITIZE_URL);
                $url=explode('/', $url);

                return $url;
            }
        }
    }
?>