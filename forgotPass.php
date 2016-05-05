<?php
ob_start();
session_start();

require './include/init.php'; 
?>

<?php
if (empty($_POST) === false) {
 
  $Email = trim($_POST['Email']);

  if ($users->email_exists($Email) === false) {
    $errors[] = 'Sorry that email doesn\'t exists.';
  } else {
    $recover = $users->recover($Email);
    echo '<script language="javascript">';
    echo 'alert("Password successfully resest, please check your email.")';
    echo '</script>';
    header('Location: ./index.php');
      exit();
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head> 

  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Password Recovery | Munchies</title>
  <meta name="description" content="Boston College Late Night Delivery">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" />

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
                <a class="navbar-brand page-scroll" href="./index.php"><b>Munchies@BC</b></a>
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
                <div class="well col-lg-5 center-block">
                 
                      <div class="well-header">
                          <h1 class="text-center"><span style="color: #C9473A">Password Recovery</span></h1>
                      </div> <br>
                      <div class="well-body">
                          <form class="form col-md-12 center-block" action="forgotPass.php" method="post">
                            <div class="form-group">
                              <input type="text" name="Email" class="form-control input-md" placeholder="Email " value="" required>
                            </div>
                            <div class="form-group">
                           
                                <input type="submit" name="submit" class="btn btn-success btn-lg btn-block" href="" value="Recover"></input>

                              <span class="pull-right"><a href="./index.php">Back to Login</a></span>
                             
                            </div>
                          </form>

                      </div>
                      <div class="well-footer ">
                          <div class="col-md-12 text-center">      
                         <?php 

                          if(empty($errors) === false){
                            echo '<p>' . implode('</p><p>', $errors) . '</p>';  
                          };

                           ?>
                      </div>  
                      </div>
            </div>
        </div>
    </section>

       <!--Password well-->
 
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