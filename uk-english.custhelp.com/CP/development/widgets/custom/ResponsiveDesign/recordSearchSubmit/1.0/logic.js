RightNow.namespace('Custom.Widgets.ResponsiveDesign.recordSearchSubmit');
Custom.Widgets.ResponsiveDesign.recordSearchSubmit = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
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

		if(document.getElementById('close-btn'))
		{
			document.getElementById('close-btn').style.display="block";
		}


        if (!responseObject) {

		
		   	document.getElementById("errors").innerHTML ="<div><b> 1. Please enter a valid order number or email and zip/pos/postal code</b></div>";
			if(responseObject.display_chat == 1)
			{
			
			//document.getElementById("errors").innerHTML +=	"<div><b><a href='/app/chat/chat_launch/lob/team' target='_blank' >Chat</a> //<span>for assistance</span></b></div>";
			
			//chat Redirected to My account(Update Credit Card)
			
			document.getElementById("errors").innerHTML +=	"<div><b><a href='https://faq.beachbody.com/app/contactus_support/catid/1773/catname/Update-Credit-Card/ans_sec/7660/TLP/1703.My-Account' target='_blank' >Chat</a> <span>for assistance</span></b></div>";
			
			}
        }
		   
		 
        else if (responseObject.errors) {
		
		
		    document.getElementById("rn_ErrorLocation_vv").setAttribute("class", "");
		
        	document.getElementById("rn_ErrorLocation_vv").style.display="block";
			
			document.getElementById("rn_ErrorLocation_vv").innerHTML ="<span>We were unable to locate your account with the information below, please call us to update your credit card.<br/>US and Canada: 800-470-7870 UK: 0800-953-6100</span>";
			
			
			
			document.getElementById("errors").style.display="block";
			
						
        }
		
			
        else if (responseObject) {
		
			if(responseObject.length>1)
			{
				this.getOrderStatusMultiple(responseObject);
			}
					
			else
			{
			
				this.getOrderStatus(responseObject);	
			}
				
			document.getElementById("rn_QuestionSubmit_vv").style.display = "none";
			
			document.getElementById("errors").style.display = "none";
			document.getElementById("display_chat").style.display = "none";
					
			}
        else {
			
           
			document.getElementById("errors").innerHTML ="<div><b>3. Please enter a valid order number or email and zip/postal code</b></div>";
			
			
        }

        this._toggleLoadingIndicators(false);
        this._toggleClickListener(true);

        args[0].data || (args[0].data = {});
        args[0].data.form = this._parentForm;
        RightNow.Event.fire('evt_formButtonSubmitResponse', args[0]);
		
    }

        
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
getOrderStatusMultiple: function(responseObject) {
	
		
	
		var title = "<div>ORDER STATUS</div>";
		
		document.getElementById("heading").innerHTML = title;	
		
		
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
			
			var status = "cancelled";
			
		 heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div> Your order "+responseObject[i].order_number+" for "+responseObject[i].product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial (800) 470-7870 for assistance.</div></div>"	
			
				
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
							
				 heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div>We"+"'"+"ve noticed your order "+responseObject[i].order_number+" for "+responseObject[i].product+" placed on "+responseObject[i].order_create_date+" has not shipped.</div> <div> <a href='https://faq.beachbody.com/app/contactus_support/catid/1773/catname/Update-Credit-Card/ans_sec/7660/TLP/1703.My-Account' target='_blank'>Chat</a> for assistance.</div></div>";
			
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
				
			//------------USPS--------
			
			if(responseObject[i].tracking_number.length>=22 && responseObject[i].tracking_number.substring(0,1)=='9')
			{
			
			
			var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject[i].tracking_number+"&cntry_code=us";
			
			var footer_message="<div class='new-modi-style'>Shipped via USPS.com</div>";
			}
			 
			//-----------------FEDEX--------------
		
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
			 
			 heading += "<br/><div class='multiple_order' id='block_"+i+"'style='display:none;'><div>Your order "+responseObject[i].order_number+" for "+responseObject[i].product+" placed on "+responseObject[i].order_create_date +", shows that it "+status+" on "+responseObject[i].shipped_date +".</div><div class='track-div'>Your tracking number is</div><div><a href="+href+" target='_blank'>"+responseObject[i].tracking_number+"</a></div><div class='new-modi'>"+footer_message+"</div></div>";
		
			}
			else
			{
					
					heading +="<div class='multiple_order' id='block_"+i+"'style='display:none;'><div> Your recent order is under processing!!.</div></div>"
			}

		
		 }  
			heading += "<hr class='clearfix'><h1 class='ccu_next_h1'>Click next to continue</h1><br/>"	
			
			$("div #heading").empty();
			$("div #heading").html("We found your account. Here are your recent orders<hr/>");
			heading+= '<button id="next" class="btn btn-primary" onclick="javascript:redirectNextPage_vv()" >Next</button>';	 
			document.getElementById("valid_data_vv").innerHTML = heading;	
	
	
	},
	getOrderStatus: function(responseObject) {
		
		
		var title = "<div>ORDER STATUS</div>";
		
		if(document.getElementById("heading"))
		{
			document.getElementById("heading").innerHTML = title;
		}
	
	
		   if(responseObject.order_status_id == 2 || responseObject.order_status_id == 6)
			{
			 	
			var status = "cancelled";	
			heading="<div class='shipped_order'><div>Your order "+responseObject.order_number+" for "+responseObject.product+" has been "+status+". If you"+"'"+"d like to speak to a Beachbody representative, dial (800) 470-7870 for assistance.</div></div>";
			heading += "<hr class='clearfix'><h1 class='ccu_next_h1'>Click next to continue</h1><br/>"	
			
			$("div #heading").empty();
			$("div #heading").html("We found your account. Here are your recent orders<hr/>");
			heading+= '<button id="next" class="btn btn-primary" onclick="javascript:redirectNextPage_vv()" >Next</button>';	 
			document.getElementById("valid_data_vv").innerHTML = heading;	

			
			
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
				
				
				
				heading ="<div class='shipped_order'><div>We"+"'"+"ve noticed your order "+responseObject.order_number+" for "+responseObject.product+" placed on "+responseObject.order_create_date+" has not shipped.</div><div> <a href='https://faq.beachbody.com/app/contactus_support/catid/1773/catname/Update-Credit-Card/ans_sec/7660/TLP/1703.My-Account' target='_blank'>Chat</a> for assistance.</div>";
			}
			else//old popup content
			{
			
			
			heading="<div class='shipped_order'><div>The order "+responseObject.order_number+" you placed on "+responseObject.order_create_date+" for "+responseObject.product+" was received and it is "+status+".</div><div>What's next? You'll receive a shipping confirmation email with tracking details.</div><div class='new-modi most-order'>Make sure to check your junk and spam folders if unable to find our emails.</div></div>";
			
			
			
			}
			
			
			heading += "<hr class='clearfix'><h1 class='ccu_next_h1'>Click next to continue</h1><br/>"	
			
			$("div #heading").empty();
			$("div #heading").html("We found your account. Here are your recent orders<hr/>");
			heading+= '<button id="next" class="btn btn-primary" onclick="javascript:redirectNextPage_vv()" >Next</button>';
			
			
			document.getElementById("valid_data_vv").innerHTML = heading;
			
			
			} 
			else if(responseObject.order_status_id == 3 || responseObject.order_status_id == 7)
			{
			
				
			var href="",footer_message="";//initialization done to avoid showing Undefined variable in the popup--Vimal
			var status = "Shipped";
			
			//responseObject.tracking_number="145077876352368";
			
			if(responseObject.tracking_number)
			{
				
			var firstTwo=responseObject.tracking_number.substring(0,2);
			
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
				
			//---------USPS------------
			
			if(responseObject.tracking_number.length>=22 && responseObject.tracking_number.substring(0,1)=='9')
			{
				
				var href = "https://www.fedex.com/apps/fedextrack/?action=track&trackingnumber="+responseObject.tracking_number+"&cntry_code=us";
			
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
			
			

			heading="<div class='shipped_order'><div class='order_top'>Your order "+responseObject.order_number+" for "+responseObject.product+" placed on "+responseObject.order_create_date +", shows that it "+status+" on "+responseObject.shipped_date +".</div>";			
			heading += "<hr class='clearfix'><h1 class='ccu_next_h1'>Click next to continue</h1><br/>"	
			
			$("div #heading").empty();
			$("div #heading").html("We found your account. Here are your recent orders<hr/>");
			heading+= '<button id="next" class="btn btn-primary" onclick="javascript:redirectNextPage_vv()" >Next</button>';	 
			document.getElementById("valid_data_vv").innerHTML = heading;
			}
			
			else//order status is null 30-6-2017
			{
			
			
			heading="<div class='shipped_order'><div>Your recent order is under processing!!</div></div>";
			
			heading += "<hr class='clearfix'><h1 class='ccu_next_h1'>Click next to continue</h1><br/>"	
		
			$("div #heading").empty();
			$("div #heading").html("We found your account. Here are your recent orders<hr/>");
			heading+= '<button id="next" class="btn btn-primary" onclick="javascript:redirectNextPage_vv()" >Next</button>';	 
			document.getElementById("valid_data_vv").innerHTML = heading;	
			
			
			}
			
			
			
	},
	
	
	_onBeforeAjaxRequest: function(type, args)
		{
			
			console.log(args[0]);
			//alert(args[0].scope.instanceID);
			requestOptions = args[0];
			
			//added click tracking parameters along with this ajax call to make functioning click tracking and order search at a time
			//-------------------------------------------------------------
			
				var uri = window.location;
				var uri_enc = encodeURIComponent(uri);


				/*var interface=this.data.attrs.interface_type;
				var mob;
				mob="N";
				*/
				var mob = 1;
				if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					mob = 2;
				}
				
				
			 	
			//-------------------------------------------------------------
			
			
			if(requestOptions.url == "/ci/ajaxRequest/sendForm" && args[0].scope.instanceID == this.instanceID)
			{
				requestOptions.url = "/cc/AjaxCustom/submit_order_status_cc/"+uri_enc+"/" +mob;
			}
			
		},
		  _onErrorResponse: function() {
			   
			console.log("error");
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
	