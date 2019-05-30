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
        center: [144.960652,-37.818477],
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
          y: -37.818477 +  Math.random() * range - range/2 ,
          x: 144.960652 + Math.random() * range - range/2,
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

  <div class="container ">
    <div id="viewDiv"></div>

  </div>

  <?php include 'footer.php'; ?>

</body>

</html>