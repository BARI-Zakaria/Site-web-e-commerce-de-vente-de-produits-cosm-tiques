<?php 
    session_start();
  require_once('./inc/config.php');    
  require_once('./inc/helpers.php');  


//remove product
if(isset($_GET['action'],$_GET['item']) && $_GET['action'] == 'remove')
{
    unset($_SESSION['ar'][$_GET['item']]);
    header('location:cart.php');
    exit();
}


  include('layouts/header.php');
?>

<div class="row mt-5">
  <div class="col-md-12 mt-5">
      <?php if(empty($_SESSION['ar'])){?>
      <table class="table">
          <tr>
              <td>
                  <p>Your cart is emty</p>
              </td>
          </tr>
      </table>
      <?php }?>
      <?php
  
      if(isset($_SESSION['ar']) && count($_SESSION['ar'])>0){?>
      <table class="table text-center">
         <thead>
             <tr>
                 <td colspan="6">
                     <h4 class="text-center text-info">Products In Your Cart</h4>
                 </td>
             </tr>
              <tr>
                  <th></th>
                  <th>Product</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Remove</th>
              </tr>
          </thead>
          <tbody>
              <?php 
                  $totalCounter = 0;
                  $itemCounter = 0;
                  foreach($_SESSION['ar'] as $key => $v){
                            $total = intval($v['prix']) * intval($v['qty']);
                            $totalCounter+= $total;
                            $itemCounter+=$v['qty'];
                  ?>
                  <tr>
                      <td><img src="img/<?php echo $v['image'];?>" alt="" height="100px"></td>
                      <td>
                        
                          <?php echo $v['libelle'];?>
                        
                      </td>
                      <td>
                          $<?php echo $v['prix'];?>
                          <input type='hidden' class='iprice' value='<?php echo $v['prix'];?>'>
                      </td>
                      <td>
                          <input type="number" 
                          class="cart-qty-single quantite"
                           onchange="subTotal()"
                           name="quan"
                           data-item-id="<?php echo $key?>" 
                            value="<?php echo $v['qty'];?>" 
                            min="1" max="1000" >
                            <input type='hidden' 
                            name="pId" class='iprice'
                             value='<?php echo $v['pid'];?>'>

                      </td>
                      <td class='itotal'>
                                <?php echo $v['total_price'];?>
                      </td>
                      <td>
                                <a href="cart.php?action=remove&item=<?php print $key;?>" class="text-danger">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                  </tr>
              <?php }?>
              <tr class="border-top border-bottom">
                  <td><button class="btn btn-danger btn-sm" id="emptyCart">Clear Cart</button></td>
                  <td></td>
                  <td></td>
                  <td>
                      <strong>
                          <?php 
                              echo ($itemCounter==1)?$itemCounter.' item':$itemCounter.' items'; ?>
                      </strong>
                  </td>
                  <td id="gtotal"><strong>$<?php echo $totalCounter;?></strong></td>
              </tr> 
              </tr>
          </tbody> 
      </table>
      <div class="row">
          <div class="col-md-11">
              <a href="checkout.php">
                  <button class="btn btn-primary btn-lg float-right">Checkout</button>
              </a>
          </div>
      </div>
     
  </div>
</div>

<?php include('layouts/footer.php');?>
