<?php 
ob_start();
session_start();
require '../include/init.php';
$general->logged_out_protect();

$user     = $users->userdata($_SESSION['Eagle_Id']);
$firstName  = $user['First_Name'];
$eagleid  = $user['Eagle_Id'];
echo "<input type='hidden' id='userid' value='$eagleid'/>";


?>
<!DOCTYPE html>
<html lang="en">
<head> 

	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Review | Munchies</title>
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
      <a class="navbar-brand" href="./userHome.php">Munchies@BC</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
      
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?php echo $firstName; ?> <span class="fa fa-angle-down"></span></a>
          <ul class="dropdown-menu">
            <li><a href="userHome.php">Home</a></li>
            <li><a href="../typeSelect.php">Switch Account</a></li>
            <li><a href="userSettings.php">Settings</a></li>
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
              <input type='hidden' id='orderid'/>
              <input type='hidden' id='deliverer'/>
          			<h1>Write A Review</h1>
                <div id="selectorder">
                <table id="orderhistory" class="display table table-bordered" cellspacing="0" width="100%">
                      <tr>
                          <th>Order Id</th>
                          <th>Items</th>
                          <th>Comments</th>
                          <th>Submitted</th>
                          <th>Fulfilled</th>
                          <th>Review</th>
                      </tr>
              </table>
              </div>
              <div id="write">
                <label>How satisfied were you? </label> 
                <input type="radio" id="one" name="star" value="1" />
                <label for="one">*</label>
                <input type="radio" id="two" name="star" value="2" />
                <label for="two">**</label>
                <input type="radio" id="three" name="star" value="3" />
                <label for="three">***</label>
                <input type="radio" id="four" name="star" value="4" />
                <label for="four">****</label>
                <input type="radio" checked = "checked" id="five" name="star" value="5" />
                <label for="five">*****</label> </br> </br>
                <label>Comments: </label> 
                  <textarea rows="6" cols="50" id="comments" name="comments"></textarea>
                  <br>
                  <button class="btn btn-danger" id="back">Back To Review Select</button>
                <button class="btn btn-success" id="submitreview">Submit Review</button>
              </div>
       			</div>
			</div>
		</div>
    </section>

<!-- scripts & BS/custom JS -->


	  <script src="../js/scripts.js"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script type="text/javascript"> 
    $(document).ready(function() {
      $("#write").toggle();
      

      $.getJSON( "../include/orderHistoryReviewFetch.php" , {
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
                  $("<tr id='" + item.Id +":" + item.Fulfilled_By + "'><td>" + item.Id + "</td><td>" + items + "</td><td>" + item.Comments
                + "</td><td>" + item.Time_Submitted + "</td><td>" + item.Time_Fulfilled + "</td><td><button onclick='#' class='btn btn-primary' id='thisreview'>Review This Order</button></td></tr>").appendTo('#orderhistory');
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

  $("#back").on("click", function() {
    $("#selectorder").toggle();
          $("#write").toggle();
  });
  
    $("#orderhistory").on("click", "button", function() {
          $("#selectorder").toggle();
          $("#write").toggle();
          var temp = $(this).closest("tr").attr("id");
          temp = temp.split(":");
          var orderid = temp[0];
          var deliverer = temp[1];
          document.getElementById("orderid").value = orderid;
          document.getElementById("deliverer").value = deliverer;
    });

    $("#submitreview").on("click", function() {
          var orderid = document.getElementById("orderid").value;
          var deliverer = document.getElementById("deliverer").value;
          var useridd = document.getElementById("userid").value;
          var stars = 0;
          if(document.getElementById("one").checked) {
            stars = 1;
          }
          else if(document.getElementById("two").checked) {
            stars = 2;
          }
          else if(document.getElementById("three").checked) {
            stars = 3;
          }
          else if(document.getElementById("four").checked) {
            stars = 4;
          }
          else {
            stars = 5;
          }
          $.post("../include/insertReview.php",
            {
            order : orderid,
            deliverer: deliverer,
            user : useridd, 
            stars : stars,
            comments : document.getElementById("comments").value
            },
          function(data){
            if(data) {
              alert("You have submitted your review of this order");
              location.reload();
            }
            else {
              alert("Insertion Failed");
            }
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