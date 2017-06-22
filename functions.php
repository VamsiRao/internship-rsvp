<?php
	$dbhost="localhost";
	$dbuser="root";
	$dbpwd="";
	

	
		$connect= mysqli_connect($dbhost,$dbuser,$dbpwd,'partydb');
	// opening connection
	if(!$connect){
		die("Could not connect");
	}
	
		

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


		
		function insertData ($attr,$connect){

			
		
			$insert ="INSERT INTO `event` (`name`, `theme`, `date`, `venue`) VALUES ('".$attr['eventName']."','".$attr['eventTheme']."','".$attr['date']."','".$attr['eventVenue']."');";

		$a = mysqli_query($connect, $insert) or die(mysql_error());
		}



		function retrieveJSON($connect){
			$retrieve="SELECT * FROM event ORDER BY event_id DESC LIMIT 1";

		$c= mysqli_query($connect,$retrieve) or die(mysqli_error());
     
     		$row=mysqli_fetch_assoc($c);
     		echo json_encode($row);
		}
	
	
		


?>


