<?php
ob_start();
session_start();

require './include/init.php';
$general->logged_in_protect();
//Register
if (isset ( $_POST ['submit'] )) {
    if (empty ( $_POST ['Password'] ) || empty ( $_POST ['Email'] )) {
        
        $errors [] = 'All fields are required.';
    } else {
        if (strlen ( $_POST ['Password'] ) < 6) {
            $errors [] = 'Your password must be atleast 6 characters';
        } else if (strlen ( $_POST ['Password'] ) > 18) {
            $errors [] = 'Your password cannot be more than 18 characters long';
        }
        if (filter_var ( $_POST ['Email'], FILTER_VALIDATE_EMAIL ) === false) {
            $errors [] = 'Please enter a valid email address';
        } else if ($users->email_exists ( $_POST ['Email'] ) === true) {
            $errors [] = 'That email already exists.';
        }
    }
    if (empty ( $errors ) == true) {
        
        $Password = $_POST ['Password'];
        $Email = htmlentities ( $_POST ['Email'] );
        $First_Name = htmlentities ( $_POST ['First_Name'] );
        $Last_Name = htmlentities ( $_POST ['Last_Name'] );
        $Eagle_Id = htmlentities($_POST ['Eagle_Id']);
        $Address = htmlentities($_POST ['Address']);
        $Phone = htmlentities($_POST ['Phone']);
        $Type = htmlentities($_POST ['Type']);

        
        $users->register ( $Password, $Email, $First_Name, $Last_Name, $Eagle_Id, $Address, $Phone, $Type);
    
        
        header ( 'Location: ./user/userHome.php' );
        exit ();
    }
}
//Login
if (isset ( $_POST ['signin'] )) {
 
  $Email_s = trim($_POST['Email_s']);
  $Password_s = trim($_POST['Password_s']);
  $Type_s = $users->get_type($Email_s);
 
  if ($users->email_exists($Email_s) === false) {
    $errors_s[] = 'Sorry that email does not exist.';
  }  else {
 
    $login = $users->login($Email_s, $Password_s);
    if ($login === false) {
      $errors_s[] = 'Incorrect login information. <a href="forgotPass.php">Reset password?</a>';
    }else {
      // username/password is correct and the login method of the $users object returns the user id, which is stored in $login.
 
      $_SESSION['Eagle_Id'] =  $login; // The user's id is now set into the user's session  in the form of $_SESSION['id'] see general.php for use 
      
          #Redirect the correct to home page
          if ($Type_s === 'Both') {
          header('Location: ./typeSelect.php');
        }else if ($Type_s === 'Delivery Person'){
            header('Location: ./deliverer/deliveryHome.php');
        }else{
            header('Location: ./user/userHome.php');
        }
      exit();
    }
  }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | Munchies</title>
	<meta name="description" content="Boston College Late Night Delivery">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 	<link href="css/bootstrap.min.css" rel="stylesheet">
 	<link rel="stylesheet" href="css/home.css">

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top" style="font-size:150%;"><b>Munchies@BC</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                  
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Delivery Info</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">About Us</a>
                    </li>
                </ul>
                
                <form class="navbar-form navbar-right" method="POST">
                    <div class="form-group">
                    <?php
                            if (empty ( $errors_s ) == false) {
                                echo '<p class="navbar-text">' . implode ( '</p><p class="navbar-text">', $errors_s ) . '</p>';
                            }
                    
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="Email_s" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="Password_s" placeholder="Password" required>
                    </div>
                    <button type="submit" name="signin"class="btn btn-default">Sign In</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Intro Section -->
    <section id="intro" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="color:white;">Late night delivered, no questions asked.</h1>
                    <br/>

                    <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#registerModal">Create an Account</button>

                </div>
            </div>
        </div>
    </section>


    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Covering the Heights in mozz sticks</h1>
                    <h1>since '16</h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="center-block">
                    <img src="./img/deliveryTruck.png" class="img-responsive center-block" alt="Delivery">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                     <h4>We are currently making deliveries to the Boston College campus only. We hope to expand to the off campus area in the near future, and we are currently
                    pioneering technology to keep tenders and steak subs nice and toasty over long distances. Please check back regularly for updates on our delivery service. Our delivery
                    hours match those of the dining halls, with our delivery times under 20 minutes. Eat up! </h4>
                    <br>
                    <h4>Strapped for cash or meal plan money? Sign up to deliver food and make a portion of every sale!</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Who are we?</h1>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="center-block">
                    <img src="./img/drinks.png" class="img-responsive center-block" alt="Drinks">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <h4> Simply put, we are three guys who love beer and fried food, and who were assigned a class project. Our goal was to help out the weekend hero or late night
                    study groups in need of some game fuel. </h4>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL FOR Registration -->
        <div id="registerModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create an Account</h4>
                  </div>
                  <div class="modal-body">
                    <form action="index.php" method="POST" name="registerForm">
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" name="Email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" name="First_Name" class="form-control" id="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" name="Last_Name" class="form-control" id="lastName" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Phone Number:</label>
                        <input type="tel" name="Phone" class="form-control" id="number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="eagleID">Eagle ID #:</label>
                        <input type="number" name="Eagle_Id" class="form-control" id="eagleID" placeholder="Eagle ID" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dorm Name/Room:</label>
                        <input type="text" name="Address" class="form-control" id="address" placeholder="Dorm Name/Room" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="Password" class="form-control" id="password" placeholder="8 Character Minimum" required>
                    </div>
                    <div class="form-group">
                        <label for="userType">What would you like to do:</label>
                        <select name="Type" class="form-control" id="userType" required>
                            <option name="role" value="">--</option>
                            <option name="role" value="User">Order Food</option>
                            <option name="role" value="Delivery Person">Make Deliveries</option>
                            <option name="role" value="Both">Both</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Register" class="btn btn-default"></input>
                    </form>
                        <?php
                            if (empty ( $errors ) == false) {
                                echo '<p>' . implode ( '</p><p>', $errors ) . '</p>';
                            }
                    
                        ?>
                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </div>
              </div>
            </div>
            <!--end MODAL -->

 	<!-- scripts & BS/custom JS -->

    <script src="js/jquery.easing.min.js"></script>
	<script src="js/scripts.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script type="text/javascript"> 
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