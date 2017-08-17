<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

  <header id="header" class="header-section">
      <nav class="navbar navbar-inverse" style="border-radius: 0px; height: 50px;">
  <div class="container-fluid" >
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#iessnav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <div class="collapse navbar-collapse" id="iessnav">
      <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a></li>
        <li><a href="shoppingcart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Shopping Cart </a></li>
       
      </ul>
      </div>
    </div>
  </div>
</nav>
  </header>


  <div class="container" >
      <div id="emptyCart">
        
      </div>
      <table id="cartTable" class="table table-bordered table-hover table-striped">
        <thead>
          <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Product Qty</th>
            <th>Product Unit Price(GHC)</th>
            <th>Sub Total(GHC)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="tbody">
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
        </tbody>
      </table>
  </div>


<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript">
  getCartItems();
</script>
<script type="text/javascript">

</script>
</body>
</html>