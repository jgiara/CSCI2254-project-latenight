<?php

		$user = $_POST['user'];
		$order = $_POST['order'];
		$deliverer = $_POST['deliverer'];
		$stars = $_POST['stars'];
		$comments = $_POST['comments'];


		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "update Reviews set Delivery_Person = $deliverer, Stars = $stars, Submitted = now(), Review_Comments = '$comments' 
		where Order_Id = $order";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}

		$query = "update Orders set Reviewed = 1 where Id = $order";

		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}
	
		$data_from_post = array('user' => $user);
		echo json_encode($result);
		mysqli_close($dbc);
?>
