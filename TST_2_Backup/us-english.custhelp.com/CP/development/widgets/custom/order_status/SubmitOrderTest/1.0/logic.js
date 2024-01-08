RightNow.namespace('Custom.Widgets.order_status.SubmitOrderTest');
Custom.Widgets.order_status.SubmitOrderTest = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {   
        /** 
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
			
            this.parent();
			
			RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjaxRequest, this);
        },
			   _formSubmitResponse: function(type, args) {
			
        var responseObject = args[0].data, result;
		
		//=======attempts==========
			//var interface=this.data.attrs.interface_type;
			//track_order_status_attempts(interface);
		
		var country_id=document.getElementsByName("Contact.Address.Country")[0].value;
		
		
		if(document.getElementById('close-btn'))
		{
			document.getElementById('close-btn').style.display="block";
		}
		
		if(document.getElementById('odrSub'))
		{
			document.getElementById('odrSub').style.display="none";
			document.getElementById('odrSub').style.visibility="hidden";
		}
		
		
        if (!responseObject) { 
		
			var lobVal = document.getElementById("lob_value").value;
			
			
		   	document.getElementById("errors").innerHTML ="<div><b>Please enter a valid order number or email and zip/post/postal code</b></div>";
			
			if(responseObject.display_chat == 1)
			{
			
			if( (country_id==1) || (country_id==0) )//us
			{
				document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
							
			}
			
			if(country_id==2)//canada
			{
							
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.ca/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
				
			}
			if(country_id==7)//uk
			{
		
				
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.co.uk/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
			}
			
			//document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/team' target='_blank' >Chat</a> <span>for //assistance</span></b></div>";
			
			
			}
        }
		   
		 
        else if (responseObject.errors) {
			
			
			document.getElementById("errors").style.display="block";
			document.getElementById("errors").innerHTML ="<div><b>Please enter a valid order number or email and zip/post/postal code</b></div>";
			
			
			
			if(responseObject.display_chat == 1)
			{
			var lobVal = document.getElementById("lob_value").value;
			
			
			if( (country_id==1) || (country_id==0) )//us
			{
				document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
							
			}
			if(country_id==2)//canada
			{
							
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.ca/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
				
			}
			if(country_id==7)//uk
			{
		
				
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.co.uk/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
			}
			
			
			
			//document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/team' target='_blank'>Chat</a> <span>for //assistance</span></b></div>";
			}
           
        }
		
			
        else if (responseObject) {
			
			//=======success=========
			//var interface=this.data.attrs.interface_type;
			//track_order_status_success(interface);
						
			if(responseObject.length>1)
			{
			
				getOrderStatusMultiple(responseObject);
			}
					
			else
			{
			
				this.getOrderStatus(responseObject);	
			}
				
		document.getElementById("rn_QuestionSubmit").style.display = "none";
		//document.getElementById("heading").style.display = "none";
		document.getElementById("errors").style.display = "none";
		document.getElementById("display_chat").style.display = "none";
				
			}
        else {
			
            // Response object didn't have a result or errors on it.
            //this._displayErrorDialog();
			document.getElementById("errors").innerHTML ="<div><b>Please enter a valid order number or email and zip/post/postal code</b></div>";
			
			
			if(responseObject.display_chat == 1)
			{
			
			var lobVal = document.getElementById("lob_value").value;
			
			
			if( (country_id==1) || (country_id==0) )//us
			{
				document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
							
			}
			if(country_id==2)//canada
			{
							
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.ca/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
				
			}
			if(country_id==7)//uk
			{
		
				
				document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.co.uk/app/chat/chat_launch/lob/"+lobVal+"' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
				
			}
			
			
			//document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/team' target='_blank'>Chat</a> <span>for //assistance<span></b></div>";
			}
        }

        this._toggleLoadingIndicators(false);
        this._toggleClickListener(true);

        args[0].data || (args[0].data = {});
        args[0].data.form = this._parentForm;
        RightNow.Event.fire('evt_formButtonSubmitResponse', args[0]);
    }

        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onButtonClick: function(evt)
        // _fireSubmitRequest: function()
        // _onFormValidated: function()
        // _onFormValidationFail: function()
        // _formSubmitResponse: function(type, args)
        // _onFormUpdated: function()
        // _onErrorResponse: function()
        // _displayErrorDialog: function(message)
        // _onFormTokenUpdate: function(type, args)
        // _enableFormExpirationWatch: function()
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	getOrderStatus: function(responseObject) {
		//var title = "<div><h1>ORDER STATUS</h1></div>";
		
		var title = "<div>ORDER STATUS</div>";
		
		if(document.getElementById("headingOrder"))
		{
			document.getElementById("headingOrder").innerHTML = title;
		}
	
		   if(responseObject.order_status_id == 2 || responseObject.order_status_id == 6)
			{
			var country_id=document.getElementsByName("Contact.Address.Country")[0].value;			 
			 
				var status = "cancelled";
			
			if(country_id==7)//uk
			{
		document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div>Your order "+responseObject.order_number+" for "+responseObject.product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial 0800-953-6100 for assistance.</div></div>"
			}
			else
			{
			
		document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div>Your order "+responseObject.order_number+" for "+responseObject.product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial (800) 470-7870 for assistance.</div></div>"	
			}
			}
			
			
			else if(responseObject.order_status_id == 1 || responseObject.order_status_id == 4 || responseObject.order_status_id == 5 || responseObject.order_status_id == 8 || responseObject.order_status_id == 9)
			{
				
				
			var status = "processing";
			
			/*getting date difference of order created date and current date and 
			if it is greater than 6 content of popup will be different--done by Vimal on 10/5/2016
			*/
			var track_id=responseObject.tracking_number;
			var order_created_date=responseObject.order_create_date;
			
						
			var today = new Date();
			var dd = today.getDate(); 
			var mm = today.getMonth()+1; 
			var yyyy = today.getFullYear(); 
			
			var cur_date=mm+'/'+dd+'/'+yyyy;
			
			var date1 = new Date(order_created_date);
			var date2 = new Date(cur_date);

			var diffDays = parseInt((date2 - date1) / (1000 * 60 * 60 * 24)); 
          // track_id="";
			if( (track_id=="" || track_id== null) && (diffDays > 6 ) )//different popup content
			{
				
				var lobVal = document.getElementById("lob_value").value;
				
						
				document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div>We"+"'"+"ve noticed your order "+responseObject.order_number+" for "+responseObject.product+" placed on "+responseObject.order_create_date+" has not shipped.</div><div> <a href='/app/chat/chat_launch/lob/"+lobVal+"' target='_blank'>Chat</a> for assistance.</div>";
				
				
			}
			else//old popup content
			{
			
			
			document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div>The order "+responseObject.order_number+" you placed on "+responseObject.order_create_date+" for "+responseObject.product+" was received and it is "+status+".</div><div>What's next? You'll receive a shipping confirmation email with tracking details.</div><div class='new-modi most-order'>Make sure to check your junk and spam folders if unable to find our emails.</div></div>";
			}
			
			} 
			else if(responseObject.order_status_id == 3 || responseObject.order_status_id == 7)
			{
			
				
			var href="",footer_message="";//initialization done to avoid showing Undefined variable in the popup--Vimal
			var status = "Shipped";
			
			//responseObject.tracking_number="145077876352368";
			
			if(responseObject.tracking_number)
			{
				
			var firstTwo=responseObject.tracking_number.substring(0,2);
			
			var country_id=document.getElementsByName("Contact.Address.Country")[0].value;
			
			var chkTrackId="";
			
			function isChar(str) 
			{
 			 return /^[a-zA-Z()]+$/.test(str);
			}
			
			
			if(isChar(firstTwo )){
				chkTrackId="OK";
			}else{
				chkTrackId="NO";
			}
				
				if(country_id==7)//uk
				{
				
				var hermesPostcode=responseObject.zip_code.replace(/\s/g,'');
							
				var href = "https://www.hermes-europe.co.uk/tracker.html?trackingNumber="+responseObject.tracking_number+"&Postcode="+hermesPostcode;
			
				var footer_message="<div class='new-modi-style'>Shipped via Hermes</div>";
				}
				else
				{
				
				
			//---------USPS------------
			
			if(responseObject.tracking_number.length>=22 && responseObject.tracking_number.substring(0,1)=='9')
			{
				
				var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject.tracking_number+"&cntry_code=us";
			//var href = "https://tools.usps.com/go/TrackConfirmAction.action?tRef=fullpage&tLc=1&text28777=&tLabels="+responseObject.tracking_number; fedex usps fix
			var footer_message="<div class='new-modi-style'>Shipped via FedEx.com</div>";
			}
			
			//--------------FEDEX-----------------------
			
			else if(responseObject.tracking_number.length>=12 && responseObject.tracking_number.substring(0,1)=='7')
		   {
			var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject.tracking_number+"&cntry_code=us";
			var footer_message="<div class='new-modi-style'>Shipped via FedEx.com</div>";
			}
			
			else if(responseObject.tracking_number.length==13 && chkTrackId=="OK"   )
			{
						
			var href = "https://track.aftership.com/landmark-global/"+responseObject.tracking_number;
			
			var footer_message="<div class='new-modi-style'>Shipped via AfterShip.com</div>";
			}
			}
			
			
			}
			
			
			document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div class='order_top'>Your order "+responseObject.order_number+" for "+responseObject.product+" placed on "+responseObject.order_create_date +", shows that it "+status+" on "+responseObject.shipped_date +".</div><div class='track-div'>Your tracking number is</div><div><a href="+href+" target='_blank' >"+responseObject.tracking_number+"</a></div><div class='new-modi'>"+footer_message+"</div></div>";
		
			}
			else
			{
			
			document.getElementById("valid_data").innerHTML ="<div class='shipped_order'><div>Your recent order is under processing!!.</div></div>"
			
			}
			
			
			
			
			/*
			document.getElementById("valid_data").innerHTML+="<input type='checkbox' id='check_box' onclick='handleClick("+responseObject.order_number+");'>Receive Text Message";
			
			if(responseObject.sms_enabled == 1)
			{  
				
			document.getElementById("valid_data").innerHTML+="<div id='div_phone' style='display:block'><label id='phone_label'>Please enter your phone number</label><input type='text' id='phone1'/><div id='div_submit'><input type='submit' id='submit_phone' value='Submit' onclick=' return onSubmit("+responseObject.order_number+");'/></div></div>";
			document.getElementById("check_box").checked = true;
			}
			else
			{
				document.getElementById("check_box").checked = false;	
			}
			*/
			
			
			
			
	},
	
	
	_onBeforeAjaxRequest: function(type, args)
		{
		
			//alert(args[0].scope.instanceID);
			requestOptions = args[0];
			
			//added click tracking parameters along with this ajax call to make functioning click tracking and order search at a time
			//-------------------------------------------------------------
			
				var uri = window.location;
				var uri_enc = encodeURIComponent(uri);


				var interface=this.data.attrs.interface_type;
				var mob;

				if(interface=='true')
				{
					mob=0;//the value of mob is 0 for new design
				}
				else if(interface=='false')
				{
					mob=1;
				}
				else
				{
					mob=3;	
				}
			//-------------------------------------------------------------
			
			
			if(requestOptions.url == "/ci/ajaxRequest/sendForm" && args[0].scope.instanceID == this.instanceID)
			{
				//requestOptions.url = "/cc/AjaxCustom/submit_order_status";//old
				requestOptions.url = "/cc/AjaxCustom/submit_order_status/"+uri_enc+"/" +mob;
			}
			
		},
		  _onErrorResponse: function() {
			
        this._displayErrorDialog(RightNow.Interface.getMessage('ERROR_REQUEST_ACTION_COMPLETED_MSG'));
        this._toggleLoadingIndicators(false);
        this._toggleClickListener(true);
    },

		
		
	

    /**
     * Renders the `view.ejs` JavaScript template.
     */
    renderView: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});
	function myFunction(i,count) {
	for(j=0;j<count;j++)
	{
		if(j!=i)	
		document.getElementById("block_"+j).style.display="none";	
	}
	
	if(document.getElementById("block_"+i).style.display=="none")
	{
		document.getElementById("block_"+i).style.display = "block";
	}
	else if(document.getElementById("block_"+i).style.display=="block")
	{
		document.getElementById("block_"+i).style.display = "none";
	}
	
}


	function getOrderStatusMultiple(responseObject) {
		
		//var title = "<div><h1>ORDER STATUS</h1></div>";
		var title = "<div>ORDER STATUS</div>";
		
		document.getElementById("headingOrder").innerHTML = title;	
		//var order_message="";
		//var order_links ="";
		
		
		//Getting current date to process with order created date
			var today = new Date();
			var dd = today.getDate(); 
			var mm = today.getMonth()+1; 
			var yyyy = today.getFullYear(); 
			
			var cur_date=mm+'/'+dd+'/'+yyyy;
			
			
		
		var heading="";
		
		for(var i=0;i<responseObject.length;i++)
		{
			
			
			
		 heading += "<div class='multiple_order_links'><span id='links_"+i+"' value='1'><b><a href='javascript:void(0);' onclick='myFunction("+i+","+responseObject.length+");'>"+responseObject[i].product+"</a></b></span><span> ordered on "+responseObject[i].order_create_date+"</span></div>"; 
		
		
	      if(responseObject[i].order_status_id == 2 || responseObject[i].order_status_id == 6)
		  {
			
			var country_id=document.getElementsByName("Contact.Address.Country")[0].value;
			
			var status = "cancelled";
			
			if(country_id==7)//uk
			{

			heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div> Your order "+responseObject[i].order_number+" for "+responseObject[i].product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial 0800-953-6100 for assistance.</div></div>";	
			}
			else
			{

			heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div> Your order "+responseObject[i].order_number+" for "+responseObject[i].product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial (800) 470-7870 for assistance.</div></div>"	
			}
				
		 }
			else if(responseObject[i].order_status_id == 1 || responseObject[i].order_status_id == 4 || responseObject[i].order_status_id == 5 || responseObject[i].order_status_id == 8 || responseObject[i].order_status_id == 9)
			{
			
			var status = "processing";
			
			/*getting date difference of order created date and current date and 
			if it is greater than 6 content of popup will be different--done by Vimal on 10/5/2016
			*/
			var date1 = new Date(responseObject[i].order_create_date);
			var date2 = new Date(cur_date);

			var diffDays = parseInt((date2 - date1) / (1000 * 60 * 60 * 24)); 
			
			var track_id=responseObject[i].tracking_number;
				
			//track_id="";	//testing
			
			
			
			if((track_id=="" || track_id== null) && (diffDays > 6 ))//different popup content
			{
							
				 heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div>We"+"'"+"ve noticed your order "+responseObject[i].order_number+" for "+responseObject[i].product+" placed on "+responseObject[i].order_create_date+" has not shipped.</div> <div> <a href='/app/chat/chat_launch/lob/team' target='_blank'>Chat</a> for assistance.</div></div>";
			
	    	}
			else
			{
			
			 heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div>The order "+responseObject[i].order_number+" you placed on "+responseObject[i].order_create_date+" for "+responseObject[i].product+" was received and it is "+status+".</div><div>What's next? You'll receive a shipping confirmation email with tracking details.</div><div class='new-modi most-order'>Make sure to check your junk and spam folders if unable to find our emails.</div></div>";
			 
		}
			 
			}
			else if(responseObject[i].order_status_id == 3 || responseObject[i].order_status_id == 7)
			{
		
		
			var status = "Shipped";
			var href="",footer_message="";//initialization done to avoid showing Undefined variable in the popup--Vimal
			
			if(responseObject[i].tracking_number)
			{
				
			var firstTwo=responseObject[i].tracking_number.substring(0,2);
			
			var country_id=document.getElementsByName("Contact.Address.Country")[0].value;
			
			var chkTrackId="";
			
			function isChar(str) 
			{
 			 return /^[a-zA-Z()]+$/.test(str);
			}
			
			
			if(isChar(firstTwo )){
				chkTrackId="OK";
			}else{
				chkTrackId="NO";
			}
				
				if(country_id==7)//uk
				{
				var hermesPostcode=responseObject[i].zip_code.replace(/\s/g,'');
					
					
				var href = "https://www.hermes-europe.co.uk/tracker.html?trackingNumber="+responseObject[i].tracking_number+"&Postcode="+hermesPostcode;
			
				var footer_message="<div class='new-modi-style'>Shipped via Hermes</div>";
				}
				else
				{
				
				
			//------------USPS--------
			
			if(responseObject[i].tracking_number.length>=22 && responseObject[i].tracking_number.substring(0,1)=='9')
			{
			//var href = "https://tools.usps.com/go/TrackConfirmAction.action?tRef=fullpage&tLc=1&text28777=&tLabels="+responseObject[i].tracking_number; fedex usps fix
			
			var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject[i].tracking_number+"&cntry_code=us";
			
			var footer_message="<div class='new-modi-style'>Shipped via USPS.com</div>";
			}
			 
			//-----------------FEDEX--------------
			//else if(responseObject[i].tracking_number.length>=13 && responseObject[i].tracking_number.substring(0,1)=='6')
			else if(responseObject[i].tracking_number.length>=12 && responseObject[i].tracking_number.substring(0,1)=='7')
			{
			var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject[i].tracking_number+"&cntry_code=us";
			var footer_message="<div class='new-modi-style'>Shipped via FedEx.com</div>";
			}
			
			//-----------------LANDMARK CANADA 
			 
			
			else if(responseObject[i].tracking_number.length==13 && chkTrackId=="OK"  )
			{
						
			var href = "https://track.aftership.com/landmark-global/"+responseObject[i].tracking_number;
			
			var footer_message="<div class='new-modi-style'>Shipped via AfterShip.com</div>";
			}
			}
			
			
			}
			
			 heading += "<div class='multiple_order' id='block_"+i+"'style='display:none;'><div>Your order "+responseObject[i].order_number+" for "+responseObject[i].product+" placed on "+responseObject[i].order_create_date +", shows that it "+status+" on "+responseObject[i].shipped_date +".</div><div class='track-div'>Your tracking number is</div><div><a href="+href+" target='_blank'>"+responseObject[i].tracking_number+"</a></div><div class='new-modi'>"+footer_message+"</div></div>";
		
			}
			else
			{
			 heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div> Your recent order is under processing!!.</div></div>"
			}
			
		
		 }  
				
			document.getElementById("valid_data").innerHTML = heading;	
	
	
	}
	function handleClick(value)
	{
		if(document.getElementById('success_message'))
		{
			//document.getElementById('success_message').style.display="none";
		}
		
		
	if(document.getElementById("check_box").checked)
	{
		var flag = 1;
		if(document.getElementById("div_phone"))
		{
			var parent_div = document.getElementById("valid_data");
			var child_div = document.getElementById("div_phone");
			parent_div.removeChild(child_div);	
		}
		
	document.getElementById("valid_data").innerHTML+="<div id='div_phone' style='display:block'><label id='phone_label'>Please enter your phone number</label><input type='text' id='phone1' /> <div id='div_submit'><input type='submit' id='submit_phone' value='Submit' onclick='onSubmit("+value+");' /></div></div>";
document.getElementById("check_box").checked = true;
	}
	else 
	{
			document.getElementById("invalid_data").style.display="none"; 
		if(document.getElementById("div_phone"))
		{
			var parent_div = document.getElementById("valid_data");
			var child_div = document.getElementById("div_phone");
			parent_div.removeChild(child_div);	
		}
		if(document.getElementById('success_message'))
		{
			var parent = document.getElementById("valid_data");
			var child = document.getElementById("success_message");
			parent.removeChild(child);	
		}
		flag = 0;
	}
	
RightNow.Ajax.makeRequest('/cc/AjaxCustom/getCheckboxValue', {checked_value:flag , order_no:value}, {
                    successHandler: function(response) {
                       					
                    },
                    scope: this,
                    json: true,
                    type: "POST"
                }); 

	}
	
	function onSubmit(order_number)
	{
		var phone_number=document.getElementById('phone1').value;
		
		if(phone_number == "")
		{
			document.getElementById("invalid_data").style.display="block";
			document.getElementById("invalid_data").innerHTML ="Please enter a valid phone number";
			document.getElementsByName("invalid_phone")[0].className='rn_MessageBox rn_ErrorMessage';
		}
		else
		{
			document.getElementById("invalid_data").style.display="none"; 
		RightNow.Ajax.makeRequest('/cc/AjaxCustom/updatePhoneNumber', {phone_no:phone_number , order_no:order_number}, {
                    successHandler: function(response) {
						
						
									//alert("successs11");
							if(document.getElementById('div_phone'))
							{
								var parent = document.getElementById("valid_data");
								var child = document.getElementById("div_phone");
								parent.removeChild(child);	
							}
							
                       		document.getElementById("valid_data").innerHTML+="<div id='success_message'>Your phone number has been saved !</div>";
						
						
						
						document.getElementById('check_box').checked=true;
						if(document.getElementById('div_phone'))
						document.getElementById('div_phone').style.display="none";
						
                    },
                    scope: this,
                    json: true,
                    type: "POST"
                }); 
		}
	}
	
	//=================track order status success click=====================
	
	
	function  track_order_status_success(interface)
	{
		
		var mob;
		if(interface=='true')
		{
			
			mob=0;//the value of mob is 0 for new design
		}
		else if(interface=='false')
		{
			
			mob=1;
		}
		else
		{
			
			mob=3;	
		}
		
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		 
		}
	  }
	  var uri = window.location;
	  var uri_enc = encodeURIComponent(uri);
	  
	  
	 // var mob = 0;//the value of mob is 0 for new design
	 if(mob!=3)
	 {
		 xmlhttp.open("GET","/cc/AjaxCustom/track_order_status_successfull_search/"+uri_enc+'/'+mob+'?'+Math.random()*Math.random(),true);
		  xmlhttp.send();
	 }
	  
	}

 
//=================track order status attempts click=====================
	
	
	function  track_order_status_attempts(interface)
	{
		
		var mob;
		if(interface=='true')
		{
			
			mob=0;//the value of mob is 0 for new design
		}
		else if(interface=='false')
		{
			
			mob=1;
		}
		else
		{
			
			mob=3;	
		}
		
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	  } else { // code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		 
		}
	  }
	  var uri = window.location;
	  var uri_enc = encodeURIComponent(uri);
	  
	  
	 // var mob = 0;//the value of mob is 0 for new design
	 if(mob!=3)
	 {
		
		  xmlhttp.open("GET","/cc/AjaxCustom/track_order_status_attempts/"+uri_enc+'/'+mob+'?'+Math.random()*Math.random(),true);
		  xmlhttp.send();
	 }
	  
	}
	