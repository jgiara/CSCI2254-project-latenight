<?php 
ob_start();
session_start();
require '../include/init.php';
$general->logged_out_protect();

$user     = $users->userdata($_SESSION['Eagle_Id']);
$eagleid  = $user['Eagle_Id'];

echo "<input type='hidden' id='userid' value='$eagleid'/>";
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
                <!--button to select dining hall -->
                  <p>
                  <a href="viewSubmitCart.php" class="btn btn-sq-lg btn-success"><i class="fa fa-shopping-cart fa-4x"></i><br/>
                    View Cart
                  </a>
                  <a href="#" class="btn btn-sq-lg btn-success" id="lowermenu">
                    <i class="fa fa-cutlery fa-4x"></i><br/>Lower Live
                  </a>
                  <a href="#" class="btn btn-sq-lg btn-success" id="macmenu">
                    <i class="fa fa-cutlery fa-4x"></i><br/>McElroy Commons
                  </a>
                  <a href="#" class="btn btn-sq-lg btn-success" id="stuartmenu">
                    <i class="fa fa-cutlery fa-4x"></i><br/>Stuart Hall
                  </a>
                  <!-- menu to be hiddne -->
                   <table id="menus" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Menu Item</th>
                          <th>Price</th>
                          <th>Add to Cart</th>
                      </tr>
      </table>
      <div id="testt"></div>
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
      $("#lowermenu").on("click", function() {
            
            $.getJSON( "../include/menuFetch.php" , {
              location: "Lower"
            }, function(data) {
              $('#menus').find('tr:gt(0)').remove();
              //$("<tr><th>Menu Item</th><th>Price</th><th>Add to Cart</th></tr>").appendTo('#menus');
              $.each(data, function(i, item){
                $("<tr id='"+item.Id+"'><td>" + item.Name + "</td><td>" + item.Price + "</td><td><button class='btn btn-primary' id='addCart' value='" + item.Id + "'>Add to Cart</button></td></tr>").appendTo('#menus');
              });
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
          });
      $("#macmenu").on("click", function() {
            
            $.getJSON( "../include/menuFetch.php" , {
              location: "Mac"
            }, function(data) {
              $('#menus').find('tr:gt(0)').remove();
              $.each(data, function(i, item){
                $("<tr id='"+item.Id+"'><td>" + item.Name + "</td><td>" + item.Price + "</td><td><button onclick='#' class='btn btn-primary' id='addCart'>Add to Cart</button></td></tr>").appendTo('#menus');
              });
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
          });
      $("#stuartmenu").on("click", function() {
            
            $.getJSON( "../include/menuFetch.php" , {
              location: "Stuart"
            }, function(data) {
              $('#menus').find('tr:gt(0)').remove();
              //$("<tr><th>Menu Item</th><th>Price</th><th>Add to Cart</th></tr>").appendTo('#menus');
              $.each(data, function(i, item){
                $("<tr id='"+item.Id+"'><td>" + item.Name + "</td><td>" + item.Price + "</td><td><button onclick='#' class='btn btn-primary' id='addCart'>Add to Cart</button></td></tr>").appendTo('#menus');
              });
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
          });
      $(document).ready(function() {
        $("#menus").on("click", "button", function() {
          var itemid = $(this).closest("tr").attr("id");
          var useridd = document.getElementById("userid").value;
          $.post("../include/addToCart.php",
            {
            item : itemid,
            user : useridd
            },
          function(data){
            if(data) {
              alert("The item has been added to your cart");
            }
            else {
              alert("Insertion Failed");
            }
        });
      });
    });
  	</script>
</body>
</html>