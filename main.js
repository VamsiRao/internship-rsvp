


		function validateFormRSVP(){  

								var rsvpForm=$('#rsvp_form');
								
								if(!rsvpForm[0].checkValidity()){
									rsvpForm[0].reportValidity();
									return;	}
							//	$('#reuest_form').validator();
								 else {
										newRSVP();
										$('#rsvpModal').modal('toggle');
									}

								}  


		function validateFormRequest(){  

								var requestForm=$('#request_form');
								
								if(!requestForm[0].checkValidity()){
									requestForm[0].reportValidity();
									return;	}
							//	$('#reuest_form').validator();
								 else {
										newRequest();
										$('#requestModal').modal('toggle');
									}

								}  




		function validateFormEvent(){  

								var eventForm=$('#event_form');

								if(!eventForm[0].checkValidity()){
									eventForm[0].reportValidity();
									return;	}
							//	$('#reuest_form').validator();
								 else {
										newEvent();
									}

								}  





		function validateFormGuest(){  
										
								var guestForm=$('#guest_form');

								if(!guestForm[0].checkValidity()){
									guestForm[0].reportValidity();
									return;	}
							//	$('#reuest_form').validator();
								 else {
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



		function newRequest(){
		

	
		
			var data = $('form[name="request_form"]').serializeArray();

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
								$('#request_form').trigger("reset");
								alert("You have already registered");
						}
						else{

								if(e.status==="pending"){
									alert("Thank you for showing interest in our event. Your request has been submitted! :)");

								} else{
									alert("See you in the event! :)");
								}
								
								
								$('#request_form').trigger("reset");	
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
						
						alert("New guest has been added to the list");
							/*$('#guest_table').prepend([
										'<tr>',
										    '<td>'+e.name+'</td>',
										    '<td>'+e.email+'</td>',
										    
										    
										'</tr>'
										].join(''));
		*/

					
					
				}
				

			});

		}


			function sendConfirmData(object){
  			
  			var email= object.value;
  			

  			
			$.ajax({

				url:'guest.php',
				data:'confirmEmail='+ email,
				cache: false,
				processData: false,
				dataType:'JSON',
				type:'POST',
				success: function (e){

					ajaxGuestConfirmTable();
					ajaxGuestPendingTable();
					alert("Confirmed");
					
								
					
				}
				

			});

		}
		function ajaxGuestConfirmTable(){
  			
  			  			

  			
			$.ajax({

				url:'guest.php',
				data: { 'action':'confirmTable' },
				dataType:'JSON',
				type:'POST',
				success: function (e){
					 var guests=e;
					//console.log(guests.length);
					constructGuestConfirmTable(guests);
								
					
				}
				

			});

		}
		function ajaxGuestPendingTable(){
  			
  			  			

  			
			$.ajax({

				url:'guest.php',
				data: { 'action':'pendingTable' },
				dataType:'JSON',
				type:'POST',
				success: function (e){
					 var guests=e;
					//console.log(guests.length);
					constructGuestPendingTable(guests);
								
					
				}
				

			});

		}


		function constructGuestConfirmTable(guests){
			var html='';
			var length= guests.length;
			for(var i=0; i<length;i++){
				var guest=guests[i];
				console.log(guest['name']);
				var row_html='<tr>';
				row_html+='<td>'+guest['name']+ '</td>';
				row_html+='<td>'+guest['email']+ '</td>';
				row_html+='<td>'+guest['status']+ '</td>';
				row_html+='</tr>';

				html+=row_html;

		}
		
		$('#guest_confirm_table tbody').html(html);
			


		}


	function constructGuestPendingTable(guests){
			var html='';
			var length= guests.length;
			for(var i=0; i<length;i++){
				var guest=guests[i];
				console.log(guest['name']);
				var row_html='<tr>';
				row_html+='<td>'+guest['name']+ '</td>';
				row_html+='<td>'+guest['email']+ '</td>';
				row_html+='<td>'+guest['status']+ '</td>';
				row_html+="<td><button type='button' class='btn btn-success btn-xs' value='"+guest['email']+"' onclick='sendConfirmData(this);'>Confirm</button></td>";
				row_html+='</tr>';

				html+=row_html;



		}
		
		$('#guest_pending_table tbody').html(html);
			


		}


	/*	$(document).ready(function(){
			$('#show_new_event').click(function(){
				$('#home_container').hide();
				$('#new_event_container').show();
			});

			$('#home').click(function(){
				$('#new_event_container').hide();
				$('#home_container').show();
				
			});
			
		});
*/
