RightNow.namespace('Custom.Widgets.input.SelectionInput_CCF_life_time_rank');
Custom.Widgets.input.SelectionInput_CCF_life_time_rank = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
			this.instanceID = instanceID;
			this.data = data;
            this.parent();
			//document.getElementById("rn_" + this.instanceID + "_LabelContainer").style.display = "none";
			document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).className+=" mat-input";
			document.getElementById("rn_" + this.instanceID).className+=" mat-div"; 
   			 var fieldName = data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			this.clearOnLoad();
			
			if((fieldName == "Incident.CustomFields.c.life_time_rank")||(fieldName == "Incident.CustomFields.c.success_club_points_qualify")||(fieldName == "Incident.CustomFields.c.month_affected")||(fieldName == "Incident.CustomFields.c.coach_region")||(fieldName=="Incident.CustomFields.c.coach_enrollments")||(fieldName == "Incident.CustomFields.c.business_entity_type")||(fieldName == "Incident.CustomFields.c.reissue_reason")||(fieldName == "Incident.CustomFields.c.payout_method")||(fieldName == "Incident.CustomFields.c.cancel_reason"))
			{
				document.getElementById("rn_" + this.instanceID).className+=" downarrow"; 
			}
			/*else
			{
				document.getElementById("rn_" + this.instanceID).classList.remove("downarrow");
			}*/
			if(fieldName == "Incident.CustomFields.c.life_time_rank")
				{
					//this.checkURLForMem();
					document.getElementById("rn_" + this.instanceID).className+=" downarrow"; 
					this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
					this.input.on("change", this.rank_changed, this);
					
					 RightNow.Event.subscribe("evt_life_rank_attribute", this.set_attribute, this);
					RightNow.Event.subscribe("evt_attr_life_chat", this.set_attribute, this);
					
					
					//RightNow.Event.subscribe("evt_customer_req_change", this.coach_req, this);//make req=false when order status is selected
					
					
					RightNow.Event.subscribe("evt_customer_request_changed", this.coach_req, this);
					
					RightNow.Event.subscribe("evt_customer_changed", this.makeRequiredFalse, this);
					
					//for setting required fields
					//fired from Recommended channels click and SelectionInputCustomerTypeContactUs widget  
					
					
					
					
					RightNow.Event.subscribe("evt_set_required_fields", this.setRequiredFields, this);
					
					//RightNow.Event.subscribe("evt_clear_life_time_rank", this.clear_lifetime_rank, this);
					
					RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
					
					RightNow.Event.subscribe("evt_set_life_time_rank", this.setValue, this);
					
					
					//alert(this.value);
					//alert(this.input.value);
					//document.getElementById("rn_" + this.instanceID).className+=" is-completed";
					 

					
				}
				
				if(fieldName == "Incident.CustomFields.c.success_club_points_qualify")
				{
					this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
					//this.input.on("change", this.rank_changed, this);
					RightNow.Event.subscribe("evt_life_rank_attribute", this.set_attribute_success, this);
					RightNow.Event.subscribe("evt_life_rank_attribute", this.hide_region, this);
					RightNow.Event.subscribe("evt_coach_enrollment_attribute", this.success_club_attribute, this);
					
					RightNow.Event.subscribe("evt_set_required_fields_success_club", this.setRequiredFields_success_club, this);
					RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
					

				}
				
					else if(fieldName == "Incident.CustomFields.c.month_affected")
					{
						this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
						RightNow.Event.subscribe("evt_coach_enrollment_attribute", this.month_affected, this);
						RightNow.Event.subscribe("evt_life_rank_attribute", this.set_attribute_success, this);
					
					   RightNow.Event.subscribe("evt_set_required_fields_month_affected", this.setRequiredFields_month_affected, this);
					   RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
					}
				
					else if(fieldName == "Incident.CustomFields.c.coach_region")
					{
					//alert("Region");
						this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
						RightNow.Event.subscribe("evt_region_attribute", this.set_attribute_region, this);
						RightNow.Event.subscribe("evt_life_rank_attribute", this.hide_region, this);
						
						RightNow.Event.subscribe("evt_set_required_fields_region", this.setRequiredFields_region, this);
						
						RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
						
						RightNow.Event.subscribe("evt_remove_Region_required", this.removeRegionRequired, this);
					}
					else if(fieldName=="Incident.CustomFields.c.coach_enrollments")
					{
						this.input.on("change", this.businessEntity, this);
						RightNow.Event.subscribe("evt_make_comm_req", this.set_attribute_coach_enrollment, this); //evt_coach_enrollment_attribute
						
						/*--code by anoop to set null value for 'coach enrollments' field-*/
						RightNow.Event.subscribe("evt_life_rank_attribute", this.set_enroolment, this);
							/*-----------------------code by Anoop end-----------------------*/
							
						RightNow.Event.subscribe("evt_set_required_fields_coach_enrolment", this.setRequiredFields_coachenrolments, this);	
							
						RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);	
					}
					
					else if(fieldName == "Incident.CustomFields.c.business_entity_type")
					{
						this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
						RightNow.Event.subscribe("evt_business_entity_attribute", this.set_attribute_business_entity, this);
						
						RightNow.Event.subscribe("evt_set_required_fields_business_entity", this.setRequiredFields_business_entity, this);
						
						RightNow.Event.subscribe("evt_life_rank_attribute", this.hide_region, this);
						RightNow.Event.subscribe("evt_coach_enrollment_attribute", this.hide_attr, this);
						
											
						RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
						
					} 
			else if(fieldName == "Incident.CustomFields.c.reissue_reason")
				{
						this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
				
						RightNow.Event.subscribe("evt_make_comm_req", this.reissue_reason_set_attribute, this);
						RightNow.Event.subscribe("evt_life_rank_attribute", this.hide_region, this);
					RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
				}
			else if(fieldName == "Incident.CustomFields.c.payout_method")
				{
						this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
				
						RightNow.Event.subscribe("evt_coach_enrollment_attribute", this.payout_method_set_attribute, this);
						RightNow.Event.subscribe("evt_life_rank_attribute", this.hide_region, this);
						RightNow.Event.subscribe("evt_set_required_fields_pay_method", this.setRequiredFields_pay_method, this);
						RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
						
					
				}
				else if(fieldName == "Incident.CustomFields.c.language_shk")
				{
				console.log(this.baseDomID+"_"+this._fieldName);
				//alert("Lan");
				document.getElementById("rn_" + this.instanceID).className+=" downarrow"; 
				document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 
				RightNow.Event.subscribe("evt_set_required_fields_language", this.setRequiredFields_language, this);
				RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
				
							
				this.input.on("change", this.language_changed, this);
				
				
				}
				else if(fieldName == "Incident.CustomFields.c.cancel_reason")
				{
					RightNow.Event.subscribe("evt_set_required_fields_cancelreq", this.setBillingRequired, this);
					RightNow.Event.subscribe("evt_remove_error_class", this.removeErrorClass, this);
				}
        } 

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },
	
	
    	setValue: function(type, args) {
			var rank = [];
			//this.input.focus();
						
			document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).focus();
			document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled = false;
			if (args[0].data.hasOwnProperty("rank")) {
				if (args[0].data.rank.length > 0) {
					rank = args[0].data.rank.split(" ");
					document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled = true;
				} else {
					document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).value="";

					document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled = false;
				}
			} else {
				document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).value="";
				document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).disabled = false;
			}
			if (rank.length > 0) {
				if (rank[0] == "One" || rank[0] == "Two" || rank[0] == "Three" || rank[0] == "Four") {
					document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).value = 478;
					//this.input.set("value",478);
					//this.input.set("readonly",);
				} else {

					document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name).value = 492;
					//this.input.set("value",492);
				}
			} else {
					
			}
			
			document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 

			
		},

    /**
     * Sample widget method.
     */
    methodName: function() {
		
		
		

    },
	
	removeRegionRequired: function(type, args)
	{
		this.data.attrs.required=false;
	},
	
	removeErrorClass: function(type, args)
	{
		
		//$("#rn_" + this.instanceID + '_'+this.data.js.name).removeClass("rn_ErrorField");
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		errorWidget.classList.remove("rn_ErrorField");
		if(this.data.js.name == "Incident.CustomFields.c.cancel_reason")
		{
			this.input.set('value','');	
			document.getElementById("rn_" + this.instanceID).classList.remove("is-completed");
		}
		
	},
	
	
	setRequiredFields_business_entity: function(type, args)
	{
	
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		var enroll_value = document.getElementsByName("Incident.CustomFields.c.coach_enrollments")[0].value;
		
		
		
		if( (memberId == 388) && (reqId == 304)   )//Coach Enrollments
		{
			if((enroll_value==501) && (formId==0))
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Business Entity "+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			}
			else
			{
			    var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Business Entity ";
				this.data.attrs.required=false;
			}
		
		}
		else
		{
			this.input.set('value','');
			this.data.attrs.required=false;
		}
		
			
	
	},
	
	//================set required fields=========================
	setRequiredFields_success_club: function(type, args)
	{
		
		//alert("Success club");
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		
			
		if( (memberId == 388) && (reqId == 532)   )//Success Club (Points & Qualification)
		{
			
			
			if(formId==1)//chat
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Success Club (Points & Qualification)  ";
				this.data.attrs.required=false;
			}
			if(formId==0)//email
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Success Club (Points & Qualification)  "+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			
			}
		}
		else
		{
			
			this.input.set('value','');
			this.data.attrs.required=false;
		}
		
	},
	
	//================set required fields=========================

	
	setRequiredFields_pay_method: function(type, args)
	{
		
	//	alert("In pay method");
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		
			
		if((memberId == 388)&&(formId==0)&&(reqId == 196))//Coach
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Payout Method  "+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else
		{
			
			//this.input.set('value','');
			//this.data.attrs.required=false;
			
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Payout Method  ";
			this.data.attrs.required=false;
		}
		
	},
	
	//================set required fields=========================
	setRequiredFields: function(type, args)
	{
		
		//alert("In FunctionLifetimeRank");
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		
			
		if(memberId == 388)//Coach
		{
			
			
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Lifetime Rank  "+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
			
		}
		else
		{
			
			this.input.set('value','');
			this.data.attrs.required=false;
		}
		
	},
	
	//================set required fields=========================
	
	
	
	//================set required fields=========================
	setRequiredFields_language: function(type, args)
	{
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var langDisplay=args[0].data.langDisplay;
		//var formId=args[0].data.pageType;
		 
		// alert("langDisplay--"+langDisplay);
		 	
		//if(  (( (memberId == 388) ||  (memberId == 398) ) &&  (formId==0 ) ) )//Coach and BB
		
		//if(  ( (memberId == 388) ||  (memberId == 398) || (memberId == 389) ) && (langDisplay==1)  )//changed on 7-11-2017
		
		
		var lifeTimeRank=document.getElementsByName("Incident.CustomFields.c.life_time_rank")[0].value;
		
		//lang required only for customer and coach with 4 star
		if(  ((memberId == 388)&&(lifeTimeRank!=492))   || (memberId == 389)  )
		{
			
			var langVal=document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).value;
			
			if(langVal=="")
			{ 
				this.input.set('value','1182');
			}
			
			document.getElementById("rn_" + this.instanceID).className+=" downarrow"; 
			document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 
			
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Preferred Response Language  "+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
			
		}
		else
		{
			//this.input.set('value','');
			this.data.attrs.required=false;
		}
		
	},
	 
	
	
	setRequiredFields_region: function(type, args) {
	
		var value = args[0].data;
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		
		
		if((memberId == 388)&&(formId==0))
		{
		
			this.data.attrs.required=false;
			
		}
		if((memberId == 388)&&(formId==1))
		{
		
		var lifeTimeRank=document.getElementsByName("Incident.CustomFields.c.life_time_rank")[0].value;
		
		
	
		if(lifeTimeRank==492)
		{
		
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Region"+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else
		{ 
			//var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			//labelnew.innerHTML="Region"+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=false;
		}
			
		}

		},
	
	
	setRequiredFields_month_affected: function(type, args) {
	//alert("In month affected");	
		var value = args[0].data;
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		if((memberId == 388)&&(formId==0)&&(reqId == 532))//Success Club (Points & Qualification)
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Month Affected"+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}

		else
		{
			//this.input.set('value','');
			//this.data.attrs.required=false;
			
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML="Month Affected";
			this.data.attrs.required=false;
		}



    },
	
	
	
	month_affected: function(type, args) {
		
		var value = args[0].data;
		if(value == 532)//Success Club (Points & Qualification)
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Month Affected"+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			}
			
			else
			{
			this.input.set('value','');
			this.data.attrs.required=false;
			}



    },
	
	 success_club_attribute: function(type, args) {
		 var value = args[0].data;
		 if(value==532)//Success Club (Points & Qualification)
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Success Club (Points & Qualification)"+"<span class='rn_Required'> *</span>";
				
				//this.input.set('value','');
				this.data.attrs.required=true;
			}
			
			else
			{
			this.input.set('value','');
			this.data.attrs.required=false;
			
			
			
			}


    },
	
	hide_attr: function(type, args) {
		
		var value = args[0].data;
				if(value!=304)//Coach Enrollments
			{
				this.input.set('value','');
				this.data.attrs.required=false;
			}

    },
	
	hide_region: function(type, args) {
		
		var value=args[0].data;
		
		
		if(value!=388)//Coach
			{
				
				if(document.getElementById("region"))
				{
				document.getElementById("region").style.display = "none";
				}
				if(document.getElementById("coach_enrollments"))
				{
				document.getElementById("coach_enrollments").style.display = "none";
				}
				if(document.getElementById("business_entity"))
				{
				document.getElementById("business_entity").style.display = "none";
				}
				if(document.getElementById("commission_inq"))
				{
				document.getElementById("commission_inq").style.display = "none";
				}
				if(document.getElementById("status_or_rank_inquiry"))
				{
		   		document.getElementById("status_or_rank_inquiry").style.display = "none";
				}
				this.input.set('value','');
				this.data.attrs.required=false;
				
				
			
			}
		//else 
			//{
				
			//}
			
		

    },
	setRequiredFields_coachenrolments: function(type, args)
	{
		
		//alert("In FunctionLifetimeRank");
		
		var memberId=args[0].data.member_id;
		var reqId=args[0].data.request_id;
		var formId=args[0].data.pageType;
		
		
			
		if(memberId == 388)//Coach
		{
			
			if(reqId==304)
			{
				if(formId==1)//chat
				{
					var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
					labelnew.innerHTML="Coach Enrollments  ";
					this.data.attrs.required=false;
				}
				if(formId==0)//email
				{
					var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
					labelnew.innerHTML="Coach Enrollments  "+"<span class='rn_Required'> *</span>";
					this.data.attrs.required=true;
				
				}
			}
		}
		else
		{
			
			this.input.set('value','');
			this.data.attrs.required=false;
		}
		
	},
	set_enroolment: function(type, args) {
	
	var value=args[0].data;
	
	
	
		if(value!=388)//Coach
			{
				
				if(document.getElementById("region"))
				{
				document.getElementById("region").style.display = "none";
				}
				if(document.getElementById("coach_enrollments"))
				{
				document.getElementById("coach_enrollments").style.display = "none";
				}
				if(document.getElementById("business_entity"))
				{
				document.getElementById("business_entity").style.display = "none";
				}
				if(document.getElementById("tech_support"))
					{
					document.getElementById("tech_support").style.display = "none";
					}
					if(document.getElementById("commission_inq"))
					{
					 document.getElementById("commission_inq").style.display = "none";
					}
					if(document.getElementById("status_or_rank_inquiry"))
					{
		 			 document.getElementById("status_or_rank_inquiry").style.display = "none";
					}
					if(document.getElementById("order_number_affected"))
					{
		   			 document.getElementById("order_number_affected").style.display = "none";
					}
				this.input.set('value','');
				this.data.attrs.required=false;
				
				
				
			}
	

    },
	set_attribute_coach_enrollment: function(type, args) {
	
	var req_type=args[0].data;
	
		if(req_type==304)//Coach Enrollments
				{
					var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
					labelnew.innerHTML="Coach Enrollments "+"<span class='rn_Required'> *</span>";
					this.data.attrs.required=true;
				}
				
				else 
				{
					this.input.set('value','');
					
					this.data.attrs.required=false;
				}
			 
	
	

    },
