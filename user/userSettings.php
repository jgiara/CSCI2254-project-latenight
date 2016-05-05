<?php 
ob_start();
session_start();
require '../include/init.php';
$general->logged_out_protect();

$user     = $users->userdata($_SESSION['Eagle_Id']);
$eagleid  = $user['Eagle_Id'];
$fn = $user['First_Name'];
$ln = $user['Last_Name'];
$addr = $user['Address'];
$phn = $user['Phone'];

echo "<input type='hidden' id='userid' value='$eagleid'/>";
echo "<input type='hidden' id='userfirst' value='$fn'/>";
echo "<input type='hidden' id='userlast' value='$ln'/>";
echo "<input type='hidden' id='useraddress' value='$addr'/>";
echo "<input type='hidden' id='userphone' value='$phn'/>";
?>

<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Settings| Munchies</title>
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
      <a class="navbar-brand" href="./userHome.php"><b>Munchies@BC</b></a>
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
                   <h1>Your Settings</h1>
                   <div id="set">
                   <label>Eagle ID: </label> <input type="text" id="eagleid" readonly/></br></br>
                   <label>First Name: </label> <input type="text" id="first" /></br></br>
                   <label>Last Name: </label> <input type="text" id="last" /></br></br>
                   <label>Address (Dorm Room Name/Number): </label> <input type="text" id="address" /></br></br>
                   <label>Phone Number: </label> <input type="text" id="phone" /></br></br>
                   <button class="btn btn-success"id="showpass">Change Password</button>
                   <button class="btn btn-warning"id="updatesettings">Update Settings</button>
                   </div>
                   <div id="pass">
                   <label>New Password: </label> <input type="password" id="password" />
                   <div id="passerror"></div></br></br>
                   <label>Re-Enter New Password: </label> <input type="password" id="repassword" /></br></br>
                   <button class="btn btn-success"id="backset">Back To Settings</button>
                   <button class="btn btn-warning"id="changepass">Update Password</button>
                 </div>
                   
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
    $(document).ready(function() {
      document.getElementById("eagleid").value = document.getElementById("userid").value;
      document.getElementById("first").value = document.getElementById("userfirst").value;
      document.getElementById("last").value = document.getElementById("userlast").value;
      document.getElementById("address").value = document.getElementById("useraddress").value;
      document.getElementById("phone").value = document.getElementById("userphone").value;
      $("#pass").toggle();
    });
    $("#showpass").on("click", function() {
      $("#pass").toggle();
      $("#set").toggle();
    });
    $("#backset").on("click", function() {
      $("#pass").toggle();
      $("#set").toggle();
    });

    $("#updatesettings").on("click", function() {
      var firstname = document.getElementById("first").value;
      var lastname = document.getElementById("last").value;
      var loc = document.getElementById("address").value;
      var pnumber = document.getElementById("phone").value;

      $.post("../include/updateSettings.php",
            {
            user : document.getElementById("userid").value,
            fn: firstname,
            ln: lastname,
            addr: loc,
            phone: pnumber
            },
          function(data){
            if(data) {
              alert("Your Setting Have Been Updated");
              location.reload();

            }
            else {
              alert("Insertion Failed");
            }
        });

    });

    $("#changepass").on("click", function() {
      var pass = document.getElementById("password").value;
      var repass = document.getElementById("repassword").value;

      if(pass.length < 8) {
        document.getElementById("passerror").innerHTML = "You password must be at least 8 characters";
      }
      else if(pass != repass) {
        document.getElementById("passerror").innerHTML = "The passwords do not match";
      }
      else {
        document.getElementById("passerror").innerHTML = "";
        $.post("../include/updatePassword.php",
            {
            user : document.getElementById("userid").value,
            password : pass 
            },
          function(data){
            if(data) {
              alert("Your Password Have Been Updated");
              location.reload();

            }
            else {
              alert("Insertion Failed");
            }
        });
      }

      

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