<?php

            // 000000000 VALIDATION DES CHAMPS 000000000
$regexName = $regexPrenom = "/^[a-zA-Z\s]+$/";
$regexAdresse = "/^[a-zA-Z\d\s]+$/";
$regexTelephone = "/^[0-9]{10}$/";
$regexEmail = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+\.[a-zA-Z\d\._]{2,}+$/";
$regexPassword = "/^[a-zA-Z\d\.\s_-]+[0-9]+$/";
$test=0;
if(isset($_POST['submit'])){

    if(!preg_match($regexName, $_POST['nom'])){
        $outputName = "<span style='color:red'>*Last Name is required</span>";
        $test++;   
    }

    if(!preg_match($regexPrenom, $_POST['prenom'])){
        $outputPrenom = "<span style='color:red'>*First name is required</span>";
        $test++; 
    }

    if(!preg_match($regexAdresse, $_POST['adresse'])){
        $outputAdresse = "<span style='color:red'>*Adresse is required</span>";
        $test++;   
    }

    if(!preg_match($regexTelephone, $_POST['telephone'])){
        $outputTelephone = "<span style='color:red'>*Phone is required</span>";
        $test++;
    }

    if(!preg_match($regexEmail, $_POST['email'])){
        $outputEmail = "<span style='color:red'>*Email is required</span>";
        $test++;
    }

    if(!preg_match($regexPassword, $_POST['password'])){
        $outputPassword = "<span style='color:red'>*Password is required</span>";
        $test++;
    }
}
?>

        <!-- DECLARER ET AJOUTER DANS LES BD  -->
<?php
    include 'connect.php';
    if($test<=0){
        if(isset($_POST['submit'])){
            $lname=$_POST['nom'];
            $fname=$_POST['prenom'];
            $adresse = $_POST['adresse'];
            $phone = $_POST['telephone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // INSERTION DANS LES BD 
            $sql = "INSERT INTO `client` (`nom`, `prenom`, `adresse`, `telephone`, `email`, `pass`) Values ('$lname', '$fname', '$adresse', '$phone', '$email', '$password')";
            $result = mysqli_query($connect, $sql);
            if($result){
                header('location:authen.php');
                // echo "HADCHI MAKHEDAMCH !";
            }
        }
    }

?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b6a0f34e43.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- SCRIPT FONT-AWESOME -->
    <link rel="stylesheet" href="ins.css"><!-- Link CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> <!-- LINK FONT-AWESOME -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"><!-- Link BOOTSTRAP-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script><!-- Script Recaptcha -->

    <title>Inscription</title>
</head>
<body>
	<section class="pt-3">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-8 pt-3">
                    <p>Inscrivez-vous en quelques clics ! Vous pouvez vous inscrire soit en utilisant votre adresse e-mail, soit via votre compte Facebook ou Google.</p>
				</div>
			</div>
            <!-- part2 -->
			<div class="row justify-content-center">
				<div class="col-md-8 col-lg-6 col-sm-8 col-12 ">

             <form action="" class="form" id="form" method="POST" enctype="multipart/form-data">
                 <div class="form-group">
                    <?php if(isset($outputName)){ echo $outputName;}?>
                 <input type="text" name="nom" class="form-control" id="inputEmail4" placeholder="Nom">
                    
                </div>
                <div class="form-group">
                    <?php if(isset($outputPrenom)){ echo $outputPrenom;}?>
                    <input type="text" name="prenom" class="form-control" id="inputPassword4" placeholder="Prénom">
                </div>
           

                <div class="form-group">
                    <?php if(isset($outputAdresse)){ echo $outputAdresse;}?>
                    <input type="text" name="adresse" class="form-control" id="inputAddress" placeholder="Adresse">
                </div>

                
                    <div class="form-group">
                        <?php if(isset($outputTelephone)){ echo $outputTelephone;}?>   
                        <input type="text" name="telephone" class="form-control" id="inputPhone" placeholder="Téléphone">
                    </div>
                    

                
                    <div class=" form-group">
                        <?php if(isset($outputEmail)){ echo $outputEmail;}?>
                        <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <?php if(isset($outputPassword)){ echo $outputPassword;}?>
                        <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Mot de pass">
                    </div><br> 
                    <div class="g-recaptcha" data-sitekey="6LeTm7oeAAAAAFtFzvuzIbB2z4wWCJ3pN9hqUWK6">
                    </div><br>

                </div>
                <!-- ------------- CONDITIONS ------------- -->
                <div class="row justify-content-center">
                <div class="col-md-7">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" class="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">J’ai lu et j’accepte les <span class="conditions">Conditions générales de vente.</span></label>
                
                                    <!-- ------------- Recaptcha ------------- -->
                
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" class="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">Je souhaite recevoir la newsletter avec les meilleures offres du jour.</label>
                </div>       
                
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
        <input type="submit" class="form-control btn btn-info submit px-3" name="submit" value="S'inscrire" >
        </div>
        
            </form>	
            <div class="text-dark text-center">
                <a href="index.php">Go home</a>
                </div>
            <div class="social_F">
            <i class="fa-brands fa-facebook"></i>
            <p class="FAGO">Facebook</p>
            <img src="images/google 2.png" alt="" id="google">
            <p class="FAGO_">Google</p>
            </div>
            </div>
        </div>
    </div>
</section>

<!-- ------------- DIVISEURS ------------- -->

<div>
    <!-- <div class="line">
        <div class="ligne"></div>
                <p class="text-white">OU</p> <div class="ligne"></div>
                
            </div> -->
            <!-- ------------- -->
                                    
    
            <!-- <div class="social_G">
            </div> -->

    
</body>
<script src="script.js"></script>
</html>