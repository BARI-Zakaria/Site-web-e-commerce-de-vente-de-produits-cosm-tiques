<?php 
include 'connect.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Home</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="css/Style.css" rel="stylesheet" />


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    


    </head>
    <body>
        <!-- Navigation-->
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
                           echo (isset($_SESSION['ar']) && count($_SESSION['ar'])) > 0 ? count($_SESSION['ar']):'0';
                       ?>
                   </a>
                    
                </div>
            </div>
        </nav>
        <!-- Header-->
        <header  class="masthead ">
            <div class="container" >
                <div class="masthead-subheading">Shop in style</div>
                <div class="masthead-heading text-uppercase">Let's be beautiful together</div>
            </div>
        </header>
            
        <?php 
        // $sql = 'SELECT * FROM `produit` ';
        $sql = 'SELECT * FROM produit ORDER BY idProduit ASC LIMIT 8';
        $result = mysqli_query($connect, $sql);
     
        ?>
     
      <!-- Section -->
      <form action="" method="POST" enctype=" multipart/form-data">
          <section class="py-5" id="services">
              <div class="container px-4 px-lg-5 mt-5">
                  <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                      <?php 
                
                   while($us = mysqli_fetch_assoc($result)){
                   
                    ?>
                
                <div class="col mb-5">
            
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="<?php echo"img/".$us['image']; ?>" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?php echo $us['libelle']; ?></h5>
                                <!-- Product price-->
                                <?php echo $us['prix']. 'DH'; ?>
                            </div>
                        </div>
                        <!-- Product actions--> 
                        
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a  class="btn btn-outline-dark mt-auto" href="detai.php?product=<?=$us['idProduit']?>">See more</a></div>
                                
                            </div>
                        </div>
                    </div>
                    <?php
                      }
                    //  while
                    //  ($i < 8);
                    ?>
                    
                </div>
            </div>
            
        </section>
    </form>
    
    
    
    <!-- Footer-->
    
    <footer class="p-4 bg-dark text-white">
        <div class="row">
            <div class="col-4" >
                <ul class="">
                    <dt class="p-1">REGARDS TO</dt>
                    <dd class="p-1">About us</dd>
                        <dd class="p-1">Partenirs</dd>
                        <dd class="p-1">References</dd>
                    </ul>
                </div>
                
                <div class="col-4" >
                    <ul>
                        <dt class="p-1" >CONTACT US</dt>
                        <dd class="p-1" >www.Start.com</dd>
                        <dd class="p-1" >+212 594 647 811</dd>
                        <dd class="p-1" >info@start.com</dd>
                    </ul>
                </div>

                <div class="col-4" >
                    <ul>
                        <dd class="p-1">Do you want to receive exclusive offers? <br>
                        Subscribe to our newsletter</dd>
                        <input id="hover" class="form-control" type="text" placeholder="Email"><br>
                        <button class="btn btn-outline-success m-0 text-white " >Register</button>
                    </ul>
                </div> 
                
            </div>
            <blockquote class=" ms-4 ps-2 text-white">Copyright &copy; ZKR 2022</blockquote>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
