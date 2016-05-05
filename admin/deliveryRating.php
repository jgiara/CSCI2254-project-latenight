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
	<title>Delivery Ratings| Munchies</title>
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
            <li><a href="./adminHome.php">Home</a></li>
            <li><a href="./adminUsers.php">View All Users</a></li>
            <li><a href="./deliveryRatings.php">Manage Users</a></li>
            <li><a href="./adminSettings.php">Settings</a></li>
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
            <div id="info">
                <table id="userinfo" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Eagle Id</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>User Rating</th>
                          <th>Ban User</th>
                      </tr>
              </table>
            </div>

            <br>

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
        
        $.getJSON( "../include/getAllUsers.php" , {
              
            }, function(data) {
              $.each(data, function(i, item){
                  $("<tr><td>" + item.Eagle_Id + "</td><td>" + item.First_Name + "</td><td>" + item.Last_Name + "</td><td>"
                  + item.Email + "</td><td>" + item.Phone + "</td><td>" + item.Address + "</td></tr>").appendTo("#userinfo");
              });
          });
        

    });



    //table populate
    

    //navbar min
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