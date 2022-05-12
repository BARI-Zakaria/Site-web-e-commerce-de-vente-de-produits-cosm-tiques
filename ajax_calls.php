
<?php
session_start();
 
if(isset($_POST['action']) && $_POST['action'] == 'update-qty')
{
    $sessionItem = $_POST['itemID'];
    $sessionItemQty = $_POST['qty'];
    $productSessionPrice = $_SESSION['ar'][$sessionItem]['total_price'];
 
    $_SESSION['ar'][$sessionItem]['qty'] = $sessionItemQty;
    $_SESSION['ar'][$sessionItem]['total_price'] = $sessionItemQty * $productSessionPrice;
    
    echo json_encode(['msg' => 'success']);
    exit();
}
 
if(isset($_POST['action']) && $_POST['action'] == 'empty')
{
    unset($_SESSION['ar']);
    echo json_encode(['msg' => 'success']);
    exit();
}
 