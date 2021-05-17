<?php    
    require_once('../app/src/fpdf182/fpdf.php');
    require_once('../app/src/sort_menu.php');

    class Pdf extends SortMenu{
        private $pdf;

        public function __construct(){
            $this -> requestData();
            $this -> sortData();
            $this -> createPDF();
        }
        public function createPDF(){            
            $this -> pdf = new FPDF();
            
            $this -> pdf -> setTitle('horeaca_menu');
            $this -> makePage('food');
            $this -> makePage('drinks');

            $this -> pdf->Output();
        }
        public function makePage($category){
            $this -> pdf -> AddPage();
            $this -> pdf->SetFont('Arial','B',16);
            $this -> pdf -> setFontSize(35);
            $this -> pdf->Cell(40,10, $this -> fixTitle($category));
            $this -> pdf -> Ln();
            $this -> pdf -> image(ROOT.'img/logo_horeaca.png', null, null, 100, null);
            $this -> pdf -> Ln();

            foreach($this -> data[$category] as $typeName => $typeValue){            
                $this -> pdf -> setFontSize(25);
                $this -> pdf->Cell(40,10, $this -> fixTitle($typeName));
                $this -> pdf -> Ln();
                $this -> pdf -> Ln();
                $this -> pdf -> setFontSize(16);

                foreach($typeValue as $dishKey => $dishValue){
                    $this -> pdf->Cell(90,10,$dishValue['name']);
                    $this -> pdf->Cell(40,10, ' | '.$dishValue['price']);
                    $this -> pdf -> Ln();
                }
                $this -> pdf -> Ln();
            }
        }
        public function fixTitle($title){
            switch($title){
                case 'breakfast':
                    $title='ontbijt';
                break;
                case 'hot_beverages':
                    $title='warme dranken';
                break;
                case 'soda':
                    $title='fris';
                break;
                case 'food':
                    $title='gerechten';
                break;
                case 'drinks':
                    $title='dranken';
                break;
            }
            $title=ucwords($title);
            
            return $title;
        }
    }
?>