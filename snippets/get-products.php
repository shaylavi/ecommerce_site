<?php
  include_once dirname(__DIR__) . '\\db-connection.php';
  include_once dirname(__DIR__) . '\\snippets\\class-definitions.php';

const showMaterials = true;
function buildHtmlCategories()
{
  $newProducts = fetchAllCategories();
  $activeClass = '';
  $productCategory = null;

  if (sizeof($_GET) > 0) {
    $productCategory = $_GET['cat'];
  }
  foreach ($newProducts as $p) {
    if ($productCategory != null && $p['id'] == $productCategory)
      $activeClass = 'active';
    else
      $activeClass = '';

    echo '
    <a href="products.php?cat=' . $p['id'] . '" class="list-group-item ' . $activeClass . '">' . $p['title'] . '</a>
  ';
  }
}

function buildHtmlProducts($categoryId = null)
{
  $newProducts = fetchAllProducts($categoryId);

  foreach ($newProducts as $p) {
    echo '
    <div class="col-md-3" id="product-' . $p['id'] . '">
    <div class="product-style">
      <div class="new-products panel shadow p-3 mb-5 bg-white rounded">' .
      (showMaterials ? materialHtml($p["materials"]) : "")
      . '
          <img src="' . $p['photo'] . '" alt="' . $p['alt'] . '" />
          <div><h4><b>' . $p['title'] . '</b></h4></div>
          <p> ' . $p['description'] . ' </p>
          <div class="product-buttons">
              <a href="product.php?id=' . $p['id'] . '" class="btn btn-info">Deatil</a>
              <a href="#" class="btn btn-default">Add To Cart</a>
          </div>
      </div>
      </div>
      </div>
      ';
  }
}

function buildHtmlSimilarProducts($id)
{
  $similarProducts = fetchSimilarProducts($id);

  foreach ($similarProducts as $p) {
    echo '
    <div class="col-md-4">
    <div class="product-style">
      <div class="new-products panel shadow p-3 mb-5 bg-white rounded">' .
      (showMaterials ? materialHtml($p["materials"]) : "")
      . '
          <img src="' . $p['photo'] . '" alt="' . $p['alt'] . '" />
          <h4><div>' . $p['title'] . '</div></h4>
          <p> ' . $p['description'] . ' </p>
          <div class="product-buttons">
              <a href="product.php?id=' . $p['id'] . '" class="btn btn-info">Deatil</a>
              <a href="#" class="btn btn-default">Add To Cart</a>
          </div>
      </div>
      </div>
      </div>
      ';
  }
}
function buildHtmlNewProducts()
{
  $newProducts = fetchProducts(4);

  foreach ($newProducts as $p) {
    echo '
    <div class="col-md-3">
    <div class="product-style">
      <div class="new-products panel shadow p-3 mb-5 bg-white rounded">' .
      (showMaterials ? materialHtml($p["materials"]) : "")
      . '
          <img src="' . $p['photo'] . '" alt="' . $p['alt'] . '" />
          <h4><div>' . $p['title'] . '</div></h4>
          <p> ' . $p['description'] . ' </p>
          <div class="product-buttons">
              <a href="product.php?id=' . $p['id'] . '" class="btn btn-info">Deatil</a>
              <a href="#" class="btn btn-default">Add To Cart</a>
          </div>
      </div>
      </div>
      </div>
      ';
  }
}
function materialHtml($materials) {
  $html = '<div class="material-holder">';
  foreach ($materials as $material) {
    $html .= '<span class="label label-default" style="background-color:'.$material["backColour"].';color:'.$material["textColour"].'">'.$material["title"].'</span>';
  }
  $html .= '</div>';
  return $html;
}
function buildHtmlTopSellerProducts()
{
  $newProducts = fetchProducts(4);

  foreach ($newProducts as $p) {
    echo '
    <div class="col-md-3">
      <div class="top-sellers-style thumbnail" onclick="window.location=\'product.php?id=' . $p['id'] . '\'">
        <div class="bg-primary input-lg">' . $p['title'] . '</div>' .
        (showMaterials ? materialHtml($p["materials"]) : "")
        . '
        <div class="product-image position-relative">
            <img src="' . $p['photo'] . '" alt="' . $p['alt'] . '" /> 
        </div>
        <div class="bg-primary input-lg">
            <a href="product.php?id=' . $p['id'] . '" style="color:white">Details</a>
        </div>
      </div>
    </div>
      ';
  }
}

function fetchAllCategories()
{
  $query = makeQuery("SELECT * FROM Categorys");
  $quesryResults = array();

  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $quesryResults[] = array(
      "id" => $row["CategoryID"],
      "title" => $row["Title"]
    );
  }

  $parsedResults = array();
  foreach ($quesryResults as $p) {
    $parsedResults[] = json_decode(safe_json_encode($p), true);
  }
  return $parsedResults;
}

