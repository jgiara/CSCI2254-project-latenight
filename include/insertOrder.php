<?php

		$user = $_POST['user'];
		$loc = $_POST['address'];
		$payment = $_POST['payment'];
		$comments = $_POST['comments'];
		$dcharge = $_POST['delivery'];
		$tprice = $_POST['price'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "insert into Orders (Requested_By, Time_Submitted, Delivery_Location, Payment_Method, Stage, Comments, Delivery_Charge, Total_Price) 
		values ($user, now(), '$loc', '$payment', 'Pending', '$comments', '$dcharge', '$tprice')";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}
	
		$data_from_post = array('item' => $item);
		echo json_encode($result);
		mysqli_close($dbc);
?>
?>