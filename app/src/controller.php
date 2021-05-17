<?php
    class Controller{
        protected $message;
        protected $model;
        
        public function model($model){
            require_once('../app/model/'.$model.'.php');

            preg_match('/_[a-z]/', $model, $underscores);
            if(!empty($underscores)){
                $data='';

                foreach($underscores as $underscore){
                    $trim=ucwords(trim($underscore, '_'));
                    $data.=preg_replace('/'.$underscore.'/', $trim, $model);
                }
                $model=$data;
            }

            $this -> model=new $model();
        }
        public function view($view, $data){
            if(file_exists('../app/view/'.$view.'.php')){
                require_once('../app/view/'.$view.'.php');

                $structure=new Structure($data);
            }else{
                die('View is not found');
            }
        }
    }
?>