function fetchAllProducts($category = null, $titleLimit = 18, $descLimit = 70)
{
  if ($category == null || $category == '') {
    $query = makeQuery("SELECT * FROM Products");
  } else {
    $query = makeQuery("SELECT * FROM Products WHERE CategoryID = " . $category);
  }

  $quesryResults = array();

  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $quesryResults[] = array(
      "photo" => $row["ImageUrl"],
      "alt" => $row["ImageAlt"],
      "title" => strlen($row["Title"]) > $titleLimit ? substr($row["Title"], 0, $titleLimit) . ".." : $row["Title"],
      "id" => $row["ProductID"],
      "price" => $row["Price"],
      // "category" => $row["CategoryTitle"],
      "description" => strlen($row["Description"]) > $descLimit ? substr($row["Description"], 0, $descLimit) . ".." : $row["Description"],
      "materials" => array()
    );
  }
  $quesryResults = applyMaterials($quesryResults);
  $parsedResults = array();
  foreach ($quesryResults as $p) {
    $parsedResults[] = json_decode(safe_json_encode($p), true);
  }

  return $parsedResults;
}
function applyMaterials($queryResults) {
  if (showMaterials) {
    $queryMaterials = makeQuery("SELECT m.MaterialID, m.Title, p.ProductID, m.DisplayColour, m.DisplayTextColour FROM Product_Material p, Materials m WHERE m.MaterialID = p.MaterialID");
    while ($row = mysqli_fetch_array($queryMaterials, MYSQLI_ASSOC)) {
      for ($i = 0; $i < count($queryResults); $i++) {
        if ($queryResults[$i]["id"] == $row["ProductID"]){
          $queryResults[$i]["materials"][] = array(
            "title" => $row["Title"],
            "backColour" => $row["DisplayColour"],
            "textColour" => $row["DisplayTextColour"]
          );
          break;
        } 
      }
    }
  }
  return $queryResults;
}
function fetchProduct($id)
{
  if ($id != null) {
    $query = makeQuery("SELECT * FROM Products WHERE ProductID = " . $id);
    $quesryResults = array();

    while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $quesryResults = array(
        "photo" => $row["ImageUrl"],
        "alt" => $row["ImageAlt"],
        "title" => $row["Title"],
        "id" => $row["ProductID"],
        "price" => $row["Price"],
        // "category" => $row["CategoryTitle"],
        "description" => $row["Description"],
        "materials" => array()
      );
    }

    $parsedResults = array();
    foreach ($quesryResults as $key => $p) {
      $parsedResults += array($key => json_decode(safe_json_encode($p), true));
    }
    return $parsedResults;
    // echo safe_json_encode($parsedResults);  // To be used for JS callback
  } else
    return null;
}

function fetchSimilarProducts($id)
{
  $totalProducts = 3;
  $query = makeQuery("SELECT * FROM Products WHERE CategoryID = (SELECT CategoryID FROM Products WHERE ProductID = " . $id . ") LIMIT " . $totalProducts);
  $quesryResults = array();

  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $quesryResults[] = array(
      "photo" => $row["ImageUrl"],
      "alt" => $row["ImageAlt"],
      "title" => strlen($row["Title"]) > 18 ? substr($row["Title"], 0, 18) . ".." : $row["Title"],
      "id" => $row["ProductID"],
      "price" => $row["Price"],
      // "category" => $row["CategoryTitle"],
      "description" => strlen($row["Description"]) > 70 ? substr($row["Description"], 0, 70) . ".." : $row["Description"],
      "materials" => array()
    );
  }
  $quesryResults = applyMaterials($quesryResults);

  $parsedResults = array();
  foreach ($quesryResults as $p) {
    $parsedResults[] = json_decode(safe_json_encode($p), true);
  }
  return $parsedResults;
}

function fetchProducts($totalProducts, $sorted = false)
{
  if ($sorted) {
    $RANGE = 0;
  } else {
    $RANGE = mt_rand(1, (50 - $totalProducts));
  }

  $query = makeQuery("SELECT * FROM Products WHERE ProductID BETWEEN " . $RANGE . " AND " . ($RANGE + $totalProducts - 1));
  $quesryResults = array();

  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $quesryResults[] = array(
      "photo" => $row["ImageUrl"],
      "alt" => $row["ImageAlt"],
      "title" => strlen($row["Title"]) > 18 ? substr($row["Title"], 0, 18) . ".." : $row["Title"],
      "id" => $row["ProductID"],
      "price" => $row["Price"],
      // "category" => $row["CategoryTitle"],
      "description" => strlen($row["Description"]) > 70 ? substr($row["Description"], 0, 70) . ".." : $row["Description"],
      "materials" => array()
    );
  }

  $quesryResults = applyMaterials($quesryResults);
  $parsedResults = array();
  foreach ($quesryResults as $p) {
    $parsedResults[] = json_decode(safe_json_encode($p), true);
  }
  return $parsedResults;
  // echo safe_json_encode($parsedResults);  // To be used for JS callback
}

function safe_json_encode($value, $options = 0, $depth = 512, $utfErrorFlag = false)
{
  $encoded = json_encode($value, $options, $depth);
  switch (json_last_error()) {
    case JSON_ERROR_NONE:
      return $encoded;
    case JSON_ERROR_DEPTH:
      return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_STATE_MISMATCH:
      return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_CTRL_CHAR:
      return 'Unexpected control character found';
    case JSON_ERROR_SYNTAX:
      return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
    case JSON_ERROR_UTF8:
      $clean = utf8ize($value);
      if ($utfErrorFlag) {
        return 'UTF8 encoding error'; // or trigger_error() or throw new Exception()
      }
      return safe_json_encode($clean, $options, $depth, true);
    default:
      return 'Unknown error'; // or trigger_error() or throw new Exception()

  }
}
function utf8ize($mixed)
{
  if (is_array($mixed)) {
    foreach ($mixed as $key => $value) {
      $mixed[$key] = utf8ize($value);
    }
  } else if (is_string($mixed)) {
    return utf8_encode($mixed);
  }
  return $mixed;
}
