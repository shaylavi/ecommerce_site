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

    <title>Admin | Eco-Traveller | Smart, Sustainable, Environmental Friendly Store</title>

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

    <div class="container contact ">
        <h2>Add a new Product</h2>
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
                        <form id="contactForm">
                            <div class="form-group">
                                <label class="control-label requiredField" for="Title">
                                    Title<span class="asterisk">*</span>
                                </label>
                                <input class="form-control" id="Title" name="title" placeholder="Title" type="text" />
                            </div>
                            <div class="form-group ">
                                <label class="control-label requiredField" for="description">
                                    Description
                                    <span class="asterisk">
                                        *
                                    </span>
                                </label>
                                <textarea class="form-control" cols="40" id="description" name="description" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label requiredField" for="stock">
                                    Stock
                                    <span class="asterisk">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="stock" name="stock" placeholder="100" type="number" value="100"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label requiredField" for="price">
                                    Price (AUD)
                                    <span class="asterisk">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="price" name="price" placeholder="20" type="number" value="20"/>
                            </div>
                            <div class="form-group">
                                <label class="control-label requiredField" for="ImageUrl">
                                    Image Url<span class="asterisk">*</span>
                                </label>
                                <input class="form-control" id="ImageUrl" name="ImageUrl" placeholder="https://www.webiste.com/images/image1.png" type="text" />
                            </div>
                            <div class="form-group">
                                <label class="control-label requiredField" for="ImageAlt">
                                    Image Alt<span class="asterisk">*</span>
                                </label>
                                <input class="form-control" id="ImageAlt" name="ImageAlt" placeholder="Short Description of Image" type="text" />
                            </div>
                            <div class="form-group ">
                                <label class="control-label requiredField" for="select">
                                    Category
                                    <span class="asterisk">
                                        *
                                    </span>
                                </label>
                                <div class="categorySelect"></div>
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
        var data2;
        $.ajax({
            type: 'GET',
            url: 'snippets/handle-get-categories.php',
            data: 'type=raw',
            success: function(data) {
                data = JSON.parse(data)
                console.warn(data);
                var selectHtml = `<select class="select form-control" id="select" name="Category">`;
                for (var i = 0; i < data.length; i++) {
                    selectHtml += 
                        `<option value="${data[i].id}">
                            ${data[i].title}
                        </option>`;
                }
                selectHtml += `</select>`;
                $(".categorySelect").html(selectHtml);
                data2 = data;
            },
            error: function(data) {
                console.log(data);
            }
        });

        // Make an ajax call to a handle create product page which calls addProduct() (addProduct already exists)
    </script>
    <?php include 'footer.php'; ?>

</body>

</html>