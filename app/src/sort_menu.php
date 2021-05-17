<?php
    require_once('../app/src/database.php');

    class SortMenu{
        protected $data;

        public function requestData(){
            $db=new DB();
            $db -> connect();
            $db -> prepareQuery('SELECT * FROM horeaca_menu_dishes');
            $db -> executeQuery();
            $this -> data['food']=$db -> getResults();
            $db -> prepareQuery('SELECT * FROM horeaca_menu_drinks');
            $db -> executeQuery();
            $this -> data['drinks']=$db -> getResults();
            $db -> terminate();
        }
        public function sortData(){
            $data=$this -> data;
            $food;
            $drinks;
    
            foreach($data['food'] as $dish){
                switch((int)$dish['courses_id']){
                    case 5:
                        $food['lunch'][]=$dish;
                    break;
                    case 6:
                        $food['diner'][]=$dish;
                    break;
                    case 7:
                        $food['breakfast'][]=$dish;
                    break;
                    case 8:
                        $food['dessert'][]=$dish;
                    break;
                }
            }
            foreach($data['drinks'] as $drink){
                switch((int)$drink['types_id']){
                    case 1:
                        $drinks['hot_beverages'][]=$drink;
                    break;
                    case 2:
                        $drinks['alcohol'][]=$drink;
                    break;
                    case 3:
                        $drinks['soda'][]=$drink;
                    break;
                }
            }
    
            unset($this -> data);
            $this -> data=array('food' => $food, 'drinks' => $drinks);
        }
    }
?>