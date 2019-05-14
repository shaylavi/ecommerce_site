<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>About Us | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />
  <link rel="stylesheet" href="./css/about-us-style.css" />
</head>

<body>

  <?php include 'header.php'; ?>

  <main class="about-us container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="text-center">About Us</h1>
      </div>
    </div>
    <div class="row">
      <img src="nature-image-01.jpg" alt="nature" class="rounded hero-image" data-folder="about-us">
    </div>

    <section class="container-fluid">
      <h2 class="text-left">Who are we</h2>
      <hr>
      <div class="row">
        <div class="col-md-8 ">
          <p>
            We are a non-profit business who's primary objective is to make the world
            a better place through selling only products that are environmentally friendly,
            whether this is in the way they are made, or the source of its materials.
          </p>
          <p>
            We do this to make the world a better place for all of its inhabitants and
            children to come in the future.
          </p>
        </div>
        <aside class="col-md-4">
          <img class="rounded" src="nature-image-02.jpg" data-folder="about-us">
        </aside>
      </div>
    </section>

    <section class="container-fluid">
      <h2 class="text-left">What we do</h2>
      <hr>
      <div class="row">
        <aside class="col-md-5">
          <img class="rounded" src="plastic-trash-01.jpg" data-folder="about-us">
        </aside>
        <div class="col-md-7">
          <p>
            With the help of our supporters, we are able to supply a range of eco-friendly,
            plastic free products. We work with suppliers that are eco-friendly to provide
            only the best and most trustworthy products to you.
          </p>
          <p>
            We do monthly ethical analyses to ensure our suppliers are standing to their
            eco-concious promises that they have made to us and their customers.
          </p>
        </div>
      </div>
    </section>

    <section class="container-fluid">
      <h2 class="text-left">How you can help</h2>
      <hr>
      <div class="row">
        <div class="col-md-8">
          <p>
            If you want to support a better future for our earth, you can make sure the products
            that you buy are friendly to the environment. This means products that do
            not contain any bpa plastics, are not tested on animals, and are not made with animal
            oil, meat, pelt, anything.
          </p>
          <p>
            You can also buy from us! We ensure our supplies adhere to strict policies regarding
            how the products are manufactured and the materials used in the process.
          </p>
        </div>
        <aside class="col-md-4">
          <img class="rounded" src="hiking-01.jpg" data-folder="about-us">
        </aside>
      </div>
    </section>

  </main>

  <?php include 'footer.php'; ?>

</body>

</html>