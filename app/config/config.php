<?php
    $host=$_SERVER['HTTP_HOST'];

    switch($host){
        case 'localhost':
            define('ROOT', 'http://localhost/project/');

            define('SITENAME', 'Horeaca');
            
            define('DB_HOST','localhost');
            define('DB_NAME','pim_oop');
            define('DB_USERNAME','root');
            define('DB_PASSWORD','usbw');
        break;
        case 'cursist05.reacollege.eu':
            define('ROOT', 'http://cursist05.reacollege.eu/pim_oop/');
        
            define('SITENAME', 'Horeaca');
            
            define('DB_HOST','localhost');
            define('DB_NAME','reacoys29_DB5');
            define('DB_USERNAME','reacoys29_CS5');
            define('DB_PASSWORD','dbcursist05');
        break;
    }
?>