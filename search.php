<?php
include 'snippets/set-url.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>Search | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />
  <link rel="stylesheet" href="./css/search.css" />

</head>

<body>

  <?php include 'header.php'; ?>
  <div style="height: 50px"></div>

  <div class="container search">

    <div class="col-md-12 d-flex flex-row">
      <input type="text" id="search-box" onchange="displayProducts();" class="form-control form-control-sm"><span onclick="displayProducts();" class="glyphicon glyphicon-search icon"></span>
    </div>
    <div class="col-md-12" id="results">
    </div>
  </div>

  <?php include 'footer.php'; ?>

  <script>
    function similarity(s1, s2) {
      var longer = s1;
      var shorter = s2;
      if (s1.length < s2.length) {
        longer = s2;
        shorter = s1;
      }
      var longerLength = longer.length;
      if (longerLength == 0) {
        return 1.0;
      }
      return (longerLength - editDistance(longer, shorter)) / parseFloat(longerLength);
    }

    function editDistance(s1, s2) {
      s1 = s1.toLowerCase();
      s2 = s2.toLowerCase();

      var costs = new Array();
      for (var i = 0; i <= s1.length; i++) {
        var lastValue = i;
        for (var j = 0; j <= s2.length; j++) {
          if (i == 0)
            costs[j] = j;
          else {
            if (j > 0) {
              var newValue = costs[j - 1];
              if (s1.charAt(i - 1) != s2.charAt(j - 1))
                newValue = Math.min(Math.min(newValue, lastValue),
                  costs[j]) + 1;
              costs[j - 1] = lastValue;
              lastValue = newValue;
            }
          }
        }
        if (i > 0)
          costs[s2.length] = lastValue;
      }
      return costs[s2.length];
    }



    let products = [];

    function cutString(input, maxLength = 20) {
      let strLength = input.length;

      input = input.substring(0, maxLength);

      if (strLength.length > maxLength) {
        input += "...";
      }
      return input;
    }
    let load = `
      <div class="load-container">
        <img class="load" src="load.gif">
      </div>
      `;
    let noInput = `<p>Type something in to search! </p>`;
    let errorMessage = `<p>Sorry, we couldn't find any results</p><br /><hr /><br /><span style="color:#337ab7" onclick="displayProducts();">try again...</span>`;


    function compare(a, b) {
      if (a.similarity > b.similarity) {
        return -1;
      }
      if (a.similarity < b.similarity) {
        return 1;
      }
      return 0;
    }

    function getMaterialNames(materials) {
      let output = "";
      for (let i = 0; i < materials.length; i++) {
        output += materials[i].title;
      }
      return output;
    }

    function displayProducts() {
      let searchTerm = $("#search-box").val();
      if (searchTerm === "") {
        $("#results").html(noInput);
        return;
      }
      $("#results").html(load);
      $.ajax({
        type: "GET",
        url: 'snippets/return-products-json.php',
        success: function(data) {
          try {
            products = JSON.parse(data);
          } catch (e) {
            console.warn(e);
          }
          let outputHtml = products.length > 0 ? '' : errorMessage;
          let sorted = [];


          for (let i = 0; i < products.length; i++) {
            let p = products[i];

            let weightSum = 10;
            let s = 0;

            s += similarity(p.title.toString(), searchTerm) * 10;
            s += similarity(p.id.toString(), searchTerm) * 10;
            s += similarity(p.description.toString(), searchTerm) * 4;
            s += similarity(p.materials.toString(), searchTerm) * 8;

            s /= 10;
            // Show value as less than 100
            s = s > 1 ? 1 : s;
            sorted[i] = {
              similarity: Math.ceil(s * 100),
              product: products[i]
            };
          }
          sorted.sort(compare);

          for (let i = 0; i < sorted.length; i++) {
            let p = sorted[i];
            
            let materialTags = "";
          
            for (let j = 0; j < p.product.materials.length; j++) {
              let m = p.product.materials[j];
              materialTags += `
                <span class="label label-default" style="background-color:${m.backColour}; color:${m.textColour};">
                  ${m.title}
                </span>
              `;
            }
          
            outputHtml +=
              `
            <a href="product.php?id=${p.product.id}">
              <div class="row item col-md-12 thumbnail" id="${p.product.id}">
                <div class="">
                  <img src="${p.product.photo}" alt="${p.alt}"  />
                </div>
                <div class="desc">
                  <h3>${cutString(p.product.title)}</h3>
                  <p>${materialTags}</p>
                  <p>${p.product.description}</p>
                  <p style="color:#555">${p.similarity}% match</p>
                </div>
              </div>
            </a>
            `;
          }
          $("#results").html(outputHtml);
        },
        fail: function(xhr, textStatus, errorThrown) {
          alert('request failed ', xhr, textStatus, errorThrown);
          $("#results").html(errorMessage);
        }

      });
    }
    displayProducts();
  </script>
</body>

</html>