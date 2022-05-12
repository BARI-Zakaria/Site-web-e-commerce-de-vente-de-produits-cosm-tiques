<!-- CONNEXION AU SERVEUR -->
<?php
    $connect = new mysqli ('localhost', 'root', '', 'gestion_magasin');

    if(!$connect){
        // die(mysqli_error($con)); 
        echo "T'es pas connecté al3awed !";  
    }
?>
<!-- ----------------------  -->