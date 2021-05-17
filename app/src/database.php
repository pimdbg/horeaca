<?php
    class Db {
        private $db;
        private $query;

        public function connect(){
            try{
                $this -> db=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USERNAME, DB_PASSWORD, 
                    array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
            }
            catch(PDOException $e){
                echo $e -> getMessage();
            }
        }
        public function prepareQuery($query){
            $this -> query=$this -> db -> prepare($query);
        }
        public function bindParam($placeholder, $value){
            $this -> query -> bindParam($placeholder, $value);
        }
        public function executeQuery(){
            $this -> query -> execute();
        }
        public function getResults(){
            return $this -> query -> fetchAll(PDO::FETCH_ASSOC);
        }
        public function terminate(){
            $this -> db=null;
        }
    }
?>