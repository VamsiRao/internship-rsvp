<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">

<?php include 'navbar.php';
		
		require 'guest.php';
 ?>

 <link href="https://fonts.googleapis.com/css?family=Cabin+Sketch" rel="stylesheet">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://use.fontawesome.com/ffc2c94a85.js"></script>
<script src="main.js"></script>

<style>
       h1{
        font-family: 'Cabin Sketch', cursive;
      }

       body {
       background-image: url("scroll.jpg");
      
       background-position: center ;
       background-size: cover;
   	} 
	.navbar {
    text-decoration-color: #FFE94C;
		}
.navbar-inverse .navbar-nav > li > a:hover {
    color: #FFE94C;
}

  </style>


</head>

<body>
	


<div class="container"  id='home_container'>
	<div class="row">
	
		<div class="col-xs-12 "">
		<p  id="event_display" style="text-align: center;">
			<?php retrieveDataEvent($connect);?>	
		</p>	
		</div>		
	</div>

	<div class="row">
		<div class="col-xs-12 col-md-6" style="text-align: center;">
			<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#requestModal">Request Invite</button>
			
		</div>
		<div class="col-xs-12 col-md-6" style="text-align: center;">
		<button class="btn btn-success" type="button" data-toggle="modal" data-target="#emailModal">RSVP</button>

			
		</div>
		
		<div>
			<br>
			<br><br>
		</div>

	</div>



		
</div>


<div id="requestModal" class="modal fade" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button class="close" type= "button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Request Form</h4>
				
			</div>
			<div class="modal-body">
				<div class="row">
				
				<form  id="request_form" name="request_form" method="POST" data-toggle="validator" >
								<div class="form-group col-xs-12">
									<label for="requestName" class="control-label" >Name</label>
									<input type="text" class="form-control" id="requestName" name="requestName" placeholder="Your Name" required>
								</div>

								<div class="form-group col-xs-12">
									<label for="requestEmail" >Email Address</label>
									<input type="email" class="form-control" id="requestEmail" name="requestEmail" placeholder="Your Email Addr." required>
								</div>

								<div class="col-xs-12">
									<strong>Your Preference:</strong>
								</div>
								<div class="col-xs-12">
									<br>
								</div>

								<div class="col-xs-6">
									<label class="radio-inline" >
										<input type="radio" name="inlineRadioOptions" id="vegetarian" value="vegetarian"> Vegetarian
									</label>
								</div>


								<div class="col-xs-6">
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="non_vegetarian" value="non_vegetarian" required> Non-Vegetarian
								</label>
								</div>
											
							
								
				</form>
				</div>
				</div>
				<div class="modal-footer">
					
					<button type="button" class="btn btn-success"  id="request_submit" onclick="validateFormRequest();">Request Invite</button>

				</div>				

			
	
			
		</div>
	</div>
</div>



<div id="emailModal" class="modal fade" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button class="close" type= "button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">RSVP Form</h4>
				
			</div>
			<div class="modal-body">
				<div class="row">
				
					<form  id="email_form" name="email_form" method="POST" data-toggle="validator" >
									

									<div class="form-group col-xs-12">
										<label for="rsvpEmail" >Email Address</label>
										<input type="email" class="form-control" id="rsvpEmail" name="rsvpEmail" placeholder="Your Email Addr." required>
									</div>								
								
									
					</form>
				</div>
			</div>
			<div class="modal-footer">
			
				<button type="button" class="btn btn-success"  id="email_submit" onclick="validateFormEmail();">Get Link</button>

			</div>
								

			
	
			
		</div>
	</div>
</div>


<div id="linkModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button class="close" type= "button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Link</h4>
				
			</div>
			<div class="modal-body">
				<div class="row">
				
					
									

									<div id="tokenDiv" class="form-group col-xs-12">

									
									<!-- 	<label for="rsvpLink" >Link</label> -->
										<!-- <input type="text" class="form-control" id="rsvpLink" name="rsvpLink" value="link"
										readonly> -->
									</div>								
								
									
					</form>
				</div>
			</div>
			<div class="modal-footer">
			
				

			</div>
								

			
	
			
		</div>
	</div>
</div>
		






</body>