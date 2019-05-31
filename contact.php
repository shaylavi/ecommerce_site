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

  <title>Contact Us | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    #viewDiv {
      height: 100%;
      width: 100%;
      min-height: 500px;
    }
  </style>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />
  <link rel="stylesheet" href="https://js.arcgis.com/4.11/esri/css/main.css">
  <script src="https://js.arcgis.com/4.11/"></script>
  <script>
    require([
      "esri/Map",
      "esri/views/MapView",
      "esri/layers/GraphicsLayer",
      "esri/Graphic"
    ], function(Map, MapView, GraphicsLayer, Graphic) {
      var symbol = {
        type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        style: "square",
        color: "blue",
        size: "8px", // pixels
        outline: { // autocasts as new SimpleLineSymbol()
          color: [255, 255, 0],
          width: 3 // points
        }
      };

      var map = new Map({
        basemap: "topo-vector"
      });

      var view = new MapView({

        container: "viewDiv",
        map: map,
        center: [144.960652, -37.818477],
        zoom: 15
      });
      var graphicsLayer = new GraphicsLayer();
      map.add(graphicsLayer);
      var points = [];
      var plength = 100;
      var range = .01;
      for (var i = 0; i < plength; i++) {

        points[i] = {
          type: "point", // autocasts as new Point()
          y: -37.818477 + Math.random() * range - range / 2,
          x: 144.960652 + Math.random() * range - range / 2,
          z: 1010
        };
      }
      markerSymbol = {
        type: "simple-marker", // autocasts as new SimpleMarkerSymbol()
        color: [226, 119, 40],
        outline: {
          // autocasts as new SimpleLineSymbol()
          color: [255, 255, 255],
          width: 2
        }
      };
      for (let i = 0; i < plength; i++) {
        let pointGraphic = new Graphic({
          geometry: points[i],
          symbol: markerSymbol
        });

        graphicsLayer.add(pointGraphic);
      }

    });
  </script>
</head>

<body>

  <?php include 'header.php'; ?>
  <div style="height: 50px"></div>
  <h1 class="text-center"> Contact Us </h1>
  <div class="container contact">
    <h2>Find us</h2>
    <hr />
    <div class="row">
      <div class="col-md-6">
        <div id="viewDiv"></div>
      </div>
      <div class="col-md-6">
        <div class="row mb-2 d-flex flex-center">
          <img src="point.png" class="icon col-md-3">
          <div class="col-md-7">123 Fake Street<br />Melbourne, Australia</div>
        </div>
        <div class="row mb-2 d-flex flex-center">
          <img class="icon col-md-3" src="phone.svg">
          <div class="col-md-7">(01) 2345 6789</div>
        </div>
      </div>
    </div>
    <div class="container contact ">
      <h2>Leave a message</h2>
      <hr />
      <div class="row d-flex flex-center">
        <div class="col-md-6 m-auto">
          <style>
            .asterisk {
              color: red;
            }
          </style>

          <div class="container-fluid">
            <div class="row">
              <form id="contactForm" >
                <div class="form-group">
                  <label class="control-label requiredField" for="firstName">
                    First Name<span class="asterisk">*</span>
                  </label>
                  <input class="form-control" id="firstName" name="firstName" placeholder="First Name" type="text" />
                </div>
                <div class="form-group">
                  <label class="control-label requiredField" for="email">
                    Email
                    <span class="asterisk">
                      *
                    </span>
                  </label>
                  <input class="form-control" id="email" name="email" placeholder="example@mail.com" type="text" />
                </div>
                <div class="form-group ">
                  <label class="control-label requiredField" for="select">
                    Subject
                    <span class="asterisk">
                      *
                    </span>
                  </label>
                  <select class="select form-control" id="select" name="topic">
                    <option value="Question">
                      Question
                    </option>
                    <option value="Job Application">
                      Job Application
                    </option>
                    <option value="Other">
                      Other
                    </option>
                  </select>
                </div>
                <div class="form-group ">
                  <label class="control-label requiredField" for="message">
                    Message
                    <span class="asterisk">
                      *
                    </span>
                  </label>
                  <textarea class="form-control" cols="40" id="message" name="message" rows="10"></textarea>
                </div>
                <div class="form-group">
                  <div>
                    <button class="btn btn-primary " name="submit" type="submit">
                      Submit
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
      <script>
        $('#contactForm').submit(function(e) {
          var before = $("#contactForm").html();
          $("#contactForm").html('<img src="load.gif" style="width:100px; height:auto;">');
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: 'snippets/email-send.php',
            data: $(this).serialize(),
            success: function(data) {
              console.log(data);
              if (data == "" ) {
                $('#contactForm').html(before);

              } else {
                $('#contactForm').html("<h2>Thank you, we'll get back to you!</h2>");
              }
            },
            error: function(data) {
              $('#contactForm').html("<h2>Something went wrong! Try again later...</h2>");
            }
          
          });
        });
      </script>
      <?php include 'footer.php'; ?>

</body>

</html>