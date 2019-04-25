<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>Title of the website</title>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

  <?php include 'header.php'; ?>
  <?php include 'carousel.php'; ?>

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
  <div class="container-fluid bg-3 text-center">
    <h1>New Products</h1>
    <div class="panel custom"></div>
  </div>
  <div class="container-fluid bg-3 text-center">
    <h1>Best Sellers</h1>
    <div class="panel custom"></div>
  </div>

  <?php include 'footer.php'; ?>

</body>
</html>
