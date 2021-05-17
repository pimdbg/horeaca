<?php
    require_once('../app/src/sort_menu.php');
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    class UpdateJson extends SortMenu{
        private $file;
        private $filePath='js/schema.json';

        public function __construct(){
            $this -> requestData();
            $this -> sortData();
            $this -> getJson();
            $this -> updateMenu();
            $this -> updateDetails();
            $this -> uploadFile();
        }
        public function getJson(){
            $json=fopen($this -> filePath, 'r');
            $file='';

            while(!feof($json)){
                $file.=fgets($json);
            }
            fclose($json);

            $this -> file=(array)json_decode($file);
        }
        public function updateMenu(){
            $file=$this -> file;
            $data=$this -> data;
            $menu=(array)$file['hasMenu'];
            $countCourse=0;
            $countDish;

            foreach($data['food'] as $courseKey => $courseValue){
                $countDish=0;
                foreach($courseValue as $dish){
                    $array[$countDish]=array(
                        '@type' => 'MenuItem', 
                        'name' => $dish['name']
                    );
                    $countDish++;
                }
                $menu['hasMenuSection'][$countCourse]=array(
                    '@type' => 'MenuSection',
                    'name' => $courseKey,
                    'hasMenuItem' => $array
                );

                unset($array);
                $countCourse++;
            }

            $this -> file['hasMenu']=$menu;
        }
        public function updateDetails(){
            $file=$this -> file;
            unset($this -> file);

            $file['name']=SITENAME;
            $file['acceptsReservations']=ROOT.'pages/reservations';
            $file['image']=ROOT.'public/img/logo_horeaca.png';
            $file['hasMenu']['id']=ROOT.'pages/menu';
            $file['openingHours']='Tu,We,Th,Fr,Sa 11:00-21:00, Su 11:00-18:00';
            $file['hasMenu']=$file['hasMenu'];
            
            $this -> file["@context"]='https://schema.org';
            $this -> file['@type']=$file["@type"]='Restaurant';
            $this -> file['name']=$file['name']=SITENAME;

            foreach($file as $fileKey => $fileValue){
                $this -> file[$fileKey]=$fileValue;
            }
        }
        public function uploadFile(){
            $json=fopen($this -> filePath, 'r+');
            $file=json_encode($this -> file);
            fwrite($json, $file);

            echo '<pre>';
            var_dump($this -> file);
            echo '</pre>';
            echo '<br>';
            echo $file;
        }
    }
?>