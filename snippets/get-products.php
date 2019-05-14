<?php
require_once 'db-connection.php';
require_once 'class-definitions.php';

function buildHtmlSimilarProducts($id)
{
  $similarProducts = fetchSimilarProducts($id);

  foreach ($similarProducts as $p) {
    echo '
    <div class="col-md-3">
    <div class="my-list">
      <div class="new-products panel shadow p-3 mb-5 bg-white rounded">
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
    <div class="my-list">
      <div class="new-products panel shadow p-3 mb-5 bg-white rounded">
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

function buildHtmlTopSellerProducts()
{
  $newProducts = fetchProducts(4);

  foreach ($newProducts as $p) {
    echo '
    <div class="col-md-3">
      <div class="my-list thumbnail" onclick="window.location=\'product.php?id=' . $p['id'] . '\'">
        <div class="bg-primary input-lg">' . $p['title'] . '</div>
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

function fetchProduct($id)
{
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
      "description" => $row["Description"]
    );
  }

  $parsedResults = array();
  foreach ($quesryResults as $key => $p) {
    $parsedResults += array($key => json_decode(safe_json_encode($p), true));
  }
  return $parsedResults;
  // echo safe_json_encode($parsedResults);  // To be used for JS callback
}

function fetchSimilarProducts($id)
{
  $totalProducts = 4;
  $RANGE = mt_rand(1, (50 - $totalProducts));

  $query = makeQuery("SELECT * FROM Products WHERE ProductID BETWEEN " . $RANGE . " AND " . ($RANGE + $totalProducts - 1));
  $quesryResults = array();

  while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $quesryResults[] = array(
      "photo" => $row["ImageUrl"],
      "alt" => $row["ImageAlt"],
      "title" => substr($row["Title"], 0, 20) . " ..",
      "id" => $row["ProductID"],
      "price" => $row["Price"],
      // "category" => $row["CategoryTitle"],
      "description" => substr($row["Description"], 0, 70) . " ..."
    );
  }

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
      "title" => substr($row["Title"], 0, 20) . " ..",
      "id" => $row["ProductID"],
      "price" => $row["Price"],
      // "category" => $row["CategoryTitle"],
      "description" => substr($row["Description"], 0, 70) . " ..."
    );
  }

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
