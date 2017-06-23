<!DOCTYPE html>

 <?php
  	
  
  	if(isset($_POST['eventName'])){
  		
  		include 'functions.php'; 
  	}

  	


	
	
  	include 'guest.php';


  	
  ?>  
  	
<html>
<head>
	<!-- <meta char  set="utf-8"> -->
	<title>Guests</title>
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<?php include 'main.js'	?>
</head>




<body>

	<?php include ('navbar.php'); ?>
		

<!-- 	<?php //include('home.php'); ?> -->
	<!-- <div class="container">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
	</div> -->


	<div class="container" id="new_event_container" >
			<div class="row">

			<h1>
			<span>Guest Details</span>
			<button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#guestModal">Add Guest</button>
			</h1>
			<hr>
			
				
		
			
				
					<div class="col-xs-12 col-md-6 col-md-offset-3">
				<table class="table table-hover" id="guest_table" name="guest_table">
 					<thead>
				      <tr>
				         <th>Name</th>
				         <th>Email</th>
				         <th>Status</th>
				         
				      </tr>
				   </thead>
				   
				   <tbody>
				      
				     
				      	<?php
			      					
			      					//constructTable($connect);

				      				//function constructTable($connect){

					      			$guests= retrieveEventGuestDataTable($connect);

					      			foreach ($guests as $guest) {
					      	
					      	 				echo"<tr><td>{$guest['name']}</td>".
					      	 					"<td>{$guest['email']}</td>".
					      	 					"<td>{$guest['status']}</td></tr>";
					      	 				//	"<td>{$guest['status']}</td></tr>";


					      	 					
					      					
					      				}
				      		//	}
			      		      		
				      	?>
				    
				     
				   </tbody>
					
 				</table>
			</div>
			</div>


	

	
							

	</div>



	<div id="guestModal" class= "modal fade" role="form">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">

					<button class="close" type= "button" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Guest</h4>
					
				</div>
				<div class="modal-body">
					<div class="row">
						<form  id="guest_form" name="guest_form" method="POST" >

																													
									<div class="form-group col-xs-12">

										<label for="guestName">Name</label>
										<input type="text" class="form-control" name="guestName" id="guestName" placeholder="John Doe" required> 
										
									</div>
									
									<div class="form-group col-xs-12">	
										<label for="guestEmail">Email address</label>
										<input type="email" class="form-control" name="guestEmail" id="guestEmail" placeholder="john.doe@example.com" required>
									</div>
									<br>
									
						</form>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" id="guest_submit" class="btn btn-primary" onclick="validateFormGuest();">Add</button>
				</div>
			
			</div>
		</div>	
	</div>							
	
</body>
</html>
	
