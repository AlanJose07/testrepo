RightNow.namespace('Custom.Widgets.ResponsiveDesign.UpdateCreditCardFormSubmit');
var card;
var that;
Custom.Widgets.ResponsiveDesign.UpdateCreditCardFormSubmit = RightNow.Widgets.extend({ 
    /**
     * Widget constructor...
     */
    constructor: function() {
    
		that = this;
    	this.input = this.Y.one(this.baseSelector + "_Button");
    	this.input.on("click",this.validateFormData ,this);

    },

    /**
     * Sample widget method.
     */
     
     
    validateFormData : function(){
    
    	var errors =[];
		var fdata = {};
		var formdata = $("form").serializeArray();
		//console.log($("form").serializeArray());
		for (var i = 0; i < formdata.length; i++) {
		
			
			if(document.getElementById("firstName").style.display=="block"){
				
				if (formdata[i]["name"] == "Contact.Name.First") {
					firstName1 = formdata[i]["value"];
					
					if(firstName1 == ""){
					
						errors.push("Please enter a valid first name");
					
					}
				
				}
			
			}
			if(document.getElementById("lastName").style.display=="block"){
				
				if (formdata[i]["name"] == "Contact.Name.Last") {
					lastName1 = formdata[i]["value"];
					
					if(lastName1 == ""){
					
						errors.push("Please enter a valid last name");
					
					}
				
				}
			
			}

			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.full_name") {
				fullname = formdata[i]["value"];
				
				if(fullname== ""){
				
					errors.push("Please enter Name on the card");
				
				}
				
			}
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.credit_card_number") {
				creditcardnumber = formdata[i]["value"];
				
				if(creditcardnumber == ""){
				
					errors.push("Please enter a valid Credit card number");
				
				}else{
					var length= creditcardnumber.length;
					//alert(length);
					
					var number1 = parseInt(creditcardnumber);
					//alert(number1);
					//alert(!isNaN(number1));
					if(!isNaN(creditcardnumber)){
						
						
					
						if(length > 16 || length < 15){
							errors.push("Please enter a valid 15 or 16 digits Credit card number");

						
						}
					
					
					} else{
						errors.push("Please enter a valid Credit card number");
					
					}
				
				}
				
				
			}
			/*if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.security_code") {
				securityCode = formdata[i]["value"];
				
				if(securityCode == ""){
				
					errors.push("please enter a valid security code");
				
				}
				
			}*/
			
			/*if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.security_code") {
				securityCode = formdata[i]["value"];
				if(securityCode  == ""){
					errors.push("Please enter a valid CVV / CSC  ");
				
				}else{
					var length= securityCode.length;
					//alert(length);
					
					//var number1 = parseInt(creditcardnumber);
					//alert(number1);
					//alert(!isNaN(securityCode));
					if(!isNaN(securityCode)){
											
						if(length > 4 || length <3){
							errors.push("Please enter a valid CVV / CSC");

						}
					} else{
						errors.push("Please enter a valid CVV / CSC");
					
					}
				
				}
				
				
			}*/
			
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.credit_card_type") {
				cardType = formdata[i]["value"];
				
				if(cardType == ""){
				
					errors.push("Please select Credit Card Type");
				
				}
				
			}
			
			
			
			/*--------------------------------*/
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.exp_month") {
				expMonth = formdata[i]["value"];
				console.log(expMonth);
				if(expMonth == ""){
				
					errors.push("Please select expiration month");
				
				}
				
			}
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.exp_year") {
				expYear = formdata[i]["value"];
				
				if(expYear == ""){
				
					errors.push("Please select expiration Year");
				
				}
				
			}
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.bill_to_address") {
				aptSuite = formdata[i]["value"];
				
				if(aptSuite == ""){
				
					errors.push("Please enter Address Line1");
				
				}
				
			}
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.bill_to_city") {
				City = formdata[i]["value"];
				
				if(City == ""){
				
					errors.push("Please enter the City/Town");
				
				}
				
			}
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.bill_to_postal_code") {
				postalcode = formdata[i]["value"];
				
				if(postalcode == ""){
				
					errors.push("Please enter the Zip / Post / Postal Code");
				
				}
				
			}
			
			if (formdata[i]["name"] == "Contact.Address.StateOrProvince") {
				state = formdata[i]["value"];
				
				if(state == ""){
				
					errors.push("Please select the State / Province");
				
				}
				
			}
			if (formdata[i]["name"] == "Contact.Address.Country") {
				state = formdata[i]["value"];
				
				if(state == ""){
				
					errors.push("Please select the Country");
				
				}
				
			}







		}
		//console.log(errors);
		if(errors.length>0){
			var appendedString = "";
			for(i=0; i< errors.length; i++){
				appendedString = appendedString + errors[i]+"<br/>";
				
			}
			$("div #rn_ErrorLocation_vv").show();
			$("div #rn_ErrorLocation_vv").html(appendedString);
			
			$('#myModal_ccu').animate({ scrollTop: 0 }, 'slow');
		
		}else{
			document.getElementById("LoadingIconMain").setAttribute("class", "");
			document.getElementById("rn_"+this.instanceID+ "_Button").setAttribute("disabled", "true");
		
			this.postCreditInfo();
			
			
	
	//tracking the click of submit button	
	
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
		  var mob = "N";
		  var clickType="submit";
		  
		  
			xmlhttp.open("GET","/cc/AjaxCustom/track_credit_card_update_clicks/"+uri_enc+'/'+mob+'/'+clickType,true);
			xmlhttp.send();
				
			//----------------click track end-------	
			
		}

		
		
			
		
		
    
    },
    
    postCreditInfo: function() {
    	console.log($("form").serializeArray());
		var fdata = {};
		var formdata = $("form").serializeArray();
		for (var i = 0; i < formdata.length; i++) {
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.credit_card_number") {
				card = formdata[i]["value"];
			}
		}
		
		$.ajax({type: "POST", url: "https://beachbody.cardconnect.com:8443/cardsecure/cs",data:{action:'CE',data:card},scope: this,json: false,success: this.getToken});
		/*for (var i = 0; i < formdata.length; i++) {
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.credit_card_number") {
				formdata[i]["value"] = card ;
			}
		}

  		fdata["form"] = JSON.stringify(formdata);
  		fdata["f_tok"] = this.data.js.f_tok;
  		console.log(formdata);

 	 	$.ajax({
	            url:"/cc/CreditCardUpdate/UpdateCard",
	            data:fdata, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
	        	console.log(response);
				var eventObject = new RightNow.Event.EventObject(this, {data: {
					//selectedvalue: this.input.get('value') + strUser
					msg: response.result.msg

				}});
				RightNow.Event.fire("onResponse",eventObject);
	          }).error(function(response) {
	            alert("got error");
	           
       	 });*/
		
    },
	getToken: function(obj) {
		console.log(obj.substring(15));
		var formdata = $("form").serializeArray();
		card = obj.substr(15);
		for (var i = 0; i < formdata.length; i++) {
			if (formdata[i]["name"] == "Update_Acnt.Update_Account_Info.credit_card_number") {
				formdata[i]["value"] = card ;
			}
		}
		
		
		var fdata = {};
  		fdata["form"] = JSON.stringify(formdata);
  		fdata["f_tok"] = that.data.js.f_tok;
  		console.log(formdata);

 	 	$.ajax({
	            url:"/cc/CreditCardUpdate/UpdateCard",
	            data:fdata, 
	            type:'POST',
	            dataType:'json'
	        }).done(function(response) {
	        	console.log(response);
				var eventObject = new RightNow.Event.EventObject(this, {data: {
					//selectedvalue: this.input.get('value') + strUser
					msg: response.result.msg

				}});
												
	
				document.getElementById('closeButton').style.display = "block";
				RightNow.Event.fire("onResponse",eventObject);//subscribed in ResponsiveDesign/ProductTile			
	          });
			  /*.error(function(response) {
	            alert("got error");
	           
       	 }); */
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