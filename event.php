<?php 
 
 include 'navbar.php';
 include 'guest.php';

?>

<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
 -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="main.js"></script>

<div class="container">
	<div class="row">
			
				<h1>
					<span>Event Details</span>
					<button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#eventModal">Add Event</button>
				</h1>
				<hr>
			

				<div class="col-xs-12 col-md-12 ">
				<table class="table table-hover" id="event_table" name="event_table">
 					<thead>
				      <tr>
				         <th>Event</th>
				         <th>Theme</th>
				         <th>Date</th>
				         <th>Venue</th>
				      </tr>
				   </thead>
				   
				   <tbody>
				      
				     
				      	<?php
			      					
					      			$events= retrieveEventDataTable($connect);

					      			foreach ($events as $event) {
					      	
					      	 				echo"<tr><td>{$event['name']}</td>".
					      	 					"<td>{$event['theme']}</td>".
					      	 					"<td>{$event['date']}</td>".
					      	 					"<td>{$event['venue']}</td></tr>";		      	 								      	 					
					      					
					      				}
				      		
			      		      		
				      	?>
				    
				     
				   </tbody>
					
 				</table>
			</div>

			
					
	</div>
</div>


<div id="eventModal" class="modal fade" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">

				<button class="close" type= "button" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add Event</h4>
				
			</div>
			<div class="modal-body">
			<div class="row">
				
							<form  id="event_form" name="event_form" method="POST" data-toggle="validator">
								<div class="form-group col-xs-12">
									<label for="eventName" >Name</label>
									<input type="text" class="form-control" id="eventName" name="eventName" placeholder="Event's Name" required>
								</div>
								<div class="form-group col-xs-12">
									<label for="eventTheme" >Theme</label>
									<input type="text" class="form-control" id="eventTheme" name="eventTheme" placeholder="Event's Theme" required>
								</div>
								
								<div class="form-group col-xs-12">
									<label for="date">Date</label>
									<input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
								</div>		
								<div class="form-group col-xs-12">
									<label for="eventVenue">Venue</label>
									<input type="text" class="form-control" id="eventVenue" name="eventVenue" placeholder="Event's Venue" required>
								</div>
								
							</form>
					
					</div>
					</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="event_submit" onclick="validateFormEvent();">Add</button>
		
				</div>
			
			</div>
		</div>	
	</div>				