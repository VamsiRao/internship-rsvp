<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpwd="";
	

  		
  	

		$connect = mysqli_connect($dbhost,$dbuser,$dbpwd,'partydb');
	// opening connection

	if(!$connect){
		die("Could not connect");
	}			




		if(is_ajax()){
					
			
				if(isset($_POST['rsvpName']) && !empty($_POST['rsvpName'])){
				
				$attr['rsvpName']  = $_POST['rsvpName'];
				$attr['rsvpEmail']= $_POST['rsvpEmail'];
				$attr['rsvpPref']=$_POST['inlineRadioOptions'];

				echo insertDataRSVP($attr,$connect);
				return;
				
			}

				if(isset($_POST['guestName'])&&!empty($_POST['guestName'])){
					

				$arr['guestName']=$_POST['guestName'];
				$arr['guestEmail']=$_POST['guestEmail'];

				insertDataGuest($arr,$connect);	
				return retrieveJSON($connect);
				
				

			}

			
		}


		function retrieveDataEvent($connect){
		$retrieve="SELECT * FROM event ORDER BY event_id DESC LIMIT 1";

		$b= mysqli_query($connect,$retrieve) or die(mysqli_error());
		
		
		if (!$b){
			die('invalid query');

		}

		while ($row= mysqli_fetch_assoc($b)) {
			echo"<h1 id='banner_name' style='text-align: center;'>{$row['name']}</h1><br>".
				"<h1 id='banner_theme' style='text-align: center;'>{$row['theme']}</h1><br>".
				"<h1 id='banner_date' style='text-align: center;'>{$row['date']}</h1><br>".
				"<h3 id='banner_venue' style='text-align: center;'>{$row['venue']}</h3> <br><br>";
				//"<a href='db.php' target='_blank'>Complete DB</a>";
		}
		}


		function is_ajax(){
			return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest';
		}






				



						
		 	
				
/*
		if(is_ajax()){
			if(isset($_POST['eventName'])&& !empty($_POST['eventName'])){

				$attr['eventName']  = $_POST['eventName'];
				$attr['eventTheme']= $_POST['eventTheme'];
				$attr['date']=$_POST['date'];
				$attr['eventVenue']=$_POST['eventVenue'];
					
				 insertData($attr,$connect);
				 retrieveJSON($connect);

			}
		}


		function is_ajax(){
			return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest';
		}

*/
		
		function insertDataRSVP ($attr,$connect){

			/*IF NOT EXISTS ( SELECT 1 FROM Users WHERE FirstName = 'John' AND LastName = 'Smith' )
				BEGIN
				    INSERT INTO Users (FirstName, LastName) VALUES ('John', 'Smith')
				END*/
			
			/*$insert =" IF NOT EXISTS ( SELECT `guest_id` FROM `guest` WHERE `email` = '".$attr['rsvpEmail']."')
						BEGIN
						INSERT INTO `guest` (`name`, `email`, `pref`) VALUES ('".$attr['rsvpName']."','".$attr['rsvpEmail']."','".$attr['rsvpPref']."')
						END
						";*/
						$query="SELECT event_id FROM event ORDER BY event_id DESC LIMIT 1";
						$event_id=mysqli_query($connect, $query) or die(mysql_error());
						$event_id= mysqli_fetch_assoc($event_id);

						$query= "SELECT * FROM `guest` WHERE `email` = '".$attr['rsvpEmail']."';";
						$guest_id=mysqli_query($connect, $query) or die(mysql_error());
						$guest_id= mysqli_fetch_assoc($guest_id);
						
						$query="SELECT * FROM `event_guest` WHERE (`guest_id`='".$guest_id['guest_id']."' AND `event_id`='".$event_id['event_id']."')";
						$query=mysqli_query($connect, $query) or die(mysql_error());
						$query=mysqli_fetch_assoc($query);


						if($query['guest_id']===NULL){

								 if($guest_id['guest_id']===NULL){
									$insert_guest="INSERT INTO `guest` (`name`, `email`, `pref`) VALUES ('".$attr['rsvpName']."','".$attr['rsvpEmail']."','".$attr['rsvpPref']."');";
									mysqli_query($connect, $insert_guest) or die(mysql_error());
									
									$retrieve="SELECT * FROM guest ORDER BY guest_id DESC LIMIT 1";
									$b=mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
									
									$insert_guest=mysqli_fetch_assoc($b);
									
									addToEventGuest($connect,$insert_guest['guest_id'],$insert_guest['name'],$event_id['event_id'],$insert_guest['email'],'pending');
									// echo "<script type='text/javascript'>alert('Thank you! Your request has been submitted');</script>";
									return retrieveJSON($connect);


								}else{					
														

									addToEventGuest($connect,$guest_id['guest_id'],$guest_id['name'],$event_id['event_id'],$guest_id['email'],'confirmed');
										// echo "<script type='text/javascript'>alert('See you in the party!');</script>";
										return retrieveJSON($connect);
									
								}

						} else{
								$return=null;
								 $return["register"] = $return;
							     return json_encode($return);
						}		

						

			//$a = mysqli_query($connect, $insert) or die(mysql_error());
			
			
		}

		function insertDataGuest($arr,$connect){

			
		
			$insert ="INSERT INTO `guest` (`name`, `email`) VALUES ('".$arr['guestName']."','".$arr['guestEmail']."');";

			$a = mysqli_query($connect, $insert) or die(mysql_error());
		}



		function retrieveEventGuestDataTable($connect){
			$event_id="SELECT event_id FROM event ORDER BY event_id DESC LIMIT 1";
			$event_id=mysqli_query($connect, $event_id) or die(mysql_error());
			$event_id= mysqli_fetch_assoc($event_id);
			
			$retrieve="SELECT * FROM event_guest WHERE event_id='".$event_id['event_id']."' ORDER BY `event_guest_id` DESC LIMIT 10";
			$g=mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
			
			$guests=mysqli_fetch_all($g,MYSQLI_ASSOC);
		
			return $guests;
		}


		function retrieveData($connect){
		$retrieve="SELECT * FROM event ORDER BY event_id DESC LIMIT 1";

		$b= mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
		
		
		if (!$b){
			die('invalid query');

		}

		while ($row= mysqli_fetch_assoc($b)) {
			echo"{$row['name']}-".
				"{$row['theme']}-".
				"{$row['date']}-".
				"{$row['venue']} <br><br>".
				"<a href='db.php' target='_blank'>Complete DB</a>";
		}
		}



		
	
		function retrieveJSON($connect){
			$retrieve="SELECT * FROM `event_guest` ORDER BY event_guest_id DESC LIMIT 1";

		$c= mysqli_query($connect, $retrieve) or die(mysqli_error($connect));
     
     		$row=mysqli_fetch_assoc($c);
     		$row["register"]='registered';
     		return json_encode($row);
		}
	


		function addToEventGuest($connect,$guest_id,$guest_name,$event_id,$guest_email,$status){
			$insert="INSERT INTO `event_guest` (`event_id`, `guest_id`,`name`,`email`,`status`) VALUES ('$event_id','$guest_id','$guest_name','$guest_email','$status');";
			$a=mysqli_query($connect, $insert) or die(mysqli_error($connect));
		}

?>


