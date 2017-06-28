<!DOCTYPE html>



<?php 
 
 include 'navbar.php';
 include 'guest.php'

?>

<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="main.js"></script>
 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-9 col-md-offset-3">
		<div class="w3-container w3-center">
		  
		  <div class="w3-card-4 " style="width:60%">
		    <img src="coloredcow-logo-mark.png" alt="Invitation" style="width:50%;">
		    <div class="w3-container w3-center">
				
			<?php

			if(isset($_GET['token']) && isset($_GET['email_id'])){
							
								$token=$_GET['token'];
								$guest_email=$_GET['email_id'];
								$method="AES-256-CBC";
								$iv="1234567812345678";
								$pwd="rsvp";

								$token=rawurldecode($token);
								$guest_email=rawurldecode($guest_email);

								$token=openssl_decrypt($token,$method,$pwd,0,$iv);
								$guest_email=openssl_decrypt($guest_email,$method,$pwd,0,$iv);
								
								$attr['email']=$guest_email;

								$event_id=getLatestEvent($connect);
								$guest=checkRegisterLatestEvent($connect,$event_id,$attr);
								
								
								if($token===$guest['token']){

									echo "<br> <br> <p> <b> Hi ".$guest['name'] ."!  Thank you for joining us. Looking forward to seeing you in the party!</b> </p>";
									updateGuestStatus($connect,$guest_email);

								}
							}

			?>
					</div>
					<footer class="w3-container w3-yellow">
					<!-- <button class="btn btn-danger pull-left">This is not me</button> -->
 					 <button class="btn btn-success pull-right " onclick="closeWindow();" >Ok</button>
					</footer>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
