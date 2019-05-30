<?php

    require_once dirname(__DIR__) . '\\snippets\\get-products.php';
    echo safe_json_encode(fetchAllProducts(null,  10000,10000));
?>