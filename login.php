<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Buy green - save the planet! Be part of the change." />
  <link rel="icon" href="favicon.ico" />

  <title>Login | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/style.css" />
  <link rel="stylesheet" href="./css/leaves.css" />
</head>

<body>

  <?php include 'header.php'; ?>


  <div class="container d-flex flex-center" style="margin-top: 5vw;">
    <div class="col-lg-6 col-sm-6">
      <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
        <script lang="javascript">
          function clearText() {
            var textBoxes = $(".do-clear");
            for(var i = 0; i < textBoxes.length; i++) {
              textBoxes[i].value = "";
            };
          }
          function swapPrimary() {
            
            if ($("#btn-login").hasClass("btn-primary")) {
              $("#btn-login")[0].classList.remove("btn-primary");
              $("#btn-login")[0].classList.add("btn-default");
              $("#btn-register")[0].classList.add("btn-primary");
              $("#btn-register")[0].classList.remove("btn-default");
            } else {
              $("#btn-login")[0].classList.add("btn-primary");
              $("#btn-login")[0].classList.remove("btn-default");
              $("#btn-register")[0].classList.add("btn-default");
              $("#btn-register")[0].classList.remove("btn-primary");
            }
          }
        </script>
        <div class="btn-group" role="group">
          <button type="button" id="btn-login" class="btn btn-primary" href="#tab1" onclick="swapPrimary()" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <div class="hidden-xs">Sign in</div>
          </button>
        </div>
        <div class="btn-group" role="group">
          <button type="button" id="btn-register" class="btn btn-default" href="#tab2" onclick="swapPrimary()" data-toggle="tab"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
            <div class="hidden-xs">Register</div>
          </button>
        </div>
      </div>

      <div class="well">
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab1">
            <div class="container-fluid">
              <form class="form-horizontal col-md-12" id="loginform" method="post">
                <div class="form-group">
                  <label class="control-label" for="email">Email</label>
                  <input name="email" type="text" class="form-control" id="email" aria-describedby="emailStatus">

                </div>
                <div class="form-group ">
                  <label class="control-label" for="password">Password</label>
                  <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordStatus">
                </div>
                <div class="form-group ">
                  <input value="Sign in" type="submit" class="w-100 btn btn-primary" />
                </div>
                <div class="form-group">
                  <label class="control-label" id="passwordFailedNotice" style="color:red;"></label>
                </div>
              </form>
            </div>
          </div>
          <div class="tab-pane fade in" id="tab2">
            <div class="container-fluid">
              <form class="form-horizontal col-md-12" id="registerform" method="post">
                <div class="form-group">
                  <label class="control-label" for="register-firstname">First Name</label>
                  <input name="firstname" type="text" class="form-control do-clear" id="register-firstname" aria-describedby="">
                </div>
                <div class="form-group">
                  <label class="control-label" for="register-lastname">Last Name</label>
                  <input name="lastname" type="text" class="form-control do-clear" id="register-lastname" aria-describedby="">
                </div>
                <div class="form-group ">
                  <label class="control-label" for="register-email">Email</label>
                  <input name="email" type="text" class="form-control do-clear" id="register-email" aria-describedby="emailStatus">
                </div>
                <div class="form-group ">
                  <label class="control-label" for="register-password">Password</label>
                  <input name="password" type="password" class="form-control do-clear" id="register-password" aria-describedby="passwordStatus">
                </div>
                <div class="form-group ">
                  <input value="Register" type="submit" class="col-md-9 btn btn-primary" />
                  <input value="Clear" type="button" onclick="clearText();" class="col-md-2 pull-right btn btn-default" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <script>
      $(document).ready(function() {
        $('#loginform').submit(function(e) {
          $("#passwordFailedNotice").html("");
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: 'snippets\\handle-login.php',
            data: $(this).serialize(),
            success: function(data)
            {
              data = JSON.parse(data);
              console.log(data);
              if (data.success) {
                location.replace("https://www.w3schools.com");
              } else {
                $("#passwordFailedNotice").html(data.message);
              }
            }
          });
        });
       
        $('#registerform').submit(function(e) {
          e.preventDefault();
          $.ajax({
            type: "POST",
            url: 'snippets\\handle-register.php',
            data: $(this).serialize(),
            success: function(data)
            {
              data = JSON.parse(data);
              console.log(data);
              
            }
          });
        });
      });
      </script>
  </div>


  <?php include 'footer.php'; ?>

</body>

</html>