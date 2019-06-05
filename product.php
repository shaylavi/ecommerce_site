<?php
include 'snippets/set-url.php';
include 'snippets/get-products.php';

$productId = null;
if (sizeof($_GET) > 0) {
  $productId = $_GET['id'];
}
$productDetails = fetchProduct($productId);

if ($productDetails == null) {
  header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title><?php echo $productDetails["title"]; ?> | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

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

  <div class="container flexed-container">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="col-md-4 product-image">
            <img src="<?php echo $productDetails["photo"]; ?>" alt="<?php echo $productDetails["alt"]; ?>" />
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-7 product-details" id="item-<?php echo $productDetails['id']; ?>">
            <h2><?php echo $productDetails["title"]; ?></h2>
            <h3>Price: AU$ <?php echo $productDetails["price"]; ?></h3>
            <h4><?php echo $productDetails["description"]; ?></h4>
            <div style="margin-top: 40px">
              <button class="w-40 btn btn-primary cart-btn-product-page" id="cart-id-<?php echo $productDetails['id'] ?>" onclick="addToCart(<?php echo $productDetails['id'] ?>, true)">
                Add To Cart</button>
            </div>
            <?php
            ?>

          </div>
        </div>
        <div class="col-md-2"></div>
        <div class="row">
          <div class="col-md-8 col-md-offset-2" style="margin-top: 50px;">
            <h1>Similar Products you might like:</h1>
            <?php buildHtmlSimilarProducts($productId); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>

</body>

</html>