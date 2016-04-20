<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Select Role | Project Late Night</title>
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
                <a class="navbar-brand page-scroll" href="./index.php">Late Night Delivery</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                  
                    <li class="hidden">
                        <a class="page-scroll" href="#page-top"></a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- Intro Section -->
    <section id="select" class="intro-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Select your role:</h1>
                    <a type="button" class="btn btn-lg btn-success" href="./deliverer/deliveryHome.php">Place an Order</a>
                    <a type="button" class="btn btn-lg btn-warning" href="./user/userHome.php">Make a Delivery</a>
                </div>
            </div>
        </div>
    </section>

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