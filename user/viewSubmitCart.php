<?php 
ob_start();
session_start();
require '../include/init.php';
$general->logged_out_protect();

$user     = $users->userdata($_SESSION['Eagle_Id']);
$eagleid  = $user['Eagle_Id'];
$addr = $user['Address'];

echo "<input type='hidden' id='userid' value='$eagleid'/>";
echo "<input type='hidden' id='address' value='$addr'/>";
?>

<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Place Order| Project Late Night</title>
	<meta name="description" content="Boston College Late Night Delivery">

 	<link href="../css/bootstrap.min.css" rel="stylesheet">
 	<link rel="stylesheet" href="../css/styles.css">
 	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

     <!-- Navigation -->
	<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="./userHome.php">Late Night Delivery</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Navigation <span class="fa fa-angle-down"></span></a>
          <ul class="dropdown-menu">
            <li><a href="./userHome.php">Home</a></li>
            <li><a href="../typeSelect.php">Switch Account</a></li>
            <li><a href="./userSettings.php">Settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../index.php">Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <!-- Intro Section -->
    <section id="select" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                 
                   <table id="cart" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Menu Item</th>
                          <th>Price</th>
                      </tr>
                  </table>
                  <table id="prices" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Delivery Charge</th>
                          <th>Total Price</th>
                      </tr>
                  </table>
                  <input type="radio" name="payment" value="Cash" id="cash">
                  <label for="cash">Cash</label>
                  <input type="radio" checked="checked" name="payment" value="Meal Plan" id="mealplan">
                  <label for="mealplan">Meal Plan</label></br>
                  <label>Comments</label>
                  <textarea rows="6" cols="50" id="comments" name="comments"></textarea>
                  <br>
                   <a href="placeOrder.php" class="btn btn-success" >
                    Back to Cart
                  </a>
                  <a href="trackOrder.php" class="btn btn-warning" id="submitorder">
                    Check Out
                  </a>
                  <!--<input type="text" id="testing" />-->
                </div>
            </div>
        </div>
    </section>

<!-- scripts & BS/custom JS -->

    <script src="../js/jquery.easing.min.js"></script>
	<script src="../js/scripts.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script type="text/javascript"> 
    var sum = 0;
    var deliverycharge = 0;
    var items = [];
    var pmethod;
    var orderId = 0;
      $(document).ready(function() {
            
            $.getJSON( "../include/cartFetch.php" , {
              user: document.getElementById("userid").value
            }, function(data) {

              $.each(data, function(i, item){
                $("<tr><td>" + item.Name + "</td><td>" + item.Price + "</td></tr>").appendTo('#cart');
                sum += Number(item.Price);
                items.push(item.Item_Id);
              });
              deliverycharge = sum*0.1;
              $("<tr><td>$" + (deliverycharge).toFixed(2) + "</td><td>$" + sum.toFixed(2) + "</td></tr>").appendTo("#prices");
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
          });
      $("#submitorder").on("click", function() {
        if(document.getElementById("cash").checked) {
          pmethod = "Cash";
        }
        else {
          pmethod = "Meal Plan";
        }

        $.post("../include/insertOrder.php",
            {
            user : document.getElementById("userid").value,
            address: document.getElementById("address").value,
            payment: pmethod,
            comments: document.getElementById("comments").value,
            delivery: deliverycharge,
            price: sum
            },
          function(data){
            if(data) {
              //alert("Order Has Been Placed");
            }
            else {
              alert("Insertion Failed");
            }
        });

        $.getJSON( "../include/maxOrderIdFetch.php" , {
              user: document.getElementById("userid").value
            }, function(data) {

              $.each(data, function(i, item){
                orderId = item.maxid;
                for(var j = 0; j < items.length; j++) {

                  $.post("../include/insertOrderItems.php",
                  {
                  orderid : orderId,
                  itemid: items[j]
                  },
                function(data){
                  if(data) {
                    //alert("Order Has Been Placed");
                  }
                  else {
                    alert("Insertion Failed");
                  }
              });
                }
              });
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
            //document.getElementById("testing").value = orderId;
        $.post("../include/deleteCart.php",
          {
            user : document.getElementById("userid").value
          },
          function(data){
          if(data) {
            alert("Your Order Has Been Placed");
          }
          else {
            alert("Insertion Failed");
          }
        });
        
      });
  	</script>
</body>
</html>