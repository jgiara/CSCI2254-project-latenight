<?php

		$user = $_GET['user'];

		$dbc = @mysqli_connect("localhost", "giara", "latenight", "giara")
	       or die("Could not open menu db, " . mysqli_connect_error());
		$query = "SELECT avg(Stars) as ratingaverage from Reviews where Delivery_Person = $user";			
		$result = mysqli_query($dbc, $query) or die ("Error in Select" . mysqli_error($dbc));
		
		$menu_items = array();	// put the rows as objects in an array
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$menu_items[] = $row;
		}
		echo json_encode($menu_items);
		mysqli_close($dbc);


?>