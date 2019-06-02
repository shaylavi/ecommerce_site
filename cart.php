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

  <title>Shopping Cart | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

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

  <div class="container-fluid" style="min-height: 61vh">
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <table style="width:100%" id="products-cart">
          <caption>
            <h1>Your Shopping Cart</h1>
          </caption>
          <tr>
            <td>
              <h4>Product</h4>
            </td>
            <td style="width:10%; text-align:center">
              <h4>Qty</h4>
            </td>
            <td style="width:10%; text-align:center">
              <h4>Remove</h4>
            </td>
            <td style="width:10%; text-align:center">
              <h4>Total</h4>
            </td>
          </tr>
          <tr>
            <td colspan=4>
              <hr style="width:100%; align: center; border-color: green" />
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <script>
    function BuildCart() {

      var oReq = new XMLHttpRequest();
      oReq.open('GET', 'snippets/get-cart.php');
      oReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      oReq.addEventListener('load', GetCartData);
      oReq.addEventListener('error', function(data) {
        console.error(data);
      });

      oReq.send();

    }

    function GetCartData(data) {
      if (data.currentTarget.status === 200 && data.currentTarget.responseText !== null && data.currentTarget.responseText !== '') {

        var cartList = JSON.parse(data.currentTarget.responseText);
        if (cartList.length > 0) {
          var totalPrice = 0;
          aggregatedCart = new Array();

          if (cartList.length > 1) {
            cartList.reduce(function(res, value) {
              if (res != undefined)
                aggregatedCart.push({
                  value: res,
                  qty: 1
                });

              let searchRes = aggregatedCart.find((sval) => {
                if (sval.value == value) return sval;
              });
              if (searchRes != undefined && searchRes != null)
                searchRes.qty += 1;
              else
                aggregatedCart.push({
                  value: value,
                  qty: 1
                });

            });
          } else {
            aggregatedCart.push({
              value: cartList[0],
              qty: 1
            });
          }

          var itemsProcessed = 0;
          aggregatedCart.forEach((p, index, array) => {
            var oReq = new XMLHttpRequest();
            oReq.open('POST', 'snippets/get-product-ajax.php');
            oReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            oReq.addEventListener('load', function(prodResult) {
              if (prodResult.currentTarget.status === 200 && prodResult.currentTarget.responseText !== null && prodResult.currentTarget.responseText !== '') {
                itemsProcessed++;
                let product = JSON.parse(prodResult.currentTarget.responseText);
                totalPrice += parseFloat(product.price) * p.qty;

                let html = `
          <tr id="product-tr-${product.id}">
            <td>
              <div style="display:flex;flex-flow:row; align-items:center">
                <div style="min-width:160px">
                  <img src="${product.photo}" class="thumbnail" style="max-height: 120px; max-width: 120px" />
                </div>
                <div>
                  ${product.title}
                </div>
              </div>
            </td>
            <td style="display:flex; flex-flow: row; justify-content: center; margin-top: 30px">
              <div class="qty-div">
                <input type="textbox" class="qty-input" id="qty-input-${product.id}" value="${p.qty}" /><br/>
                <a onclick="javascript:GetCartQty('${product.id}')">Update</a>
              </div>
            </td>
            <td style="text-align:center">
              <a onclick="javascript:RemoveProduct('${product.id}')"><i class="fa fa-times-circle fa-2x" style="color: gray"></i></a>
            </td>
            <td style="text-align:center; font-weight: bold">
              AU$ ${(product.price.indexOf('.') >= 0 ? product.price : product.price + '.00')}
            </td>
          </tr>
          <tr id="product-hr-${product.id}"><td colspan=4><hr /></td></tr>
          `;
                $("#products-cart").append(html);

                if (itemsProcessed === array.length) {
                  let html = `
                  <tr>
                    <td></td>
                    <td colspan="2">
                      <b>Estimated Total:</b>
                    </td>
                    <td><b>AU$ ${(totalPrice.toString().indexOf('.') >= 0 ? totalPrice : totalPrice + '.00')}</b></td>
                    </tr>
                  <tr>
                  <td></td>
                  <td colspan="3"><button class="w-100 btn btn-success" style="padding:20px; font-size:24px" onclick="window.location=\'checkout.php\'">Checkout</button></td>
                  </tr>
                </table>`;
                  $("#products-cart").append(html);
                }
              } else console.error('error code - ' + data.currentTarget.status + '. Text - ' + e.currentTarget.statusText);
            });

            oReq.addEventListener('error', function(data) {
              console.error(data);
            });

            oReq.send("item=" + p.value);

          });
        } else {
          let html = `
                  <tr>
                    <td colspan="4" style="text-align: center; color: lightgray">
                      <h1>No items in the cart</h1>
                    </td>
                    </tr>
                </table>`;
          $("#products-cart").append(html);
        }
      } else console.error('error code - ' + data.currentTarget.status + '. Text - ' + e.currentTarget.statusText);
    }

    function GetCartQty(itemId) {
      let qty = document.getElementById('qty-input-' + itemId).value;
      if (qty == '0') RemoveProduct(itemId);
      else UpdateCart(itemId, qty);
    }

    function RemoveProduct(elementId) {
      UpdateCart(elementId, 0);

      $('#product-tr-' + elementId).remove();
      $('#product-hr-' + elementId).remove();
    }

    function UpdateCart(productId, qty) {
      var oReq = new XMLHttpRequest();
      oReq.open('POST', 'snippets/update-cart.php');
      oReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      oReq.addEventListener('load', function() {
        console.log("Cart updated");
        location.reload();
      });
      oReq.addEventListener('error', function(data) {
        console.error(data);
      });

      oReq.send(`id=${productId}&qty=${qty}`);
    }

    BuildCart();
  </script>
  <?php include 'footer.php'; ?>

</body>

</html>