set_attribute_business_entity: function(type, args) {
		
	var coach_enroll=args[0].data;
	
	var pageType="";
	if(document.getElementById("form_type"))
	{
		pageType= document.getElementById("form_type").value;
		
	}
	
	
		if( (coach_enroll==501) && (pageType==0) )//Business Entity
		{
			
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Business Entity "+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
		}
		else 
			{
				this.input.set('value','');
				
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Business Entity ";
				
				this.data.attrs.required=false;
			}
			

    },
	
	   set_attribute_region: function(type, args) {
		   
		   var value=args[0].data;
			var frmValue=3;
		
			if(document.getElementById("form_type")){
				 frmValue=document.getElementById("form_type").value;
			}
			
			//alert("frmValue"+frmValue);
		
		    if((value == 492) && (frmValue==1) ) //5 star Diamond-15 star Diamond
			{ 
			
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Region "+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			
			}
			else
			    {
					this.input.set('value','');
			        this.data.attrs.required=false;
			
			    }
				
		   

    },


businessEntity: function()
{
	
	this.Value = this._inputField.options[this._inputField.selectedIndex].text;
	//**Code for getting id of the selected text of dropdown**//
    var length = this.input._node.length;

 for(var i=0;i<length;i++)
 {
  var text=this.input._node[i].label;
  if(this.Value == text)
  {
  var id = this.input._node[i].value; 
 // var numberPattern = /\d+/g;

       // var temp = id.match( numberPattern );
   
  }
 }
 
 //**code ends here**//
	
	var coach_enrollment_id=id;
	
	/*-----------------------code by Anoop start-----------------------*/
	var eventObject = new RightNow.Event.EventObject(this, {data:  coach_enrollment_id});
	/*-----------------------code by Anoop end-----------------------*/
	
	if(coach_enrollment_id == 501)//Business Entity
	{
		document.getElementById("business_entity").style.display = "block";
		/*-----------------------code by Anoop start-----------------------*/
		RightNow.Event.fire("evt_business_entity_attribute", eventObject);
		
		
		/*-----------------------code by Anoop end-----------------------*/
	}
	else
	{
		//this.data.attrs.required = false;
		document.getElementById("business_entity").style.display = "none";
		/*-----------------------code by Anoop start-----------------------*/
		RightNow.Event.fire("evt_business_entity_attribute", eventObject);
		
		/*-----------------------code by Anoop end-----------------------*/
	}
	
	
	
},
	set_attribute: function(type, args) {
		  //alert("rm set_attr");
		var coach_id= document.getElementsByName("Incident.CustomFields.c.member_type_new")[0].value;//old
		     
		//var coach_id = parseInt(document.querySelector('input[name="member_type"]:checked').value);
		var req=args[0].data;
		if(coach_id==388)//Coach
		{
			if(req==188)
			{
				this.data.attrs.required=false;
			}
			else
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
				labelnew.innerHTML="Lifetime Rank "+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			}
		}
		else 
		{
			this.input.set('value','');
			
			this.data.attrs.required=false;
		}
		  
		 
		 

    },
	
	
	set_attribute_success: function(type, args) {
		  
		
		  
		var value=args[0].data;
	
	
		if(value!=388)//Coach
		{
			
			this.data.attrs.required=false;
			this.input.set('value','');
			document.getElementById("success").style.display = "none";
		}
		else 
		{
		
		}
		  
		 

    },
	
	language_changed: function() {
	
	var eo_spanish = "";
	RightNow.Event.fire("evt_language_changed", eo_spanish);//subscribed in SelectionInputCustomertypeContactUs
	
	},
	
	
	 rank_changed: function() {
		var pg_url = String(window.location.href);
		var pos = pg_url.search("coach_cancellation_form");
		//alert(pos);
		if(pos == -1)
		{
			 this.Value = this._inputField.options[this._inputField.selectedIndex].text;
    var length = this.input._node.length;

	 for(var i=0;i<length;i++)
	 {
			var text=this.input._node[i].label;
		  if(this.Value == text)
		  {
			var id = this.input._node[i].value; 
		  }
	 }
	 
	 var eo = new RightNow.Event.EventObject(this, {data:  id});
	 RightNow.Event.fire("evt_region_attribute2", eo);
	 
	 var mem_id = 389;
	 if(document.querySelector('input[name="member_type"]:checked').value)
	 {
		mem_id = parseInt(document.querySelector('input[name="member_type"]:checked').value);
	 }
	 var req_id = 1;
	 if(document.getElementsByName("Incident.CustomFields.c.coach_request_type"))
	 {
		req_id = parseInt(document.getElementsByName("Incident.CustomFields.c.coach_request_type")[0].value);
	 }
	 var lang_id = 1;
	 if(document.getElementsByName("Incident.CustomFields.c.language_shk"))
	 {
		lang_id = parseInt(document.getElementsByName("Incident.CustomFields.c.language_shk")[0].value);
	 }
	 
	 
	 var eo_lang = new RightNow.Event.EventObject(this, {data:  {member_id:mem_id, request_id:req_id, langDisplay:lang_id}});
	 RightNow.Event.fire("evt_set_required_fields_language", eo_lang);
	 
	 var life_time_rank_id = id;
	 var frmValue=3;
		
		if(document.getElementById("form_type")){
			 frmValue=document.getElementById("form_type").value;
		}
		
		
		 
		 if(document.getElementById("region"))
		{
			document.getElementById("region").style.display = "block";
		}
		 
		 
		 if(  (life_time_rank_id == 492)  && (frmValue==1) )//5 star diamond-15 star Diamond show only in chat page
		 	{
				
				
				if(document.getElementById("msg_spanish_chat_notavailable"))
				{
					document.getElementById("msg_spanish_chat_notavailable").style.display = "none";
				}
				if(document.getElementById("msg_spanish_lang_off"))
				{
					document.getElementById("msg_spanish_lang_off").style.display = "none";
				}
				
								
				RightNow.Event.fire("evt_region_attribute", eo);//subscribed in SelectionInputCustomertypeContactUs
			}
			
			else if ((life_time_rank_id == 492)  && (frmValue==0))
			{
			
			if(document.getElementById("language"))
				{
					document.getElementById("language").style.display = "none";
				}
			
			}
			
			else if ((life_time_rank_id == 478)  && (frmValue==0))
			{
				
				if(document.getElementById("language"))
				{
					document.getElementById("language").style.display = "block";
				}
			}

			
			
			else 
			    {
					if(document.getElementById("region"))
					{
						document.getElementById("region").style.display = "none";
					}
						RightNow.Event.fire("evt_region_attribute",eo);
					
			    }
		}

    },
	reissue_reason_set_attribute: function(type, args) {
		var value = args[0].data;
	
		if(value==196)//Commission Inquiry
			{
			
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Reason"+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			}
			
			else
			{
			this.input.set('value','');
			this.data.attrs.required=false;
			}



    },
	
   payout_method_set_attribute: function(type, args) {
		
		var value = args[0].data;
		if(document.getElementById('form_type')) {
		var form_type = document.getElementById('form_type').value;
		}
		if((value==196)&&(form_type == 0))//Commission Inquiry
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML="Payout Method"+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
			}
			
			else
			{
			this.input.set('value','');
			this.data.attrs.required=false;
			}



    },
	
	coach_req: function(type, args) {
	
		var coach_req_id=args[0].data;
		var mem=document.getElementsByName("Incident.CustomFields.c.member_type_new")[0].value;//old
		//var mem = parseInt(document.querySelector('input[name="member_type"]:checked').value);
		
		if(mem==388)
		{
			if(coach_req_id==407)
			{
				this.data.attrs.required=false;
			}
			else
			{
				//alert(123);
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
				labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;
				//alert(456);
			}
		}
		else
		{
			this.data.attrs.required=false;	
			this.input.set("value","");
		}
    }, 
	
	
	clear_lifetime_rank : function() {
		//alert("clear life time");
		this.input.set('value','');
		this.Value = this._inputField.options[this._inputField.selectedIndex].text;
		//**Code for getting id of the selected text of dropdown**//
		var length = this.input._node.length;
		
		for(var i=0;i<length;i++)
		{
			var text=this.input._node[i].label;
			if(this.Value == text)
			{
				var id = this.input._node[i].value; 
			
			}
		}
		var eo = new RightNow.Event.EventObject(this, {data:  id});
		//RightNow.Event.fire("evt_region_attribute2", eo);
		var life_time_rank_id = id;
		
		if(life_time_rank_id == 492 )//5 star diamond-15 star Diamond
		{ 
			if(document.getElementById("region"))
			{
			document.getElementById("region").style.display = "block";
			}
			RightNow.Event.fire("evt_region_attribute", eo);
		}
		else
		{
			if(document.getElementById("region"))
			{
			document.getElementById("region").style.display = "none";
			}
			RightNow.Event.fire("evt_region_attribute",eo);
		}
				

    	
	},
	
	makeRequired: function(){
	
	
		var url=String(window.location);
		var exploded_url= url.split("/");
		var index=exploded_url.indexOf("tech");
		var tech = exploded_url[index+1];
		
		var index_mem=exploded_url.indexOf("lob");
		if(index_mem!=-1)
		{
			var mem_type = exploded_url[index_mem+2];
			if(mem_type==3)//checks if 1 is appended to the url
			{
				var mem=1;
			}
		}
		if((tech==1)||(mem==1))//checks if 1 is appended to the url
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else
		{
			this.data.attrs.required=false;
		}
	},
	
	makeRequiredFalse: function(type,args){

		this.data.attrs.required=false;	
		this.input.set("value","");
	},
clearOnLoad: function () {
		this.input.set('value','');
	},
	checkURLForMem: function()
	{
		if(document.getElementById("mem_id"))
		{
		var mid = parseInt(document.getElementById("mem_id").value);
		}
		if(mid == 388)//coach
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML=this.data.attrs.label_input+" <span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else
		{
			this.input.set('value','');				
			this.data.attrs.required=false;	
		}
	},
	setBillingRequired: function(type, args)
	{
		var mem_id = args[0].data.member_id;
		var req_id = args[0].data.request_id;
		var form_id = args[0].data.pageType;
		if(((req_id == "403")||(req_id == "202"))&&(form_id == 1))
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "LabelNew");
			labelnew.innerHTML=this.data.attrs.label_input+" <span class='rn_Required'> *</span>";
			this.data.attrs.required=true;
		}
		else     
		{
			this.input.set('value','');				
			this.data.attrs.required=false;	
		}
	}
	
	
	
});