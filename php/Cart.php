
<?php 
 
 session_start();

     /**
     * By Edwin Senunyeme
     */
     include 'connect.php';
   

     class Cart{
       
       public $items;
       public $totalQty = 0;
       public $totalPrice = 0;

    

       public function __construct($oldcart){
        // session_unset();
           if($oldcart){
              $this->items = $oldcart->items;
              $this->totalQty = $oldcart->totalQty;
              $this->totalPrice = $oldcart->totalPrice;
           }           
     	}


     public function getOldCart(){
            if(isset($_SESSION['cart'])){
                $oldcart = $_SESSION['cart'];
               return $oldcart;
                //die();
            }else{
                return null;
            }
        }

    public function addToCart($id){

        $res = $this->pullProduct($id);

        $storedItem = ['qty'=>0,'price'=>$res[0]['price'],'item'=>$res];
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $res[0]['price']*$storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice +=$res[0]['price'];
    
    }

    public function pullProduct($id){
           $connOjb = new DBConnection();
           $conn = $connOjb->getConnection();
        try{
                $stmt = $conn->prepare("SELECT * FROM products WHERE id='$id'"); 
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_ASSOC); 
                $result = $stmt->fetchAll();
                return $result;

           }catch(PDOException $e){
              echo "Error".$e->getMessage();
           }
    }


    public function getSessionItem(){
        if(isset($_SESSION['cart'])){
            var_dump($_SESSION['cart']);
            die();
        }
    }


    public function countCart(){
        if(isset($_SESSION['cart'])){
           return count($_SESSION['cart']);
        }
    }

    public function removeOne($id){
        
        $res = $this->pullProduct($id);
        $storedItem = ['qty'=>0,'price'=>$res[0]['price'],'item'=>$res];
        var_dump($res[0]['price']);
        if($this->items){
            if(array_key_exists($id,$this->items)){
                $storedItem = $this->items[$id];
            }
        }
         $storedItem['qty']--;
         $storedItem['price'] = $res[0]['price']*$storedItem['qty'];
         $this->items[$id] = $storedItem;
         $this->totalQty--;
         $this->totalPrice -=$res[0]['price'];
         //session_unset();
    }

    public function removeAllItems($id){
        $res = $this->pullProduct($id);
        $storedItem = ['qty'=>0,'price'=>$res[0]['price'],'item'=>$res];
        var_dump($res[0]['price']);
        if($this->items){
            if(array_key_exists($id,$this->items)){

                $storedItem = $this->items[$id];

                  while($storedItem['qty'] != 0){
                     $storedItem['qty']--;
                     $storedItem['price'] = $res[0]['price']*$storedItem['qty'];
                     $this->items[$id] = $storedItem;
                     $this->totalQty--;
                     $this->totalPrice -=$res[0]['price'];
                  }
            }
        } 
         
    }

    public function deleteFullCart(){
        unset($_SESSION['cart']);
        header('Location:shoppingCart.php');
        
    }
  }



 ?>