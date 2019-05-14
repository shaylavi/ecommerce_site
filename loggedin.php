<?php
session_start();
require_once 'snippets\\class-definitions.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Buy green - save the planet! Be part of the change." />
    <link rel="icon" href="favicon.ico" />

    <title>Logged in | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/leaves.css" />
</head>

<body>

    <?php include 'header.php'; ?>

    <div class="container">
        <div class="container d-flex flex-center " style="margin-top: 5vw;" id="alreadyLoggedIn">
            <div class="">
                <div class="btn-group w-100" role="group">
                    <button type="button" id="btn-login" class="w-100 btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        <div class="hidden-xs">Signed in</div>
                    </button>
                </div>
                <div class="well">
                    <div class="tab-pane fade in active" id="tab1">
                        <h2><?php
                            if (isset($_SESSION['customer'])) {
                                $customer = json_decode(json_encode($_SESSION['customer']));
                                echo "Welcome " . $customer->firstName . " " . $customer->lastName;
                                echo '<hr>';
                                echo '<button onclick="signOut()" class="w-100 btn btn-warning">Sign out</button>';
                            } else {
                                echo "Not signed in";
                            }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function signOut() {
            $.ajax({
                type: "POST",
                url: 'snippets\\handle-signout.php',
                success: function(data) {
                    window.location = "login.php";
                }
            });
        }
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>