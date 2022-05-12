<!-- CONNEXION AU SERVEUR -->

<?php include 'connect.php';?>

<!-- ----------------------  -->

    <!-- 00000000000000000 AUTHENTIFICATION / LOGIN 00000000000000000 -->

  
                     <!-- ----------------------  -->


                     <?php
    $messageEmail = $messagePassword = '';
    if(isset($_POST['submit'])){
        $email = $_POST['mail'];
        $password = $_POST['password'];
        $sql =("SELECT Pass FROM client WHERE email='$email' and pass='$password'");
        $result = mysqli_query($connect, $sql);
        if($row=mysqli_fetch_assoc($result)){  
            header("location:index.php");
        }
        else{
            $messageEmail = '<span class="error">Adresse email introuvable !</span>';
            $messagePassword = '<span class="error">Mot de pass inccorect !</span>';
        }  
    }

?>
                        <!-- ----------------------  -->


    <!-- 00000000000000000 ACTIVATION DE RECAPTCHA 00000000000000000 -->

<?php
    if(isset($_POST['g-recaptcha-response'])){
        $secretKey="6LeTm7oeAAAAAOOWGl31w_5RVWPuAhLHo9Wdb8s-";
        $ip=$_SERVER['REMOTE_ADDR'];
        $response=$_POST['g-recaptcha-response'];
        $url="https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$ip";
        $qlf=file_get_contents($url);
        $data = json_decode($qlf);
        if($data->success==true){
            
        }
        else {
            // echo "Please Fill the reCaptcha";
            echo '<script> alert("Please Fill the reCaptcha") </script>';
        }
    }
?>
                        <!-- ----------------------  -->


    <!-- 00000000000000000 OPTION DE "RESTER CONNECTER" 00000000000000000 -->

<?php
if(isset($_POST['submit'])){
    $email = $_POST['mail'];
    $password = $_POST['password'];
    $pass = md5($password);
    $sql = "SELECT * FROM client WHERE email='$email' and pass='$pass'";
    $result = mysqli_query($connect,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row>0){

        //SESSION
        $data = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $data['idClient'];

        // CHECK CHECKBOX
        if(!empty($_POST['remember'])){
            $remember = $_POST['remember'];

        //SET COOKIES
        setcookie('email',$email,time()+3600*24*7);
        setcookie('password',$password,time()+3600*24*7);
        setcookie('user_login',$remember,time()+3600*24*7);
        }
        else{
            //EXPIRE COOKIES
            setcookie('email',$email,30);
            setcookie('password',$password,30);
        }
    }
}
?>
                    <!-- ----------------------  -->

    <!-- 00000000000000000 VALIDATION DES CHAMPS 00000000000000000 -->
<?php 
    $email = $password = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(empty($_POST['mail'])){
            $email = '<span class="error">Ce champs est Obligatoire !</span>';
        }
        if(empty($_POST['password'])){
            $password = '<span class="error">Ce champs est obligatoire !</span>';
        }
    }
?>
       

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="authe.css"><!-- Link CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><!-- Link BOOTSTRAP -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script><!-- Script Recaptcha -->
    <title>Authentification</title>
</head>
<body>
     <!-- Navigation-->
     <!-- <nav class="navbar navbar-expand-lg navbar-dark " >
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Start </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#!">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                                <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <button class="btn btn-outline-secondary m-1" type="submit">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo 0;?></span>
                        </button>
                    </form>
                </div>
            </div>
        </nav> -->
    
    <div class="container">

        <form action="" method="post" enctype="multipart/form-data">

            <h1>Connectez-vous à votre compte !</h1>
            <div class="mb-3 w-50 my-4 mx-auto">
                <?php echo $email;?> <?php echo $messageEmail;?>
                <input type="email" class="form-control" name="mail" id="exampleFormControlInput1" placeholder="Enter your Username, phone, email" value="<?php if(isset($_COOKIE['mail'])){echo $_COOKIE['mail'];};?>">
            </div>
    
            <div class="mb-3 w-50 my-4 mx-auto">
                <?php echo $password;?> <?php echo $messagePassword;?>
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Enter your password" 
                value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];};?>">
            </div>

            <div class="g-recaptcha" id="recaptcha" data-sitekey="6LeTm7oeAAAAAFtFzvuzIbB2z4wWCJ3pN9hqUWK6"></div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="exampleCheck1" value="<?php if(isset($_COOKIE['user_login'])){echo $_COOKIE['user_login'];};?>">
                <label class="form-check-label" for="exampleCheck1" id="remem">Rester connecté</label>
                <a href="">Mot de pass oublié ?</a><br>
                <a class="link-dark" href="index.php">Go home</a>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-2">
           <button type="submit" class="btn btn-info" name="submit" id="btn">S'authentifier</button>
           </div>
           </div>
        </form>

        <p>Vous n’avez pas un compte ?. <a href="insc.php">Inscrivez-vous</a> pour accéder à la plateforme.</p>
        
    </div>

</body>
</html>