<?php
 session_start();

 $cart = isset($_SESSION['cart-items']);
 if (!$cart || !is_array($_SESSION['cart-items']))
    $cartArray = array();
 
 if (isset($cartArray)) {
   array_push($cartArray, $_POST['item']);
   $_SESSION['cart-items'] = $cartArray;
 } else
     array_push($_SESSION['cart-items'], $_POST['item']);

?>
