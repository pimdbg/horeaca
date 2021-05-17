<?php
    class Master{
        protected $nav;
        protected $footer;
        
        public function createNav(){
            $this -> nav='
            <nav>
                <ul>
                    <li><a href="'.ROOT.'pages/home">Home</a></li>
                    <li><a href="'.ROOT.'pages/menu">Menukaart</a></li>
                    <li><a href="'.ROOT.'pages/reservations">Reserveren</a></li>
                    <li><a href="'.ROOT.'pages/contact">Contact</a></li>
                </ul>
                <span id="navButton"><i class="fas fa-bars"></i></span>
            </nav>';
        }
        public function createFooter(){
            $this -> footer='
            <footer>
                <p>'.SITENAME.'</p>
                <ul>
                    <li><a href="'.ROOT.'pages/home">Home</a></li>
                    <li><a href="'.ROOT.'pages/menu">Menukaart</a></li>
                    <li><a href="'.ROOT.'pages/reservations">Reserveren</a></li>
                    <li><a href="'.ROOT.'pages/contact">Contact</a></li>
                </ul>
            </footer>';
        }
    }
?>