<?php
    $dsn  = 'mysql:host=localhost;dbname=gestion_magasin';
    $user ='root';
    $passwod='';



    try{
        $db = new PDO($dsn,$user,$passwod);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }

    // define()




?>
