<?php
  include 'snippets/set-url.php';
  include 'snippets/get-products.php';
$activeClass = '';
$productCategory = null;

if (sizeof($_GET) > 0) {
  $productCategory = $_GET['cat'];
} else {
  $productCategory = null;
}

function activeClassLogic($productCategory)
{
  $activeClass = '';

  if ($productCategory == null)
    $activeClass = 'active';
  else
    $activeClass = '';

  echo $activeClass;
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

  <div class="container" style="width: 90% !important;">
    <div class="row">
      <div class="col-md-12 product-image">
        <div class="col-md-3 d-flex flex-row">
          <div class="col-md-4 d-flex flex-row text-center">
            Filter by keywords:
          </div>
          <div class="col-md-8 d-flex flex-row text-left">
            <input type="text" id="text-filter" class="form-control form-control-sm">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2">
        <h4><b>Filter by category:</b></h4>
        <div class="list-group" style="margin-top:20px">
          <a href="products.php" class="list-group-item <?php activeClassLogic($productCategory); ?>">All Categories</a>
          <?php buildHtmlCategories(); ?>
        </div>
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

  <script>
    function filterProducts() {
      var products = $("div[id^=product-]");
      for (let p=0; p<products.length;p++) {
        if (products[p].innerText != undefined && products[p].innerText != '' && products[p].innerText.toString().toLowerCase().indexOf($("#text-filter").val()) < 0) {
          products[p].style.display = 'none';
        } else {
          products[p].style.display = 'block';
        }
      }
    }

    var textFilter = $("#text-filter");
    textFilter.on("keyup", filterProducts)
  </script>

  <?php include 'footer.php'; ?>

</body>

</html>