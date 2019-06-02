<?php
include 'get-products.php';

if (isset($_POST["item"])){
$PID = $_POST["item"];
$product = fetchProduct((string)$PID);
print safe_json_encode($product); 
} else print "";

?>