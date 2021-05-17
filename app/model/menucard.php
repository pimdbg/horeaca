<?php
    require_once('../app/src/sort_menu.php');

    class Menucard extends SortMenu {
        protected $data;

        public function __construct(){
            $this -> requestData();
            $this -> sortData();
            $this -> compileData();
        }
        public function compileData(){
            $data=$this -> data;
            $food='';
            $drinks='';

            foreach($data as $typeKey => $typeValue){
                $menu;
                foreach($typeValue as $courseKey => $courseValue){
                    $key=$courseKey;
                    $menu[$typeKey][$courseKey]='<table>';
                    foreach($courseValue as $xyz){
                        $lengthDecimal=strlen(explode('.',$xyz['price'])[1]);
                        $menu[$typeKey][$courseKey].='
                        <tr>
                            <td>'.$xyz['name'].'</td>
                            <td>'.(($lengthDecimal==2)?$xyz['price'] : $xyz['price'].'0').'</td></tr>';
                    }
                    $menu[$typeKey][$courseKey].='</table>';
                }
            }
            unset($this -> data);
            $this -> data['food']=$menu['food'];
            $this -> data['drinks']=$menu['drinks'];
        }
        public function getData(){
            return $this -> data;
        }
    }
?>