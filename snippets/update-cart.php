<?php
session_start();

if (isset($_SESSION['cart-items']) && is_array($_SESSION['cart-items'])) {
    if (isset($_POST["id"]) && isset($_POST["qty"])) {
        $qty = (int)$_POST["qty"];
        $pid = $_POST["id"];

        while (!is_bool(array_search($_POST["id"], $_SESSION['cart-items'])) && array_search($_POST["id"], $_SESSION['cart-items']) >= 0) {
            array_splice($_SESSION['cart-items'], array_search($_POST["id"], $_SESSION['cart-items']), 1);
        }
        if ($qty > 0)
            for ($x = 0; $x < $qty; $x++) {
                array_push($_SESSION['cart-items'], $pid);
            }
    }
}

?>
