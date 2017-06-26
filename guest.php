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
			


				if(isset($_POST['action']) && !empty($_POST['action'])){
				
					if($_POST['action']=='confirmTable'){
					$guests=retrieveEventGuestDataTableConfirm($connect);
					echo json_encode($guests);
					return;}
					elseif ($_POST['action']=='pendingTable') {
					
					$guests=retrieveEventGuestDataTablePending($connect);
					echo json_encode($guests);
					return;
				}
								
					
					
			}


				if(isset($_POST['confirmEmail']) && !empty($_POST['confirmEmail'])){
				
				
				$confirmEmail= $_POST['confirmEmail'];


				echo updateGuestStatus($connect,$confirmEmail);
				return;
				
			}


					
			
				if(isset($_POST['requestName']) && !empty($_POST['requestName'])){
				
				$attr['name']  = $_POST['requestName'];
				$attr['email']= $_POST['requestEmail'];
				$attr['pref']=$_POST['inlineRadioOptions'];

				echo insertDataRequest($attr,$connect);
				return;
				
			}


				if(isset($_POST['rsvpEmail']) && !empty($_POST['rsvpEmail'])){
				
				
				$attr['email']= $_POST['rsvpEmail'];
				

				echo insertDataRSVP($attr,$connect);
				return;
				
			}




				if(isset($_POST['guestName'])&&!empty($_POST['guestName'])){
					

				$arr['guestName']=$_POST['guestName'];
				$arr['guestEmail']=$_POST['guestEmail'];

				echo insertDataGuest($arr,$connect);	
				return;
				
				

			}

			
		}


		function retrieveEventDataTable($connect){
		$retrieve="SELECT * FROM event ORDER BY event_id DESC LIMIT 10";

		$b= mysqli_query($connect,$retrieve) or die(mysqli_error());

		if (!$b){
			die('invalid query');

		}
		$events=mysqli_fetch_all($b,MYSQLI_ASSOC);
		
			return ($events);
		
		
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

  		
    function insertDataRequest($attr,$connect){


						//Check the latest event
						
						$event_id= getLatestEvent($connect);

						//Check the guest table

						$guest_id=checkGuestTable($attr,$connect);			
						
						
						//For checking whether he registered in the latest event
						
						$query=checkRegisterLatestEvent($connect,$event_id,$attr);


						if($query['email']===NULL){

								 if($guest_id['guest_id']===NULL){
									/*$insert_guest="INSERT INTO `guest` (`name`, `email`, `pref`) VALUES ('".$attr['rsvpName']."','".$attr['rsvpEmail']."','".$attr['rsvpPref']."');";
									mysqli_query($connect, $insert_guest) or die(mysql_error());*/
									
								/*	$retrieve="SELECT * FROM guest ORDER BY guest_id DESC LIMIT 1";
									$b=mysqli_query($connect,$retrieve) or die(mysqli_error($connect));*/
									
									//$insert_guest=mysqli_fetch_assoc($b);
									
									addToEventGuest($connect,'0',$attr['name'],$event_id['event_id'],$attr['email'],'pending');
									
									return retrieveJSON($connect);


								}else{			
														
									//fill another json saying you should go to guest list
									return;
									
								}

						} else{
								$return=null;
								 $return["register"] = $return;
							     return json_encode($return);
						}		

						

			//$a = mysqli_query($connect, $insert) or die(mysql_error());
			
			
		}

		function getLatestEvent($connect){
			$query="SELECT event_id FROM event ORDER BY event_id DESC LIMIT 1";
						$event_id=mysqli_query($connect, $query) or die(mysql_error());
						$event_id= mysqli_fetch_assoc($event_id);
						return $event_id;

		}

		function checkGuestTable($attr,$connect){
			$query= "SELECT * FROM `guest` WHERE `email` = '".$attr['email']."';";
						$guest_id=mysqli_query($connect, $query) or die(mysql_error());
						$guest_id= mysqli_fetch_assoc($guest_id);
						return $guest_id;

		}

		function checkRegisterLatestEvent($connect,$event_id,$guest){

			$query="SELECT * FROM `event_guest` WHERE (`email`='".$guest['email']."' AND `event_id`='".$event_id['event_id']."')";
			$query=mysqli_query($connect, $query) or die(mysql_error());
			$query=mysqli_fetch_assoc($query);
			return $query;
		}




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
						
						//Check the latest event						
						$event_id= getLatestEvent($connect);

						//Check the guest table 
						$guest_id=checkGuestTable($attr,$connect);			
						
						//For checking whether he registered in the latest event						
						$query=checkRegisterLatestEvent($connect,$event_id,$guest_id);



						if($query['email']===NULL){

								 if($guest_id['guest_id']===NULL){

									
									
									//add some parameter to say that you should register
								
									// echo "<script type='text/javascript'>alert('Thank you! Your request has been submitted');</script>";
									return;
									// retrieveJSON($connect);


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

			$retrieve="SELECT * FROM guest ORDER BY guest_id DESC LIMIT 1";

			$b= mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
			
			$a =mysqli_fetch_assoc($b);
			return json_encode($a);
		}



		function retrieveEventGuestDataTablePending($connect){
			
			$event_id= getLatestEvent($connect);
			
			$retrieve="SELECT * FROM event_guest WHERE (`event_id`='".$event_id['event_id']."' AND `status`= 'pending' ) ORDER BY `event_guest_id` DESC LIMIT 10";
			$g=mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
			
			$guests=mysqli_fetch_all($g,MYSQLI_ASSOC);
		
			return ($guests);
		}


		function retrieveEventGuestDataTableConfirm($connect){
			$event_id="SELECT event_id FROM event ORDER BY event_id DESC LIMIT 1";
			$event_id=mysqli_query($connect, $event_id) or die(mysql_error());
			$event_id= mysqli_fetch_assoc($event_id);
			
			$retrieve="SELECT * FROM event_guest WHERE (`event_id`='".$event_id['event_id']."' AND `status`= 'confirmed' ) ORDER BY `event_guest_id` DESC LIMIT 10";
			$g=mysqli_query($connect,$retrieve) or die(mysqli_error($connect));
			
			$guests=mysqli_fetch_all($g,MYSQLI_ASSOC);
		
			return ($guests);
		}


		/*function retrieveData($connect){
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
*/


		
	
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





		function updateGuestStatus($connect,$email){

				
				$event_id= getLatestEvent($connect);


				$query = "UPDATE `event_guest` SET status='confirmed' WHERE (email = '$email' AND event_id='".$event_id['event_id']."')";
				$c= mysqli_query($connect, $query) or die(mysqli_error($connect));
     
				
				
				return json_encode("done");
			



		}





?>


