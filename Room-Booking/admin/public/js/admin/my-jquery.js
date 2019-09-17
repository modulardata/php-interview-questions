

$(document).ready(function () {
   
   // Ajax call for Active, Inactive, and Blocking Agent accounts

	   $('.manageStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$agent_id = $(this).attr('data-agent-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Block';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Agent?')) {
			 $.ajax({
				url: $base_url+'b2b/manage_agent_status',
				type: "POST",
				data: "agent_id="+ $agent_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2b/agent_manager';
				}
			});
		}
	});
	
	 // Ajax call for Active, Inactive, and Blocking User accounts
	
	$('.manageUserStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$user_id = $(this).attr('data-user-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Block';
			   
			if(confirm('Are you sure you want to '+ $msg +' this User?')) {
			 $.ajax({
				url: $base_url+'b2c/manage_user_status',
				type: "POST",
				data: "user_id="+ $user_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2c/user_manager';
				}
			});
		}
	});
	
	// Ajax call for Active, Inactive Currency Codes
	
	$('.manageCurrencyStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$currency_id = $(this).attr('data-currency-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else
			   $msg = 'Inactive';			
			   
			if(confirm('Are you sure you want to '+ $msg +' this Currency Code?')) {
			 $.ajax({
				url: $base_url+'home/manage_currency_status',
				type: "POST",
				data: "currency_id="+ $currency_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'home/currency_manager';
				}
			});
		}
	});
	
	// Ajax call updating Currency values
	
	$('.updateCurrency').live('click' , function(){
		  	
			$base_url = $(this).attr('data-base-url');
					   
			if(confirm('Are you sure you want to Update Currency Values?')) {
			 $.ajax({
				url: $base_url+'home/update_currency_values',
				type: "POST",
				beforeSend: function() {
					$("#currencyImg").show();
				},
				
				success: function (data) {
					
					$("#currencyImg").hide();
					window.location = $base_url + 'home/currency_manager';
				}
			});
		}
	});
	
	// Ajax call updating API Status
		
	$('.manageAPIStatus').live('click' , function(){
		 
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$api_id = $(this).attr('data-api-id');
			$api_name = $(this).attr('data-api-name');
		   
			if($val == 1)
			   $msg = 'Active';
			else
			   $msg = 'Inactive';			
			   
			if(confirm('Are you sure you want to '+ $msg +' this '+ $api_name +' API?')) {
			 $.ajax({
				url: $base_url+'home/manage_api_status',
				type: "POST",
				data: "api_id="+ $api_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'home/api_manager';
				}
			});
		}
	});
	
	// Ajax call updating Payment Charge Status
		
	$('.managePaymentStatus').live('click' , function(){
		 
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$id = $(this).attr('data-id');		
		   
			if($val == 1)
			   $msg = 'Active';
			else
			   $msg = 'Inactive';			
			   
		if(confirm('Are you sure you want to '+ $msg +' this Payment Charge?')) {
			 $.ajax({
				url: $base_url+'home/manage_payment_charge_status',
				type: "POST",
				data: "id="+ $id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'home/payment_manager';
				}
			});
		}
	});
	
	
	 // Ajax call for Active, Inactive, and Delete B2C Hotel Markup Master
	
	$('.manageB2CHotelMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2c/manage_b2c_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2c/hotel_markup_manager';
				}
			});
		}
	});
	
	// Ajax call for Active, Inactive, and Delete B2C Flight Markup Master
	
	$('.manageB2CFlightMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2c/manage_b2c_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2c/flight_markup_manager';
				}
			});
		}
	});
	
	// Ajax call for Active, Inactive, and Delete B2C Car Markup Master
	
	$('.manageB2CCarMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2c/manage_b2c_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2c/car_markup_manager';
				}
			});
		}
	});
	
	
	// Ajax call for Active, Inactive, and Delete B2B Hotel Markup Master
	
	$('.manageB2BHotelMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2b/manage_b2b_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2b/hotel_markup_manager';
				}
			});
		}
	});
	
	// Ajax call for Active, Inactive, and Delete B2B Flight Markup Master
	
	$('.manageB2BFlightMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2b/manage_b2b_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2b/flight_markup_manager';
				}
			});
		}
	});
	
	// Ajax call for Active, Inactive, and Delete B2B Car Markup Master
	
	$('.manageB2BCarMarkupStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$markup_id = $(this).attr('data-markup-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Delete';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Markup Value?')) {
			 $.ajax({
				url: $base_url+'b2b/manage_b2b_markup_status',
				type: "POST",
				data: "markup_id="+ $markup_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'b2b/car_markup_manager';
				}
			});
		}
	});
	
	
	// Ajax call for Active, Inactive, and Block Promotion Code
	
	$('.managePromoStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$promo_id = $(this).attr('data-promo-id');
		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Block';
			   
			if(confirm('Are you sure you want to '+ $msg +' this Promotion?')) {
			 $.ajax({
				url: $base_url+'home/manage_promotion_status',
				type: "POST",
				data: "promo_id="+ $promo_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'home/promotion_manager';
				}
			});
		}
	});	
	
	// Ajax call for Active, Inactive, and Block Admin User Status
	
	$('.manageAdminStatus').live('click' , function(){
		  
			$base_url = $(this).attr('data-base-url');
			$val = $(this).attr('data-value');
			$admin_id = $(this).attr('data-admin-id');
		   		   
			if($val == 1)
			   $msg = 'Active';
			else if($val == 0)
			   $msg = 'Inactive';
			else
			   $msg = 'Block';
			   
			if(confirm('Are you sure you want to '+ $msg +' the Admin User?')) {
			 $.ajax({
				url: $base_url+'role/manage_admin_user_status',
				type: "POST",
				data: "admin_id="+ $admin_id +"&status="+ $val,
				
				success: function (data) {
					window.location = $base_url + 'role/admin_user_manager';
				}
			});
		}
	});
	
	
});

