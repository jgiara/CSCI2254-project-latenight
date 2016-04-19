<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home | Project Late Night</title>
	<meta name="description" content="Boston College Late Night Delivery">

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
                <a class="navbar-brand page-scroll" href="#page-top">Late Night Delivery</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                  
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#register">Sign Up</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">About Us</a>
                    </li>
                </ul>
                <form class="navbar-form navbar-right" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Sign In</button>
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
                    <h1>Welcome to our boring page</h1>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#registerModal">Create an Account</button>
                </div>
            </div>
        </div>
    </section>

    <!-- register Section -->
    <section id="register" class="register-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Sign up to place an order!</h1>
        		</div>
        	</div>
        </div>	
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Services Section</h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact Section</h1>
                    	
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
                    <form action="./include/register.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Phone Number:</label>
                        <input type="tel" name="number" class="form-control" id="number" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="eagleID">Eagle ID #:</label>
                        <input type="number" name="eagleID" class="form-control" id="eagleID" placeholder="Eagle ID" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Dorm Name/Room:</label>
                        <input type="num" name="address" class="form-control" id="address" placeholder="Dorm Name/Room" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="8 Character Minimum" required>
                    </div>
                    <div class="form-group">
                        <label for="userType">What would you like to do:</label>
                        <select name="userType" class="form-control" id="userType" required>
                            <option value="">--</option>
                            <option value="user">Order Food</option>
                            <option value="delivery">Make Deliveries</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Submit" class="btn btn-default"></input>
                    </form>
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