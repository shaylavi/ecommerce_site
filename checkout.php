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

  <title>Checkout | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="assets/jquery.payform.min.js" charset="utf-8"></script>

  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />

</head>

<body>

  <?php include 'header.php'; ?>
  <div style="height: 50px"></div>

  <div class="container-fluid col-md-offset-1" style="min-height: 61vh">
    <div class="row">
      <div class="col-md-12">
        <div id='checkout-content'>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
    var connectedUser = <?php
                        if (isset($_SESSION['customer'])) {
                          echo json_encode($_SESSION['customer']);
                        } else {
                          echo '""';
                        }
                        ?>;

    var checkoutPanel = '';
    var payment = `
          <h3>${(connectedUser === '') ? 'Thank you guest' : 'Hello ' + connectedUser.firstName},</h3>
          <div class="creditCardForm">
    <div class="heading">
        <h2>Please Confirm Purchase</h2>
    </div>
    <div class="payment">
        <form>
            <div class="form-group owner">
                <label for="owner">Owner</label>
                <input type="text" class="form-control" id="owner">
            </div>
            <div class="form-group CVV">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv">
            </div>
            <div class="form-group" id="card-number-field">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber">
            </div>
            <div class="form-group" id="expiration-date">
                <label>Expiration Date</label>
                <select>
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <select>
                    <option value="16"> 2016</option>
                    <option value="17"> 2017</option>
                    <option value="18"> 2018</option>
                    <option value="19"> 2019</option>
                    <option value="20"> 2020</option>
                    <option value="21"> 2021</option>
                </select>
            </div>
            <div class="form-group" id="credit_cards">
                <img src="assets/visa.jpg" id="visa">
                <img src="assets/mastercard.jpg" id="mastercard">
                <img src="assets/amex.jpg" id="amex">
            </div>
            <div class="form-group" id="pay-now">
                <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
            </div>
        </form>
    </div>
</div>
          `;

    function BuildCheckout() {
      var oReq = new XMLHttpRequest();
      oReq.open('GET', 'snippets/get-cart.php');
      oReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      oReq.addEventListener('load', PopulatePage);
      oReq.addEventListener('error', function(data) {
        console.error(data);
      });

      oReq.send();
    }

    function ActivatePayform() {
      var owner = $('#owner'),
        cardNumber = $('#cardNumber'),
        cardNumberField = $('#card-number-field'),
        CVV = $("#cvv"),
        mastercard = $("#mastercard"),
        confirmButton = $('#confirm-purchase'),
        visa = $("#visa"),
        amex = $("#amex");

      cardNumber.payform('formatCardNumber');
      CVV.payform('formatCardCVC');

      cardNumber.keyup(function() {
        amex.removeClass('transparent');
        visa.removeClass('transparent');
        mastercard.removeClass('transparent');

        if ($.payform.validateCardNumber(cardNumber.val()) == false) {
          cardNumberField.removeClass('has-success');
          cardNumberField.addClass('has-error');
        } else {
          cardNumberField.removeClass('has-error');
          cardNumberField.addClass('has-success');
        }

        if ($.payform.parseCardType(cardNumber.val()) == 'visa') {
          mastercard.addClass('transparent');
          amex.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'amex') {
          mastercard.addClass('transparent');
          visa.addClass('transparent');
        } else if ($.payform.parseCardType(cardNumber.val()) == 'mastercard') {
          amex.addClass('transparent');
          visa.addClass('transparent');
        }
      });

      confirmButton.click(function(e) {
        e.preventDefault();

        var isCardValid = $.payform.validateCardNumber(cardNumber.val());
        var isCvvValid = $.payform.validateCardCVC(CVV.val());

        if (owner.val().length < 5) {
          alert("Wrong owner name");
        } else if (!isCardValid) {
          alert("Wrong card number");
        } else if (!isCvvValid) {
          alert("Wrong CVV");
        } else {
          alert("Thank you for buying with us!");
          window.location.replace("index.php");
          // TODO: Write order to the DB
        }
      });
    }

    function SigninHandler() {
      $(".signin").animate({
        height: "toggle",
        opacity: "toggle"
      }, 400, function() {
        $('#paymentStep')[0].innerText = '';
        $('#paymentStep').append(payment);

        ActivatePayform();
      });
    }

    function PopulatePage(data) {
      if (data.currentTarget.status === 200 && data.currentTarget.responseText !== null && data.currentTarget.responseText !== '') {
        var cartList = JSON.parse(data.currentTarget.responseText);
        if (cartList.length <= 0) {

          checkoutPanel = `
            <div class="flexed-container">
              <h1>Your cart is empty</h1>
            </div>
            `;
          $('#checkout-content').append(checkoutPanel);

        } else {

          var cartList = JSON.parse(data.currentTarget.responseText);
          if (cartList.length > 0) {
            var totalPrice = 0;
            var totalItems = 0;
            var products = '';
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
                  totalItems += parseInt(p.qty)

                  products += `
                    <div class="col-md-12 text-left" style="margin: 8px 0 5px 0" id="product-tr-${product.id}">
                      <div style="display:flex; flex-flow:row; justify-content: space-between; align-items: center" class="text-right">
                        <div>
                          <img src="${product.photo}" style="max-width: 90px; max-height: 90px;" />
                        </div>
                        <div>
                          ${p.qty} x ${product.title}
                        </div>
                        <div>
                          AU$ ${(product.price.indexOf('.') >= 0 ? product.price : product.price + '.00')}
                        </div>
                      </div>
                    </div>
                  `;

                  if (itemsProcessed === array.length) {
                    let price = `
                  AU$ ${(totalPrice.toString().indexOf('.') >= 0 ? totalPrice : totalPrice + '.00')}</b></td>
                  `;
                    $('#checkout-content').append(checkoutPanel);
                    $("#total-cart-items").append(totalItems);
                    $("#products-placeholder").append(products);
                    $("#price1-placeholder").append(price);
                    $("#price2-placeholder").append(price);

                    if (connectedUser !== '')
                      ActivatePayform();
                  }
                } else console.error('error code - ' + data.currentTarget.status + '. Text - ' + e.currentTarget.statusText);
              });

              oReq.addEventListener('error', function(data) {
                console.error(data);
              });

              oReq.send("item=" + p.value);

            });
          }

          let signin = `
            <tr class="signin">
              <td>
                Checking out as a <b>Guest</b>? You'll be able to save your details to create an account with us later.
              </td>
            </tr>
            <tr class="signin">
              <td>
                <div class="form-group">
                  <label for="inputEmail" class="control-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail" data-error="Bruh, that email address is invalid" required style="max-width:250px">
                </div>
                <button class="btn btn-primary" name="submit" type="button" onclick="SigninHandler()">
                  Continue as Guest
                </button>
              </td>
            </tr>
            <tr class="signin">
              <td>
                Already have an account?<a href="login.php"> Sign in now</a>
              </td>
            </tr>
          `;

          let customer = `
          <div class="row">
            <div class="col-md-12">
            </div>
          </div>
          <form data-toggle="validator" role="form">
            <table style="width:max-width">
              <tr>
                <td>
                  <h2>❶ Customer ${(connectedUser === '') ? '' : (' - <font style="font-size:22px;font-weight:light">Connected as ' + connectedUser.firstName + ' ' + connectedUser.lastName + '</font>')}</h2>
                </td>
              </tr>
              ${(connectedUser === '') ? signin : ''}
              <tr>
                <td>
                <hr />
                  <h2>❷ Payment</h2>
                </td>
              </tr>
              <tr>
                <td>
                  <div id="paymentStep">
                    ${(connectedUser === '') ? 'Please finish step one to proceed.' : payment }
                  </div>
                </td>
              </tr>
            </table>
          </form>
          `;

          checkoutPanel = `
          <div class="flexed-container" style="align-items: flex-start !important;margin-top:30px">
          <div class="col-md-6">
            ${customer}
          </div>
          <div class="col-md-1">
          </div>
          <div class="col-md-5">
            <div class="panel panel-default">
              <div class="panel-body" style="margin: 20px">

                <div class="row">
                  <div class="col-md-6 text-left" style="font-size:16px;font-weight:bold">
                    <b>Order Summary</b>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="cart.php">Edit Cart</a>
                  </div>
                </div>

                <div class="row">
                  <hr width="90%" />
                </div>

                <div class="row">
                  <div class="col-md-12 text-left">
                      <p> <span id="total-cart-items"></span> Items <p />
                  </div>
                  <div id="products-placeholder"></div>
                </div>

                <div class="row">
                  <hr width="90%" />
                </div>

                <div class="row">
                  <div class="col-md-6 text-left">
                    <b>Subtotal</b>
                  </div>

                  <div class="col-md-6 text-right">
                    <div id="price1-placeholder"></div>
                  </div>
                </div>

                <div class="row" style="margin-top:10px">
                  <div class="col-md-6 text-left">
                    Shipping
                  </div>

                  <div class="col-md-6 text-right">
                    FREE!
                  </div>
                </div>

                <div class="row" style="margin-top:10px">
                  <div class="col-md-6 text-left">
                    Taxes
                  </div>

                  <div class="col-md-6 text-right">
                    AU$ 0.00
                  </div>
                </div>

                <div class="row">
                  <hr width="90%"/>
                </div>

                <div class="row" style="margin-top:10px">
                  <div class="col-md-6 text-left">
                    Total
                  </div>

                  <div class="col-md-6 text-right" style="font-size:25px;font-weight:bold">
                    <div id="price2-placeholder"></div>
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
        `;

        }
      } else console.error('error code - ' + data.currentTarget.status + '. Text - ' + e.currentTarget.statusText);
    }

    BuildCheckout();
  </script>
  <?php include 'footer.php'; ?>

</body>

</html>