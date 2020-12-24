<?php
    date_default_timezone_set('Europe/Riga');

    if (isset($_GET["location"])) {
        $file = __DIR__ . "/controllers/" . $_GET["location"] . "_controller.php";
        session_start();
    }

    if(file_exists($file)){
        
        if($_GET['location'] === 'home'){
            require_once $file;
        } 
        else if ($_GET['location'] === 'emails'){
            require_once $file;
        } 
        else{
        Header("Location: /magebit/?location=home");
        }
    } else {
        Header("Location: /magebit/?location=home");
    }
?>