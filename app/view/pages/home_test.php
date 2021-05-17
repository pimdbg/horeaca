<?php
    require_once('../app/src/master.php');
    
    class Structure extends Master{
        private $scripts;
        private $meta;
        private $header;
        private $main;
        private $head;
        private $body;
        
        public function __construct($data){
            $this -> createNav();
            $this -> createFooter();
            $this -> placeData($data);
            
            $this -> setHead();
            $this -> setBody();
            echo $this -> setStructure();
        }
        public function setStructure(){
            $structure;
            $structure='
            <!DOCTYPE HTML>
            <html lang="nl-NL">'.
                $this -> head.
                $this -> body.
            '</html>';

            return $structure;
        }
        public function placeData($data){
            $this -> scripts=$data['scripts'];
            $this -> meta=$data['meta'];
            $this -> header='
            <div id="headerWrap">
                '.
                $data['header']
                .'
            </div>';
            $this -> main='
            <div id="mainWrap">
                '.
                $data['body']
                .'
            </div>';
        }
        public function setHead(){
            $this -> head='
            <head>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta charset="UTF-8">
                '.
                $this -> meta
                .'
                <link rel="stylesheet" type="text/css" href="'.ROOT.'./css/stylesheet.css">
                <script type="application/ld+json" src="'.ROOT.'./js/schema.json"></script>
                <script src="'.ROOT.'lib/jquery-3.3.1.min.js"></script>
                <link rel="stylesheet" href="'.ROOT.'lib/jquery-ui-1.12.1.custom/jquery-ui.min.css">
                <script src="'.ROOT.'lib/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
                <script src="https://kit.fontawesome.com/e884db4f65.js" crossorigin="anonymous"></script>
                '.
                $this -> scripts
                .'
                <link rel="stylesheet" type="text/css" href="'.ROOT.'css/style_media_query.css">
                <script src="'.ROOT.'js/script.js" defer></script>
                <script src="'.ROOT.'js/launch.js" defer></script>
            </head>';
        }
        public function setBody(){
            $this -> body='
            <body>
                <div id="container">
                    '.
                    $this -> nav.
                    $this -> header.
                    $this -> main.
                    $this -> footer.
                    '
                </div>
            </body>';
        }
    }
?>