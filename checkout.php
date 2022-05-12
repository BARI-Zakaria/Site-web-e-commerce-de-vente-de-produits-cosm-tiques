<?php 
    session_start();
 
    if(!isset($_SESSION['ar']) || empty($_SESSION['ar']))
    {
        header('location:index.php');
        exit();
    }
 
    require_once('./inc/config.php');    
    require_once('./inc/helpers.php');  
    $cartItemCount = count($_SESSION['ar']);
 
    //pre($_SESSION);
 
    if(isset($_POST['submit']))
    {
        if(isset($_POST['address']) && !empty($_POST['address']))
        {
           
 
              $adrs = $_POST['address'];
 
                $sql = 'INSERT INTO commande (idCommande,idClient,adresseLivraison) 
                values ("M1278","C123",:adress)';
                $statement = $db->prepare($sql);
              
                $paramsCmd = ['adress' => $adrs,];
                $statement->execute($paramsCmd);
                if($statement->rowCount() == 1)
                {
                    
                    $getCmdId = $db->lastInsertId();
 
                    if(isset($_SESSION['ar']) || !empty($_SESSION['ar']))
                    {
                        $query = 
                        // 'INSERT INTO detailscommande (idCommande,idProduit,quantite ) values(:idCmd,:product_id,:qty)';

                        'INSERT INTO detailscommande (idCommande,idProduit,quantite ) values("M1278",:product_id,:qty)';
                        $orderDetailStmt = $db->prepare($query);
 
                        $totalPrice = 0;
                        foreach($_SESSION['ar'] as $item)
                        {
                            $totalPrice+=$item['total_price'];
 
                            $param = [
                                // 'idCmd' =>  $getCmdId,
                                'product_id' =>  $item['pid'],
                                
                                'qty' =>  $item['qty'],
                               
                            ];
 
                            $orderDetailStmt->execute($param);



                            
                            $qte = $item['qty'];
                            $sql = "SELECT stock FROM `produit` where idProduit =:product_id";
                            $statement1 = $db->prepare($sql);

                            $param1=[
                              'product_id' =>  $item['pid'],
                            ];
                            $statement1->execute($param1);
    
                            $stockActuel = 0;
                            while($row = $statement1->fetch(PDO::FETCH_ASSOC)){
                              $stockActuel  = $row[0];
                            }
                            $stockActuel -= $qte;
                            $q2 = "UPDATE produit set stock=$stockActuel where idProduit=:product_id ";
                            $statement = $db->prepare($q2);
                            $statement->execute($param1);
                        }

                        
                       
                        
                                                
                        unset($_SESSION['ar']);
                        $_SESSION['confirm_order'] = true;
                        header('location:thank-you.php');
                        exit();
                    }
                }
                
           
        }
      
    }
 
    include('layouts/header.php');
?>

<div class="row mt-3">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill"><?php echo $cartItemCount;?></span>
          </h4>
          <ul class="list-group mb-3">
            <?php
                $total = 0;
                foreach($_SESSION['ar'] as $cartItem)
                {
                    $total+=$cartItem['total_price'];
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?php echo $cartItem['libelle'] ?></h6>
                            <small class="text-muted">Quantity: <?php echo $cartItem['qty'] ?></small>
                            <small> Price: <?php echo $cartItem['prix'] ?></small>
                        </div>
                        <span class="text-muted">$<?php echo $cartItem['total_price'] ?></span>
                    </li>
            <?php
                }
            ?>
           
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (USD)</span>
              <strong>$<?php echo number_format($total,2);?></strong>
            </li>
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Billing address</h4>
          <?php 
            if(isset($errorMsg) && count($errorMsg) > 0)
            {
                foreach($errorMsg as $error)
                {
                    echo '<div class="alert alert-danger">'.$error.'</div>';
                }
            }
          ?>
          <form class="needs-validation" method="POST">
            <div class="row">
            
 
              <div class="mb-3">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="<?php echo (isset($addressValue) && !empty($addressValue)) ? $addressValue:'' ?>">
              </div>
 
            
            </div>
            <hr class="mb-4">
 
            <h4 class="mb-3">Payment</h4>
 
            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="cashOnDelivery" name="cashOnDelivery" type="radio" class="custom-control-input" checked="" >
                <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
              </div>
            </div>
           
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="submit">Continue to checkout</button>
          </form>
        </div>
      </div>
<?php include('layouts/footer.php'); ?>