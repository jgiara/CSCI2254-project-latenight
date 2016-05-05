<?php

		$order = $_POST['orderid'];
		$item = $_POST['itemid'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "insert into Order_Items (Order_Id, Item_Id) 
		values ($order, $item)";				
		//$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		if(mysqli_query($dbc, $query)) {
			$result = true;
		}
		else {
			$result = false;
		}

		$query = "insert into Reviews (Order_Id) values ($order)";
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