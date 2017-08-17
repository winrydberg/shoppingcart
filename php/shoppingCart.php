<?php
   
    include 'Cart.php';
   
    if(isset($_SESSION['cart'])){
         $cart_content = $_SESSION['cart'];
         $cart_Items = $cart_content->items;
         //var_dump($cart_content);
         
         $oldCart = new  Cart($cart_content);
         $cartCount  = $oldCart->totalQty;
    }else{
         $cartCount = 0;

    }
    
    if(isset($_POST['data'])){
       $eCart = new Cart($_SESSION['cart']);
       $eCart->removeOne($_POST['data']);
    }

    if(isset($_GET['del'])){
      $delId = $_GET['del'];
      $cartObj = new  Cart($_SESSION['cart']);
      $cartObj->removeOne($delId);
      $_SESSION['cart'] = $cartObj;
      header('Location:shoppingCart.php');
    }
    if(isset($_GET['delall'])){
      $delId2 = $_GET['delall'];
      $Obj = new  Cart($_SESSION['cart']);
      $Obj->removeAllItems($delId2);
      $_SESSION['cart'] = $Obj;
      header('Location:shoppingCart.php');
    }


    if(isset($_POST['data'])){

      $ObjAll = new  Cart($_SESSION['cart']);
      $ObjAll->deleteFullCart();
   
    }

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
         <li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>  Home </a></li>
        <li><a href="shoppingCart.php"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Shopping Cart <span class="badge ">
        <?php 
          if($cartCount==null){
            echo "0";
          }else{
             echo $cartCount;
          }
         ?>
          
        </span></a></li>
       <!--  <li><a href="#">Checkout</a></li> -->
      </ul>
      </div>
    </div>
  </div>
</nav>
  </header>

  <div class="container">
 
  <?php if($cartCount  ==0): ?>
    
  <?php else:?>
      <div id="deltbn">
         <button class="btn btn-danger" onclick="deleteCart()">Delete All Items In Cart</button>
       </div>
  <?php endif;?>
  
  
  <br/>
  <?php if($cartCount  ==0): ?>
     <p class="alert alert-success">No Items In Cart</p>
  <?php else:?>
  <table class="table table-condensed table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Unit Price</th>
        <th>Quantiry</th>
        <th>Sub Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
       <?php foreach ($cart_Items as $key => $items): ?>
          <!--  <?php var_dump($items['qty']); echo "<br />";?>  --> 
            <?php if($items['qty']<=0):?>
            <?php else :?>
                <tr>
                      <td><?php echo $items['item'][0]['name'] ;?></td>
                      <td><?php echo $items['price']/$items['qty'] ;?></td>
                      <td><?php echo $items['qty'] ;?></td>
                      <td><?php echo $items['price'] ;?></td>
                      <td>
                      <a class="btn btn-sm btn-warning" href="shoppingCart.php?del=<?php echo $items['item'][0]['id']; ?>">Remove 1</a>
                      <a class="btn btn-sm btn-danger" href="shoppingCart.php?delall=<?php echo $items['item'][0]['id']; ?>">Remove All</a>
                      </td>
                 </tr> 
            <?php endif;?>
                
       <?php endforeach ?>
       <tr>
          <td colspan="4">
          <strong>Total Amount GHC: <?php echo $cart_content->totalPrice; ?></strong>
          </td>
          
        </tr> 
      
    </tbody>
  </table>
    <?php endif; ?>
  </div>


<script type="text/javascript" src="js/jquery-3.1.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
     function deleteCart(){
         $.ajax({
            url:"shoppingCart.php",
            type:"post",
            data:{data:true},
            success:function(res){
              window.location.href = "shoppingCart.php";
                 //console.log(res);
            },
            error:function(){

            }
         });
     }
    
    var cc = $cartCount;
    alert(cc);

     // if($cartCount == null | $cartCount ==0){
     //     $('#deltbn').hide();
     // }
</script>
</body>
</html>



