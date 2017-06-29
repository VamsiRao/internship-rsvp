<!DOCTYPE html>

 <?php
  	
  	if(isset($_POST['eventName'])){
  		
  		include 'functions.php'; 
  	}

  	include_once 'guest.php';
  ?>  
  	
<html>
<head>
	
	<title>Guests</title>
	

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="main.js"></script>

</head>

<body>

	<?php include 'navbar.php'; ?>
		


	<div class="container" id="guest_management_container" >
			<div class="row">

			<h1>
				<span>Guest Management</span>
				<button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#guestModal">Add Guest</button>
			</h1>
			<hr>




				
				<div class="col-xs-12 col-md-4 col-md-offset-1 ">
				<?php 

					
					$event=getLatestEvent($connect);
					$guests=retrieveEventGuestDataTableConfirm($connect);


					echo "<h4 style='text-align: center;'>Guests coming to ".$event['name']."  <span class='label label-success' id='guestsComingLabel'>".sizeof($guests)."</span> </h4>";
				

				?>
				
				<br>
				<table class="table table-hover" id="guest_invite_table" name="guest_table">
					
 					<thead>
				      <tr>
				         <th>Name</th>
				         <th>Email</th>
				         <th>Status</th>
				         
				      </tr>
				   </thead>
				   
				   <tbody>
				      
				     
				      	<?php		      					
			      					
				      				$guests= retrieveEventGuestDataTableConfirm($connect);


					      			foreach ($guests as $guest) {
					      	
					      	 				echo"<tr><td>{$guest['name']}</td>".
					      	 					"<td>{$guest['email']}</td>".
					      	 					"<td><span class='label label-info'>{$guest['status']}</span></td></tr>";					      					
					      				}

					      			$guests= retrieveEventGuestDataTablePending($connect);


					      			foreach ($guests as $guest) {
					      	
					      	 				echo"<tr><td>{$guest['name']}</td>".
					      	 					"<td>{$guest['email']}</td>".
					      	 					"<td><span class='label label-default'>{$guest['status']}</span></td></tr>";					      					
					      				}




				      						      		      		
				      	?>
				    
				     
				   </tbody>
					
 				</table>
			</div>



					<div class="col-xs-12 col-md-5 col-md-offset-1 ">
					
					<?php 
					
					$guests=retrieveEventGuestDataTableRequest($connect);


					echo "<h4 style='text-align: center;'>Guests awaiting your approval  <span class='label label-danger' id='guestsRequestedLabel'>".sizeof($guests)."</span> </h4>"

					?>
					<br>

				<table class="table table-hover" id="guest_request_table" name="guest_table">
 					<thead>
				      <tr>
				         <th>Name</th>
				         <th>Email</th>
				         <th>Status</th>
				         <th>Action</th>
				         
				      </tr>
				   </thead>
				   
				   <tbody>
				      
				     
				      	<?php
			      					
			      					
					      			$guests= retrieveEventGuestDataTableRequest($connect);

					      			foreach ($guests as $guest) {
					      	
					      	 				echo"<tr><td>{$guest['name']}</td>".
					      	 					"<td>{$guest['email']}</td>".
					      	 					"<td><span class='label label-warning'>{$guest['status']}</span></td>".
					      	 					"<td><button type='button' class='btn btn-success btn-xs' value='{$guest['email']}' onclick='sendConfirmData(this);'>Confirm</button></td></tr>";


					      	 					
					      					
					      				}
			      		      		
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
	
