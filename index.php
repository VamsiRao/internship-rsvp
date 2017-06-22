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
	<title>Event</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script type="text/javascript">


		function validateFormRSVP(){  

							//	$('#rsvp_form').validator();


								var name=document.rsvp_form.rsvpName.value;  
								var email=document.rsvp_form.rsvpEmail.value;  
								  
								if (name==null || name==""){  
								  alert("Name can't be blank");  
								  return false;  
								}else if (email==null || email==""){  
								  alert("Email can't be blank");  
								  return false;
								} else {
									newRSVP();
								}

								}  




		function validateFormEvent(){  
								var name=document.event_form.eventName.value;  
								var theme=document.event_form.eventTheme.value;
								var date=document.event_form.date.value; 
								var venue=document.event_form.eventVenue.value; 


								  
								if (name==null || name==""){  
								  alert("Name can't be blank");  
								  return false;  
								}else if (theme==null || theme==""){  
								  alert("Email can't be blank");  
								  return false;
								} else if (date==null || date==""){  
								  alert("Date can't be blank");  
								  return false;
								} else if (venue==null || venue==""){  
								  alert("Venue can't be blank");  
								  return false;
								} else{
									newEvent();
								}


							}


		function validateFormGuest(){  
								var name=document.guest_form.guestName.value;  
								var email=document.guest_form.guestEmail.value;  
								  
								if (name==null || name==""){  
								  alert("Name can't be blank");  
								  return false;  
								}else if (email==null || email==""){  
								  alert("Email can't be blank");  
								  return false;
								} else {
									newGuest();
								}

								}  






		function newEvent(){
			
			
			var data = $('form[name="event_form"]').serializeArray();

			$.ajax({

				url:'functions.php',
				data:$.param(data),
				cache: false,
				processData: false,
				dataType:'JSON',
				type:'POST',
				success: function (e){

					$('#event_form').trigger("reset");

					$('#event_display').empty();
					$('#banner_name').html(e.name);
					$('#banner_theme').html(e.theme);
					$('#banner_date').html(e.date);
					$('#banner_venue').html(e.venue);
					alert("New event created");
					//Delete all elements of the table
					$('#guest_table tbody').empty();
								
					
				}
				

			});

		}

		function newRSVP(){
		

	
		
			var data = $('form[name="rsvp_form"]').serializeArray();

			$.ajax({

				url:'guest.php',
				data:$.param(data),
				cache: false,
				processData: false,
				dataType:'JSON',
				type:'POST',
				success: function (e){

					console.log(e);
					if(e.register==null)
						{
								$('#rsvp_form').trigger("reset");
								alert("You have already registered");
						}
						else{

								if(e.status==="pending"){
									alert("Thank you for showing interest in our event. Your request has been submitted! :)");

								} else{
									alert("See you in the event! :)");
								}
								
								
								$('#rsvp_form').trigger("reset");	
								$('#guest_table').prepend([
													'<tr>',
													    '<td>'+e.name+'</td>',
													    '<td>'+e.email+'</td>',
													    '<td>'+e.status+'</td>',
													    
													'</tr>'
													].join(''));
								

					
					}
				}
				

			});

		}

		function newGuest(){
			var data = $('form[name="guest_form"]').serializeArray();

			$.ajax({

				url:'guest.php',
				data:$.param(data),
				cache: false,
				processData: false,
				dataType:'JSON',
				type:'POST',
				success: function (e){
					//$(".return").html();						
						$('#guest_form').trigger("reset");	
						
							$('#guest_table').prepend([
										'<tr>',
										    '<td>'+e.name+'</td>',
										    '<td>'+e.email+'</td>',
										    
										    
										'</tr>'
										].join(''));
		

					
					
				}
				

			});

		}



		$(document).ready(function(){
			$('#show_new_event').click(function(){
				$('#home_container').hide();
				$('#new_event_container').show();
			});

			$('#home').click(function(){
				$('#new_event_container').hide();
				$('#home_container').show();
				
			});
			
		});

	</script>
</head>




<body>

	
<nav class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle"  
			 data-toggle="collapse" data-target="#example-navbar-collapse">
				 <span class="sr-only">Toggle Navigation</span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
				 <span class="icon-bar"></span>
			</button>
	
			<a class="navbar-brand" id="home_button">ColoredCow</a>	
			<ul class="nav navbar-nav navbar-left">
				<li id="home"><a href="#"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			</ul>
		</div>
	
		<div class="collapse navbar-collapse" id="example-navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
			<li id="show_new_event"><a href="#"><span class="glyphicon glyphicon-plus"></span> New Event</a></li>
			</ul>
			
		</div>
	
	</nav> 

	<?php include('home.php'); ?>
	<!-- <div class="container">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
	</div> -->

	<div class="container" id="new_event_container" style="display:none">
			<div class="row">

				<div class="col-xs-12">
					<h1>Edit Event Details</h1> <hr>
					<div class="row">
						<div class="col-xs-12">	
							<form class="form-horizontal" id="event_form" name="event_form" method="POST" action="#">
								<div class="form-group col-xs-12">
									<label for="eventName" >Name</label>
									<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Event's Name" required>
								</div>
								<div class="form-group col-xs-12">
									<label for="eventTheme" >Theme</label>
									<input type="text" class="form-control" id="eventTheme" name="eventTheme" placeholder="Event's Theme">
								</div>
								
								<div class="form-group col-xs-12">
									<label for="date">Date</label>
									<input type="date" class="form-control" id="date" name="date" placeholder="Date">
								</div>		
								<div class="form-group col-xs-12">
									<label for="eventVenue">Venue</label>
									<input type="text" class="form-control" id="eventVenue" name="eventVenue" placeholder="Event's Venue">
								</div>
								<div class="col-xs-12">
									<br>
								</div>
								<div style="text-align: right;">
								<button type="button" class="btn btn-primary" id="event_submit" onclick="validateFormEvent();" >Submit</button>
								</div>
							</form>
						</div>	
					</div>	

	<br><hr><br>
	 
				<form class="form-horizontal" id="guest_form" name="guest_form" method="POST" action="#">

					<div class="col-xs-12">
						<h3>Guests</h3>
					</div>

					<!-- <div class="col-xs-4 col-xs-offset-4 ">										
						<div class="checkbox" >
							<label>
								<input type="checkbox" id="allGuest" value="" >Invite all previous guests
							</label>
						</div>
						<br><br><br>
					</div>	 -->

					<div class="col-xs-12">
						<strong>New Guest</strong><br><br>	
					</div>
										
					<div class="form-group">

						<label for="guestName" class="col-xs-2 control-label">Name</label>
						<div class="col-xs-10">
							<input type="text" class="form-control" name="guestName" id="guestName" placeholder="John Doe"> 
						</div>
					</div>
					
					<div class="form-group">	
						<label for="guestEmail" class="col-xs-2 control-label">Email address</label>
						<div class="col-xs-10">
							<input type="email" class="form-control" name="guestEmail" id="guestEmail" placeholder="john.doe@example.com">
						</div>

					</div>
					<br>
					<div style="text-align: right;">
						<button type="button" class="btn btn-primary" onclick="validateFormGuest();">Submit</button>
					</div>
				</form>
							</div>

						</div>
					</div>	
	
</body>
</html>
	
