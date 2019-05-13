<?php 
    require_once '../db-connection.php';
    $sqlStatement = "SELECT * FROM Categorys";
    $result = makeQuery($sqlStatement);
    $numberOfResults = $result->num_rows;
    if ($numberOfResults > 0) {
        while ($row = $result->fetch_assoc()) {
            $categoryID =$row["CategoryID"];
            $categoryName =$row["Title"];
            echo '<li><a href="products.php?cat=' . $categoryID . '">' . $categoryName . '</a></li>';
            
        }
    }
?>