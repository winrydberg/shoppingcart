
function Product(id,name,price,image,qty, tp){
  this.id = id;
  this.name = name;
  this.price = price;
  this.image = image;
  this.qty = qty;
  this.totalPrice = tp;
            this.getId = function(){
              return this.id;
            };
            this.getName = function(){
              return this.name;
            };
            this.getPrice = function(){
              return this.price;
            };
            this.getQty=function(){
              return this.qty;
            };
            this.getImage = function(){
              return this.image;
            }
            this.addQty = function(){
              return this.qty +=1;
            }
            this.subQty = function(){
              return this.qty -=1;
            }
            this.getTotalPrice = function(){
              return this.totalPrice;
            }
            this.calcTotalPrice = function(){
              return this.price*this.qty;
            }
}

function Cart(id,name,price,image){
    this.id = id;
    this.name = name;
    this.price = price;
    this.image = image;
    this.addToCart = function(){
         if(checkBroswerStorage() !==false){
          if(localStorage.getItem('cart')==null){
            var cartArray = [];
            var item = new Product(this.id,this.name,this.price,this.image,1,this.price);
            cartArray.push(JSON.stringify(item));
            localStorage.setItem("cart", JSON.stringify(cartArray));
          }
          else{
                var mycart = localStorage.getItem('cart');
                var cartA = JSON.parse(mycart);
                var exist = false;
                var newArray = [];
                for(var i=0;i<cartA.length;i++){
                    var oneItem = JSON.parse(cartA[i]);
                    if(parseInt(this.id) === parseInt(oneItem.id)){
                      exist = true;
                      myPro = new Product(oneItem.id,oneItem.name,oneItem.price,oneItem.image,oneItem.qty,oneItem.totalPrice);
                      oneItem.qty = myPro.addQty();
                      oneItem.totalPrice = myPro.calcTotalPrice();
                      newArray.push(JSON.stringify(oneItem));
                    }else{
                      newArray.push(JSON.stringify(oneItem));
                    }
                }
                if(exist == false){
                     newPro = new Product(this.id,this.name,this.price,this.image,1,this.price);
                     newArray.push(JSON.stringify(newPro));
                }
               localStorage.setItem("cart",JSON.stringify(newArray)); 
          }
       }     
    }  
}

function getCartItems(){
         if(checkBroswerStorage() !==false){
          if(localStorage.getItem('cart')==null){
          }else{
                var mycartArray = JSON.parse(localStorage.getItem('cart'));
                var table = document.getElementById("cartTable");
                if(mycartArray.length==0){
                     $('#cartTable').hide();
                     var emptyAlert = '<p class="alert alert-success">No Items In Cart. Please add Items to cart</p>';
                     $('#emptyCart').append(emptyAlert);
                }else{
                     for(var i=0;i<mycartArray.length;i++){
                      var singleItem = JSON.parse(mycartArray[i]);
                      if(singleItem['qty']==0){
                        continue;
                      }else{
                      var itm = `
                          <tr>
                                <td><img src="images/`+singleItem['image']+`" width="50px"></td>
                                <td>`+singleItem['name']+`</td>
                                <td>`+singleItem['qty']+`</td>
                                <td>`+singleItem['price']+`</td>
                                <td>`+singleItem['totalPrice']+`</td>
                                <td>
                                <button type="button" onclick="removeItem(`+singleItem['id']+`)" class="btn btn-sm btn-warning">Remove One</button>
                                <button type="button" onclick="removeAll(`+singleItem['id']+`)" class="btn btn-sm btn-danger">Remove All</button>
                                </td>
                          </tr>
                         `;
                         $('#tbody').append(itm);
                      }
                  }
               }
          }
      }
    }


function removeAll(id){
          if(localStorage.getItem('cart')==null){
          }else{
               var mycartArray = JSON.parse(localStorage.getItem('cart'));
               var newArray =[];
               for(var i=0;i<mycartArray.length;i++){
                      groupItem = JSON.parse(mycartArray[i]);
                      if(id == groupItem['id']){
                         continue;
                      }else{
                        myPro = new Product(groupItem['id'],groupItem['name'],groupItem['price'],groupItem['image'],groupItem['qty'],groupItem['totalPrice']);
                        newArray.push(JSON.stringify(myPro));
                      }
                 }
                localStorage.setItem("cart",JSON.stringify(newArray));
                window.location.href="shoppingcart.php";               
          }
}

function removeItem(id){     
          if(localStorage.getItem('cart')==null){
            
          }else{
               var mycartArray = JSON.parse(localStorage.getItem('cart'));
               var newArray =[];
               for(var i=0;i<mycartArray.length;i++){
                      groupItem = JSON.parse(mycartArray[i]);
                      if(id == groupItem['id']){
                          if(groupItem['qty']-1 == 0){
                            continue;
                          }else{
                               myPro = new Product(groupItem['id'],groupItem['name'],groupItem['price'],groupItem['image'],groupItem['qty']-1,(groupItem['qty']-1)*(groupItem['price']));
                               newArray.push(JSON.stringify(myPro));
                          }
                      }else{
                        myPro = new Product(groupItem['id'],groupItem['name'],groupItem['price'],groupItem['image'],groupItem['qty'],groupItem['totalPrice']);
                        newArray.push(JSON.stringify(myPro));
                      }
                 }
                localStorage.setItem("cart",JSON.stringify(newArray));
                window.location.href="shoppingcart.php";               
          }
}

function getCartCount(){
      var count = document.getElementById('cartCount');
      var totalItem = 0;
      if(checkBroswerStorage() !==false){
          if(localStorage.getItem('cart')==null){
               totalItem = 0;
          }else{
               var mycartArray = JSON.parse(localStorage.getItem('cart'));

               for(var i = 0; i<mycartArray.length;i++){
                    single = JSON.parse(mycartArray[i]);
                    totalItem += single['qty'];
               }
          }
      }
      count.innerHTML = totalItem;
}

function checkBroswerStorage(){
	if (typeof(Storage) !== "undefined") {
   		return true;
	} else {
		return false;
		alert('Sorry! No Web Storage support..');
        // Sorry! No Web Storage support..
	}
}
