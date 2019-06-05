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

    <?php include 'header.php';
    include 'db-connection.php';

    $token = null;
    $changingPassword = false;

    if (sizeof($_GET) > 0) {
        $token = $_GET['token'];
        $changingPassword = true;
    }
    if ($token == null) {
        $changingPassword = false;

        //header("Location:index.php");
    }
    ?>

    <div class="container">

        <div class="container d-flex flex-center " style="margin-top: 5vw;">

            <div class="btn-group " role="group">
                <button type="button" id="btn-login" class="w-100 btn btn-primary" href="#tab1" data-toggle="tab"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    <div class="hidden-xs">Change Password</div>
                </button>

                <div class="well" id="NewPassword">
                    <div class="tab-pane fade in active" id="tab1">
                        <h2>
                            Reset your password
                        </h2>
                        <hr>

                        <div id="load"></div>
                        <?php if ($changingPassword) {
                            echo ' 
                            <form class="" id="resetPassword" method="post">

                            <div class="form-group ">
                                <label class="control-label" for="password">New Password</label>
                                <input name="password" type="password" class="form-control" id="password" aria-describedby="passwordStatus">
                            </div>

                            <div class="form-group ">
                                <label class="control-label" for="passwordVerify">Verify Password</label>
                                <input type="password" class="form-control" id="passwordVerify" aria-describedby="passwordStatus">
                            </div>
                            <hr>
                            <button type="submit" class="w-100 btn btn-warning">Reset Password</button>

                            <div class="form-group">
                                <label class="control-label" id="FailedNotice" style="color:red;"></label>
                            </div>
                        </form>
                            ';
                        } else {
                            echo '<form class="" id="sendEmail" method="post">
                            <div class="form-group ">
                                <label class="control-label" for="email">Email Address</label>
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="passwordStatus">
                            </div>
                            <hr>
                            <button type="submit" class="w-100 btn btn-warning">Send Email</button>

                            <div class="form-group">
                                <label class="control-label" id="FailedNotice" style="color:red;"></label>
                            </div>
                        </form>';
                        }
                        ?>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var token = '<?php echo $token ?>';
        var loadIcon = `<img src="load.gif" style="width:100px; height:100px;">`;
        var pathname = window.location.href;

        $('#resetPassword').submit(function(e) {
            if ($("#passwordVerify").val() == $("#password").val()){
                $("#load").html(loadIcon);
                $('#resetPassword').hide();
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'snippets/handle-password-reset.php',
                    data: $(this).serialize() + "&token=" + token,
                    success: function(data) {
                        $('#resetPassword').show();
                        $("#load").html("");
                        console.log(data);
                        if (data != 200) 
                            alert(data);
                        else
                            alert("Success");
                    }
                });
            }
        });

        $('#sendEmail').submit(function(e) {
            $("#load").html(loadIcon);
            $('#sendEmail').hide();
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: 'snippets/handle-send-verification-email.php',
                data: $(this).serialize() + "&path="+pathname,
                success: function(data) {
                    $('#sendEmail').show();
                    $("#load").html("");
                    console.log(data);
                    if (data != 200) {
                        console.log(data);
                        alert("Something went wrong!");}
                    else
                        alert("Success");
                }
            });
        });
    </script>
    <?php include 'footer.php'; ?>
</body>

</html>