<div id="navbar-container">
  <nav role="navigation" class="navbar navbar-light">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="index.php"><img id="logo" src="logo.png" data-folder="" height="62" /></a>
        <a class="navbar-brand" href="index.php">
          <div class="resizeItem">Eco-Traveller</div>
        </a>
        <div class="navbar-duplicate">
          <div class="resizeItem">Eco-Traveller</div>
        </div>
      </div>
      <div id="leaves" class="navbar-right">
        <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i> <i></i>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="index.php">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" href="products.php">
            Categories<span class="caret"></span></a>
          <ul class="dropdown-menu" id="headerCategories">

          </ul>
        </li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <?php 
          if (isset($_SESSION["customer"]))
          {
            $customer = json_decode(json_encode($_SESSION['customer']));
            echo '<li><a href="loggedin.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$customer->firstName . '</a></li>';
          } else {
            echo '<li><a href="login.php">Login</a></li>';
          }
        ?>
        <li>
          <a href="cart.php"></span>
            Cart</a>
        </li>
        <li>
          <a href="search.php"><span class="glyphicon glyphicon-search"></span>
            Search</a>
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
</div>
<div id="indenter"></div>