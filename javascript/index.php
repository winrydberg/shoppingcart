<?php

    include 'connect.php';
    $newConnection = new DBConnection();
    $result = $newConnection->getProducts();
?>

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
        <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
        <li><a href="shoppingcart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Shopping Cart <span class="badge "  id="cartCount">0</span></a></li>
        <li><a href="#">Checkout</a></li>
      </ul>
      </div>
    </div>
  </div>
</nav>
  </header>

  <div class="container">
     <div class="row" id="product">
      <?php foreach ($result as $key => $value) { 
        // var_dump($value['name']);
       ?>
       <div class="col-md-3 ">
          <div class="item" style="border: 1px solid #ccc; border-radius: 2px;">
            <div class="item-image">
             <img src="images/<?php echo $value['image'] ?>" class="img-responsive" alt="">
            </div>
            <div class="item-title">
              <div class="row">
                <div class="col-md-12">
                <h6 style="font-weight: bold;"><?php echo $value['name'] ;?></h6>
                </div>
              </div>
             <div class="row">
              <div class="col-md-5">
                <h6 class="pull-left" style="font-weight: bold;">GHC <?php echo $value['price'] ;?></h6>
               </div>
               <div class="col-md-5">
               <button class="btn btn-success btn-sm pull-left" onclick="getProduct('<?php echo $value['id'] ?>','<?php echo $value['name'] ?>','<?php echo $value['price'] ?>','<?php echo $value['image'] ?>')"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Cart</button>
               </div>
               </div>
            </div>
          </div>
       </div>
       <?php } ;?>
     </div>
  </div>


<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/sweetalert2.js"></script>
<script type="text/javascript" src="shoppingcart.js"></script>
<script type="text/javascript">
      getCartCount();
     function getProduct(id,name,price,image){
        var cart = new Cart(id,name,price,image);
        cart.addToCart();
        getCartCount();
     }
</script>
</body>
</html>



