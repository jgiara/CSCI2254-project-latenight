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
	<title>Admin | Munchies</title>
	<meta name="description" content="Boston College Late Night Delivery">

 	<link href="../css/bootstrap.min.css" rel="stylesheet">
 	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="../css/styles.css">

</head>
<body>

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
      <a class="navbar-brand" href="./adminHome.php"><b>Munchies@BC</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, Admin <span class="fa fa-angle-down"></span></a>
          <ul class="dropdown-menu">
            <li><a href="userHome.php">Home</a></li>
            <li><a href="adminSettings.php">Settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="../logout.php">Sign Out</a></li>
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
            <h1>Use this table for customer support functions:</h1>
          			<!--insert table here-->
                <table id="history" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Order Id</th>
                          <th>Items</th>
                          <th>Comments</th>
                          <th>Delivery Charge</th>
                          <th>Total Price</th>
                          <th>Stage</th>
                          <th>Submitted</th>
                          <th>Submitted By</th>
                          <th>Fulfilled</th>
                          <th>Fulfilled By</th>
                          <th>Payment Method</th>
                          <th>Review Stars</th>
                          <th>Review Comments</th>
                      </tr>
      </table>
       			</div>
			</div>
		</div>
    </section>

<!-- scripts & BS/custom JS -->


	  <script src="../js/scripts.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script type="text/javascript"> 
		 var items = "";
    $(document).ready(function() {
            $.getJSON( "../include/allOrdersFetch.php" , {
              user: document.getElementById("userid").value
            }, function(data) {
              $.each(data, function(i, item){
                  items = "";
                  $.getJSON( "../include/orderHistoryItemsFetch.php" , {
                      orderid: item.Id
                  }, function(dataa) {
                  $.each(dataa, function(k, itemm){
                    items += itemm.Name + ", ";
                  });
                  items = items.substring(0,items.length-2);
                  $("<tr><td>" + item.Id + "</td><td>" + items + "</td><td>" + item.Comments + "</td><td>" + item.Delivery_Charge + "</td><td>" + item.Total_Price + "</td><td>" + item.Stage
                + "</td><td>" + item.Time_Submitted + "</td><td>" + item.Requested_By + "</td><td>" + item.Time_Fulfilled + "</td><td>" + item.Fulfilled_By + "</td><td>" + item.Payment_Method + "</td><td>" + item.Stars + "</td><td>" + item.Comments + "</td></tr>").appendTo('#history');
                  items = "";
                })
              .fail(function() {
                console.log( "getJSON error" );
              });
            
                
              });
            })
            .fail(function() {
                console.log( "getJSON error" );
            });
    });




     $(window).scroll(function() {
		    if ($(".navbar").offset().top > 50) {
		        $(".navbar-fixed-top").addClass("top-nav-collapse");
		    } else {
		        $(".navbar-fixed-top").removeClass("top-nav-collapse");
		    }
		});

		//jq for page scroll, using hte easing lib
		$(function() {
		    $('a.page-scroll').bind('click', function(event) {
		        var $anchor = $(this);
		        $('html, body').stop().animate({
		            scrollTop: $($anchor.attr('href')).offset().top
		        }, 1500, 'easeInOutExpo');
		        event.preventDefault();
		    });
		});

  	</script>
</body>
</html>