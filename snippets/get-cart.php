<?php
session_start();

if (isset($_SESSION['cart-items']) && is_array($_SESSION['cart-items'])) {
    print json_encode($_SESSION['cart-items']);
}

?>
