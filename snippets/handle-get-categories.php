<?php 
    include_once dirname(__DIR__) . '/snippets/get-products.php';
    $raw = false;
    if (sizeof($_GET) > 0) {
        $raw = $_GET['type'] == "raw";
    }
    require_once '../db-connection.php';
    $sqlStatement = "SELECT * FROM Categorys";
    $result = makeQuery($sqlStatement);
    $numberOfResults = $result->num_rows;
    $json = array();
    $index = 0;
    if ($numberOfResults > 0) {
        while ($row = $result->fetch_assoc()) {
            if (!$raw) {    
                $categoryID =$row["CategoryID"];
                $categoryName =$row["Title"];
                echo '<li><a href="products.php?cat=' . $categoryID . '">' . $categoryName . '</a></li>';
            }
            else {
                $json[$index] = array("id"=>$row["CategoryID"], "title"=>$row["Title"]);
            }
            $index++;
        }
    }
    if ($raw) echo safe_json_encode($json);
?>