<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        
    <title>Document</title>
</head>
<body>
    <main role="main">
<div class="container">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="container_nav" >
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Start </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        
                    </ul>
                    <form class="d-flex mr-5">
                        <a class="btn btn-outline-success m-1 text-white " href="authen.php">Login</a>
                        <a class="btn btn-outline-success m-1 text-white " href="insc.php">Sign up</a>
                        </form><a href="cart.php" style="color:#ffffff">
                       
                    <i class="bi bi-cart4" style="font-size:25px;"></i>
                    <?php 
                        echo (isset($_SESSION['ar']) && count($_SESSION['ar'])) > 0 ? count($_SESSION['ar']):'';
                    ?>
                </a>
                    
                </div>
            </div>
        </nav>
</div>


<div class="py-5">

<div class="container py-5">