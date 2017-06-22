<?php

	$dbhost="localhost";
	$dbuser="root";
	$dbpwd="";
	

	
		$connect= mysqli_connect($dbhost,$dbuser,$dbpwd,'partydb');

$retrieve="SELECT * FROM event ORDER BY event_id DESC";

		$b= mysqli_query($connect,$retrieve) or die(mysqli_error());
		
		
		if (!$b){
			die('invalid query');

		}

		while ($row= mysqli_fetch_assoc($b)) {
			echo"{$row['name']}-".
				"{$row['theme']}-".
				"{$row['date']}-".
				"{$row['venue']} <br>";
		}
	



?>