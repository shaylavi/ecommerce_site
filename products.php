<?php
session_start();
include 'snippets/get-products.php';
if (sizeof($_GET) > 0) {
  $productCategory = $_GET['cat'];
} else {
  $productCategory = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>Products | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />

</head>

<body>

  <?php include 'header.php'; ?>
  <div style="height: 50px"></div>

  <div class="container">
    <div class="row">
      <div class="col-md-12 product-image">
        This line will include filters to be used
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        test
      </div>
      <div class="col-md-10">
        <div class="container-fluid">
          <?php
          buildHtmlProducts($productCategory);
          ?>
        </div>
      </div>
    </div>
  </div>

  <?php include 'footer.php'; ?>

</body>

</html>