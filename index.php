<!DOCTYPE html>
<html lang="en">
  <head>

    /*
      Deployed website version:
    https://dev.d2m2bjz9jknlcg.amplifyapp.com/

    */

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="description"
      content="Buy green - save the planet! Be part of the change."
    />
    <link rel="icon" href="favicon.ico" />

    <title>Title of the website</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
      .custom {
        border: 1px solid black;
        background-color: lightgray;
      }
      /* 
      * {
        box-sizing: border-box;
      }

      body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
      }

      .topnav {
        overflow: hidden;
        background-color: #e9e9e9;
      }

      .topnav a {
        float: left;
        display: block;
        color: black;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
      }

      .topnav a:hover {
        background-color: #ddd;
        color: black;
      }

      .topnav a.active {
        background-color: #2196f3;
        color: white;
      }

      .topnav .search-container {
        float: right;
      }

      .topnav input[type='text'] {
        padding: 6px;
        margin-top: 8px;
        font-size: 17px;
        border: none;
      }

      .topnav .search-container button {
        float: right;
        padding: 6px 10px;
        margin-top: 8px;
        margin-right: 16px;
        background: #ddd;
        font-size: 17px;
        border: none;
        cursor: pointer;
      }

      .topnav .search-container button:hover {
        background: #ccc;
      }

      @media screen and (max-width: 600px) {
        .topnav .search-container {
          float: none;
        }
        .topnav a,
        .topnav input[type='text'],
        .topnav .search-container button {
          float: none;
          display: block;
          text-align: left;
          width: 100%;
          margin: 0;
          padding: 14px;
        }
        .topnav input[type='text'] {
          border: 1px solid #ccc;
        }
      } */
      .carousel-style {
        display: flex;
        justify-content: center;
      }
      .carousel-item {
        background-size: cover !important;
        background-position: center;
        width: 100%;
        height: 600px;
      }
      .carousel-item-1 {
        background: url('https://media.istockphoto.com/photos/green-natural-beech-tree-forest-illuminated-by-sunbeams-through-fog-picture-id540390024?k=6&m=540390024&s=612x612&w=0&h=r5WY8QdFbHeT_KdS9Jd7rJFBE2belS0j9dOoP4QEsTA=');
      }
      .carousel-item-2 {
        background: url('http://www.itslyfe.com/wp-content/uploads/2018/08/ad5dd428f9d19c58613e372e4ede9c6c.jpg');
      }
      .carousel-item-3 {
        background: url('https://www.statravel.com.au/static/au_division_web_live/assets/sta-travel-default-min.jpg');
      }
      .slider-text{
        color: white;
        font-size: 47px;
        display: flex;
        flex-direction: column;
        height:100%;
        padding-left: 200px;
        padding-top: 100px;

        font-family: Arial, Helvetica, sans-serif;
      }
      .bg-4 { 
  background-color: #2f2f2f;
  color: #ffffff;
}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-default" style="margin-bottom: 0px">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Logo goes here</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Page 1</a></li>
          <li><a href="#">Page 2</a></li>
          <li><a href="#">Page 3</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"
              >Page 1 <span class="caret"></span
            ></a>
            <ul class="dropdown-menu">
              <li><a href="#">Page 1-1</a></li>
              <li><a href="#">Page 1-2</a></li>
              <li><a href="#">Page 1-3</a></li>
            </ul>
          </li>
          <li>
            <a href="#"
              ><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a
            >
          </li>
          <li>
            <a href="#"
              ><span class="glyphicon glyphicon-search"></span> Search</a
            >
          </li>
          <!-- <form class="navbar-form navbar-right" action="/action_page.php">
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Search" name="search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
              </form> -->
        </ul>
      </div>
    </nav>
      <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-bottom: 40px">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner carousel-style">
          <div class="item active carousel-item carousel-item-1">
              <div class="slider-text">
                  <div style="font-size:47px"><b>Title</b></div>
                  <div style="font-size:40px">
                      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ac feugiat sed lectus vestibulum mattis ullamcorper velit. Amet tellus cras adipiscing enim.
                  </div>
              </div>
            </div>

          <div class="item carousel-item carousel-item-2"></div>

          <div class="item carousel-item carousel-item-3"></div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    <div class="container-fluid bg-3 text-center" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">

                <div class="row">
                    <div class="col-md-4">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span>Recycle</span>
                    </div>
                    <div class="col-md-4">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span>Portable</span>
                      </div>
                    <div class="col-md-4"> 
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span>Eco friendly</span>
                      </div>
                  </div>
        
            </div>
            <div class="col-md-2"></div>
          </div>
    </div>
    <div class="container-fluid bg-3 text-center">
        <h1>NEW PRODUCTS</h1>
        <div class="panel" style="border:3px solid black; height:350px"></div>
      </div>
      <div class="container-fluid bg-3 text-center">
          <h1>BEST SELLERS</h1>
          <div class="panel" style="border:3px solid black; height:350px"></div>
        </div>
      <footer class="container-fluid bg-4 text-center">
        <div class="row">
            <div class="col-md-6 text-left">
                <p><h4>HEADING</h2></p>
                <p><h6>aslja soidj asdj aslkdaslkdsalkdsad<br/>
                  alfnoas naosdm asdsakldm aslkdas </h2></p>
              </div>
            <div class="col-md-6 text-center">
                <div class="col-md-6 text-center">
                    <div style="padding: 15px">
                        Photo of something1
                      </div>
                      <div style="padding: 15px">
                          Photo of something2
                        </div>
                    </div>
                <div class="col-md-6 text-center">
                    <div style="padding: 15px">
                        Photo of something3
                      </div>
                      <div style="padding: 15px">
                          Photo of something4
                        </div>
                      </div>
                    </div>
                  </div>

                </footer>
    </body>
</html>
