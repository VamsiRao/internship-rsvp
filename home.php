<div class="container"  id='home_container' >
	<div class="row">
		<div class="col-xs-12"">
		<p  id="event_display" style="text-align: center;">
			<?php retrieveDataEvent($connect);?>	
		</p>	
		</div>		
	</div>
	<div class="row">
			<div class="col-xs-6">
				<form  id="rsvp_form" name="rsvp_form" method="POST" data-toggle="validator" >
								<div class="form-group col-xs-12">
									<label for="rsvpName" class="control-label" >Name</label>
									<input type="text" class="form-control" id="rsvpName" name="rsvpName" placeholder="Your Name" required>
								</div>

								<div class="form-group col-xs-12">
									<label for="rsvpEmail" >Email Address</label>
									<input type="email" class="form-control" id="rsvpEmail" name="rsvpEmail" placeholder="Your Email Addr.">
								</div>

								<div class="col-xs-12">
									<strong>Your Preference:</strong>
								</div>
								<div class="col-xs-12">
									<br>
								</div>

								<div class="col-xs-4">
									<label class="radio-inline" >
										<input type="radio" name="inlineRadioOptions" id="vegetarian" value="vegetarian"> Vegetarian
									</label>
								</div>


								<div class="col-xs-4">
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="non_vegetarian" value="non_vegetarian"> Non-Vegetarian
								</label>
								</div>
								<div class="col-xs-4">
								<label class="radio-inline">
								  <input type="radio" name="inlineRadioOptions" id="both" value="both" checked="" > Open to both
								</label>
								</div>

								<div class="col-xs-12">
									<br>
								</div>
								
								<div style="text-align: right;">
							
								<button type="button" class="btn btn-success" id="rsvp_submit" onclick="validateFormRSVP();">RSVP</button>
								</div>
								</form>
								

			</div>
			<div class="col-xs-6">
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
		<div class="row">
				<div class="col-xs-12"></div>
		</div>
</div>
