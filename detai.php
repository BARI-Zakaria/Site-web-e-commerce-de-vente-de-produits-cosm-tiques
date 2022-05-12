
<?php include 'connect.php'; 
 session_start();?>

    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Details</title>
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
                        echo (isset($_SESSION['ar']) && count($_SESSION['ar'])) > 0 ? count($_SESSION['ar']):'';
                    ?>
                </a>
                    
                </div>
            </div>
        </nav>
        <?php
        $idproduct = $_GET["product"] ; 
        $sql = "SELECT * FROM `produit` where idProduit ='$idproduct'";
          $result = mysqli_query($connect, $sql);
          $rol = mysqli_fetch_assoc($result);
         
        ?>
        <!-- Product section-->
        <?php 
        session_start();
             
      
        if(isset($_POST['add']))
        {
            $Cal_Total = intval($_POST['prix']) * intval( $_POST['qty']);
            $item = array(
                'pid'=>$_GET['product'],
                            'libelle'=>$_POST['libelle'],
                            'image'=>$_POST['image'],
                            
                            'prix'=>$_POST['prix'],
                            'qty'=>$_POST['qty'],
                            'total_price' =>$Cal_Total,);

            if(isset($_SESSION['ar'])){
                $myitems = array_column($_SESSION['ar'],'product');
                if(!in_array($_GET["product"],$myitems)){
                    $count = count($_SESSION['ar']);
                    
                  $_SESSION['ar'][$count]=$item;
                  
                  
                  $successMsg = true;
                }
               
            }
            else{
                
                $_SESSION['ar'][0]=$item;
               

        }
    }

        // if(isset($_SESSION['cart'])){
        //    print_r($_SESSION['cart']);
        // }else{
        //     $array_a =array(
        //         'idProduit' => $_POST['idProduit']
        //     );
        //     $_SESSION['cart'][0]=$array_a;
        //     @print_r($_SERVER['cart']);


        // }
    ?>
       <?php if(isset($successMsg) && $successMsg == true){?>
            <div class="row mt-5">
                <div class="col-md-12 mt-3">
                    <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $rol['libelle']?> is added to cart. <a href="cart.php" class="alert-link">View Cart</a>
                    </div>
                </div>
            </div>
         <?php }?>
            <form action="" method="POST" enctype=" multipart/form-data">
            <section class="py-5">
                                <div class="container px-4 px-lg-5 my-5">
                            <div class="row gx-4 gx-lg-5 align-items-center">
                                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo"img/".$rol['image']; ?>" alt="..." /></div>
                                <div class="col-md-6">
                                    <h1 class="display-5 fw-bolder"><?php echo $rol['libelle']; ?></h1>
                        <div class="fs-5 mb-5">
                            <span><?php echo $rol['prix'].'DH'; ?></span>
                        </div>
                        <p class="lead"><?php echo $rol['description']; ?></p>
                        <div class="d-flex">
                            <input class="form-control text-center me-3" name="qty" type="number" value="1" style="max-width: 5rem" />
                            <input type="hidden" name="product_id" value="<?php echo $rol['idProduit'];?>">
                    <input type="hidden" name="libelle" value="<?php echo $rol['libelle'];?>">
                    <input type="hidden" name="prix" value="<?php echo $rol['prix'];?>">
                    <input type="hidden" name="image" value="<?php echo $rol['image'];?>">
                          
                            <button class="btn btn-outline-dark flex-shrink-0" name="add" type="submit">
                                <i class="bi-cart-fill me-1"></i>
                                Add to cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       <?php
        $sql = 'SELECT * FROM produit ORDER BY idProduit DESC LIMIT 4 ';
        $result = mysqli_query($connect, $sql);
        ?>
        <!-- Related items section-->
        <section class="py-5 bg-light">
            <div class="container px-4 px-lg-5 mt-5">
                <h2 class="fw-bolder mb-4">Related products</h2>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php 
                            $pop =$connect-> query($sql);
                            while($us = mysqli_fetch_assoc($result)){ ?>
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="<?php echo $us['image']; ?>" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo $us['libelle']; ?></h5>
                                    <!-- Product price-->
                                    <?php echo $us['prix'] . 'DH'; ?>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="detai.php?idProduit=<?=$us['idProduit']?>">See more</a></div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
                        <button class="btn btn-outline-success m-0 text-white " id="re" >Register</button>
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










