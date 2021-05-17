<?php
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(E_ALL);

    require_once('../app/config/config.php');
    require_once('../app/src/core.php');
    require_once('../app/src/controller.php');
    
    $core=new Core();
?>