


		function validateFormEmail(){  

								var emailForm=$('#email_form');
								
								if(!emailForm[0].checkValidity()){
									emailForm[0].reportValidity();
									return;	}
							//	$('#reuest_form').validator();
								 else {
										newLink();
										
										
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

				url:'guest.php',
				data:$.param(data),
				cache: false,
				processData: false,
				dataType:'JSON',
				type:'POST',
				success: function (e){
					
					var events=e;
					$('#eventModal').modal('toggle');
					$('#event_form').trigger("reset");

					constructEventTable(events);
					
				}
				

			});

		}
		function newLink(){
				

			
				
					var data = $('form[name="email_form"]').serializeArray();

					$.ajax({

						url:'guest.php',
						data:$.param(data),
						cache: false,
						processData: false,
						dataType:'JSON',
						type:'POST',
						success: function (e){

							console.log(e);
							 if(e.register==="register") {
								
								alert("Please request an invite first");
								$('#email_form').trigger("reset");	
							
							} else if(e.register==="registered"){

								alert("You have already registered");
								$('#email_form').trigger("reset");
								$('#emailModal').modal('toggle');

							}else {
								var url =e.url;
								$('#tokenDiv').html(url);
								
								$('#email_form').trigger("reset");
								$('#emailModal').modal('toggle');
								$('#linkModal').modal('toggle');
							}
																
								
										
										

							
							
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
							if(e.register=="registered")
								{
										$('#rsvp_form').trigger("reset");
										alert("You have already registered");
								}
								else if(e.register==="register") {
							alert("Please request an invite first");
													}
								else{

										if(e.status==="pending"){
											alert("Thank you for showing interest in our event. Your request has been submitted! :)");

										} else{
											alert("See you in the event! :)");
										}
										
										
										$('#rsvp_form').trigger("reset");	
										
										

							
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
					if(e.register==="registered")
						{
								$('#request_form').trigger("reset");
								alert("You have already registered");
						}else if (e.register==="register") {
							alert("Please request an invite first");
						}


						else{

								if(e.status==="pending"){
									alert("Thank you for showing interest in our event. Your request has been submitted! :)");

								} else{
									alert("See you in the event! :)");
								}
								
								
								$('#request_form').trigger("reset");	
								
					
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
						
						if(e.entry==="entered"){
							alert("Guest is already in the guest list");
						}
						else{
							alert("Guest "+e.name+" is entered")

						}
							/*$('#guest_table').prepend([
										'<tr>',
										    '<td>'+e.name+'</td>',
										    '<td>'+e.email+'</td>',
										    
										    
										'</tr>'
										].join(''));
						}
						}
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
				
				var row_html='<tr>';
				row_html+='<td>'+guest['name']+ '</td>';
				row_html+='<td>'+guest['email']+ '</td>';
				row_html+="<td><span class='label label-info'>"+guest['status']+ "</span></td>";
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
				
				var row_html='<tr>';
				row_html+='<td>'+guest['name']+ '</td>';
				row_html+='<td>'+guest['email']+ '</td>';
				row_html+="<td><span class='label label-warn'>"+guest['status']+ "</span></td>";
				row_html+="<td><button type='button' class='btn btn-success btn-xs' value='"+guest['email']+"' onclick='sendConfirmData(this);'>Confirm</button></td>";
				row_html+='</tr>';

				html+=row_html;



		}
		
		$('#guest_pending_table tbody').html(html);
			


		}


	function constructEventTable(events){
			var html='';
			var length= events.length;
			for(var i=0; i<length;i++){
				var event=events[i];
				
				var row_html='<tr>';
				row_html+='<td>'+event['name']+ '</td>';
				row_html+='<td>'+event['theme']+ '</td>';
				row_html+='<td>'+event['date']+ '</td>';
				row_html+='<td>'+event['venue']+ '</td>';
				row_html+='</tr>';

				html+=row_html;



		}
		
		$('#event_table tbody').html(html);
			


		}





		function closeWindow(){
			window.close();
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
