<?php
include 'snippets/get-products.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>Home | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />

</head>

<body>

  <?php include 'header.php'; ?>
  <?php include 'carousel.php'; ?>

  <div class="container-fluid bg-3 text-center" style="margin-bottom: 80px">
    <div class="container-fluid bg-3 text-center" style="margin-bottom: 80px">
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <div class="row labels">
            <div class="col-md-4 h3">
              <img src="label1.png" data-folder="" />
              Plastic free
            </div>
            <div class="col-md-4 h3">
              <img src="label2.png" data-folder="" />
              <span>Recyclable</span>
            </div>
            <div class="col-md-4 h3">
              <img src="label3.png" data-folder="" />
              <span>Eco friendly</span>
            </div>
          </div>

        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

    <div class="container-fluid text-center col-md-12">
      <h1>New Products</h1>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

          <?php
          buildHtmlNewProducts();
          ?>

        </div>
        <div class="col-md-2"></div>
      </div>
    </div>

    <div class="container-fluid text-center col-md-12" style="margin-top: 40px">
      <h1>Top Sellers</h1>
      <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">
          <div class="row">

            <?php
            buildHtmlTopSellerProducts();
            ?>

          </div>
          <div class="col-md-2">&nbsp;</div>
        </div>
      </div>
    </div>

  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
