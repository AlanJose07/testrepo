RightNow.namespace('Custom.Widgets.input.SelectGDPR');
Custom.Widgets.input.SelectGDPR = RightNow.Widgets.SelectionInput.extend({ 
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
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			if(fieldName == "Incident.CustomFields.c.member_type_new")
			{
				RightNow.Event.subscribe("evt_country_changed", this.ResetMemberType, this);
				this.input.on("change", this.member_type_changed, this);
			} else if(fieldName == "Incident.CustomFields.c.dsrm_right_type") {
				RightNow.Event.subscribe("evt_membertype_changed", this.fetch_mem_id, this);
				//RightNow.Event.subscribe("evt_country_changed", this.setCOuntryID, this);
				this.input.on("change", this.right_type_changed, this);
			} else if(fieldName == "Incident.CustomFields.c.dsrm_object_data") {
				RightNow.Event.subscribe("evt_membertype_changed", this.fetch_mem_id, this);
				RightNow.Event.subscribe("evt_righttype_changed", this.display_objectdata, this);
				//added by sriram for data object data starts
				
				RightNow.Event.subscribe("evt_country_changed", this.getCountryId, this);
				RightNow.Event.subscribe("evt_objection_changed", this.display_objection_data, this);
				//added by sriram for data object data ends
				
				this.input.on("change", this.object_my_data_changed, this);
			} else if(fieldName == "Contact.Address.Country") {
				this.input.on("change", this.Country_changed, this);
			}
			
        }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // swapLabel: function(container, requiredness, label, template)
        // constraintChange: function(evt, constraint)
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
        // onStatusChanged: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {
    	
    },
	setCOuntryID: function(type, args) {
		
		this.countryID = args[0].data.countryid;
		if((this.mem_id==389 ||this.mem_id==388)&& (this.countryID==7)){
			//alert("adding");
			
			//code to add right of deletion
			var x = this._inputField
			var c = document.createElement("option");
			c.text = "Right of Deletion";
			c.value= 1506;
			x.options.add(c, 4);
			
			
		}
		else{
			//code to remove right of deletion
				if(this.countryID==1 || this.countryID==2){
					//alert("testing removing")
					this._inputField.options.remove(4);
				}
			
			/*if(this.mem_id==389){
			this._inputField.options[1].setAttribute("title","Customer Right of Access/Portability");
			this._inputField.options[2].setAttribute("title","Customer Right of Correction");
			this._inputField.options[3].setAttribute("title","Customer Right of Objection/Restriction");
			}
			else if(this.mem_id==388){
				this._inputField.options[1].setAttribute("title","Coach Right of Access/Portability");
				this._inputField.options[2].setAttribute("title","Coach Right of Correction");
				this._inputField.options[3].setAttribute("title","Coach Right of Objection/Restriction");
			}*/
		}
		
		
		
    },
	getCountryId: function(type, args) {
		this.country_id = args[0].data.countryid;
		
	},
	ResetMemberType: function(type, args) {
		
		this.country_id = args[0].data.countryid;
		
		//alert(this.country_id);
		this._inputField.value="";
		
		if((this.country_id ==1) || (this.country_id ==2) || (this.country_id ==7) )
		{
			document.getElementById("CountryFields").style.display="block";
			document.getElementById("totalFields").style.display="none";
			document.getElementById("right_type_data").style.display="none";
			document.getElementById("my_object_data").style.display="none";
			//document.getElementById("update_object_data").style.display="none";
			document.getElementById("delete_object_data").style.display="none";
			
			
		}else{
		
			document.getElementById("CountryFields").style.display="none";
			document.getElementById("totalFields").style.display="none";
		}
    },
	
	 Country_changed: function(type, args) {
		var country_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		
		var eventObj = new RightNow.Event.EventObject(this, {data:  {countryid: country_id}});
		RightNow.Event.fire("evt_country_changed", eventObj);
		
		document.getElementById("update_object_data").style.display="none";
		document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
		document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";
		
    	
    },
		
    fetch_mem_id: function(type, args) {
    
    	this.mem_id = args[0].data.membertype;
    	document.getElementById("update_object_data").style.display="none";
    	//document.getElementById("other_object_data").style.display="none";
		document.getElementById("delete_object_data").style.display="none";
		document.getElementById("my_object_data").style.display="none";

    	this._inputField.value="";
    	//commeneted by sriram
		//document.getElementById("totalFields").style.display="block";
		//code to diaplay tool tip over menu items starts
		/*if(this.mem_id==389){
			this._inputField.options[1].setAttribute("title","Customer Right of Access/Portability");
			this._inputField.options[2].setAttribute("title","Customer Right of Correction");
			this._inputField.options[3].setAttribute("title","Customer Right of Objection/Restriction");
			this._inputField.options[4].setAttribute("title","Customer Right of Deletion");
		}
		else if(this.mem_id==388){
				
				this._inputField.options[1].setAttribute("title"," Coach Right of Access/Portability");
				this._inputField.options[2].setAttribute("title","Coach Right of Correction");
				this._inputField.options[3].setAttribute("title","Coach Right of Objection/Restriction");
				this._inputField.options[4].setAttribute("title","Coach Right of Deletion");
		}*/
		
		//code to diaplay tool tip over menu items ends
		

    },
    
    
    object_my_data_changed: function() {
    	//console.log(this.mem_id);
    	var object_data_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
    	document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;
		
		
    	if (this.mem_id == 389 || this.mem_id == 388) {
	    	if (object_data_id == 1526) {
	    		//document.getElementById("other_object_data").style.display="block";
	    		var eventObj = new RightNow.Event.EventObject(this, {data:{other_type_data:"1"}});
				RightNow.Event.fire("evt_othertype_changed", eventObj);

	    	} else {
	    	
	    	    //document.getElementById("other_object_data").style.display="none";
	    	    var eventObj = new RightNow.Event.EventObject(this, {data:{other_type_data: "2"}});
				RightNow.Event.fire("evt_othertype_changed", eventObj);

	    	}
    	} else {
    	 	//document.getElementById("other_object_data").style.display="none";
    	 	var eventObj = new RightNow.Event.EventObject(this, {data:{other_type_data: "2"}});
			RightNow.Event.fire("evt_othertype_changed", eventObj);

    	 }
    },
    
    
    display_objectdata: function(type, args) {
		
		//this.rightTypeId= args[0].data.rightType;
		//alert(args[0].data.rightType);
    	var right_type_id = args[0].data.rightType;  
    	this._inputField.value="";
    	//document.getElementById("other_object_data").style.display="none";
		//code to display tool tip starts
		
		
		
		
		
		if(this.mem_id==389  )
		{
			this._inputField.options[1].setAttribute("title","With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.");
			this._inputField.options[2].setAttribute("title","This selection will hide your contact information from your assigned Coach.");
			
		}
		else if(this.mem_id==388 )
		{
			this._inputField.options[1].setAttribute("title","With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.  You will still receive account related communications.");
			this._inputField.options[2].setAttribute("title","This selection will hide your contact information within the Coach Online Office from all Coaches, including your sponsor and personally sponsored Coaches.");
			
				
		}
		
		//code to display tool tip ends
		/*if (this.mem_id == 388) {
			if (right_type_id == 1521) {
				if(this._inputField.options[2].value == 1523){
					this._inputField.options.remove(2);
					this._inputField.options[1].setAttribute("title","With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.  You will still receive account related communications.");
					//this._inputField.options[2].setAttribute("title","This selection will hide your contact information within the Coach Online Office from all Coaches, including your sponsor and personally sponsored Coaches.");
					this._inputField.options[2].setAttribute("title","");
				}
			}
		}
		if (this.mem_id == 389) {
			if (right_type_id == 1521) {
				if(this._inputField.options[2].value != 1523){
					var ObjectTypeField = this._inputField
					var c = document.createElement("option");
					c.text = "Sharing Contact Info with Coaches";
					c.value= 1523;
					ObjectTypeField.options.add(c, 2);
				}
				
				this._inputField.options[1].setAttribute("title","With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.");
				this._inputField.options[2].setAttribute("title","This selection will hide your contact information from your assigned Coach.");
				this._inputField.options[3].setAttribute("title","");
			}
		}*/
		
    	if (this.mem_id == 389 || this.mem_id == 388) {
	    	if (right_type_id == 1521) {
	    		document.getElementById("my_object_data").style.display="block";
	    		
	    		var labelnew1 = document.getElementById("rn_" + this.instanceID + "_" + "Label");
				console.log(labelnew1);
				labelnew1.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
				this.data.attrs.required=true;

	    	} else {
	    	  	this.data.attrs.required=false;
	    	    document.getElementById("my_object_data").style.display="none";
	    	  
	    	}	

    	} else {
    	 	 
    		document.getElementById("my_object_data").style.display="none";
    	}
  	
    },
	
	display_objection_data: function(type, args) {
		var objection_id = args[0].data.customer_objection_data;
		var membId = args[0].data.mem_id;
		//alert("right_type_id"+objection_id);
		//alert("memid"+membId);
		//alert("country ID"+this.country_id);
		if(objection_id == 1521 && (membId ==388 || membId ==389) && (this.country_id ==1 ||this.country_id==2) )
		{
			
			this._inputField.options.remove(3);
		}else
		{
					
					var otherField = this._inputField
					var optionCreate = document.createElement("option");
					optionCreate.text = "Other";
					optionCreate.value= 1526;
					this._inputField.options.remove(3);
					otherField.options.add(optionCreate, 3);
					
		}
		
		
	},
    right_type_changed: function() {
    	var right_type_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
    	document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;
    	console.log(this.mem_id );
    	/*if (this.mem_id == 388) {
			
	    	if (right_type_id == 1349) {
	    		document.getElementById("delete_object_data").style.display="block";
	    		document.getElementById("totalFields").style.display="none";



	    		
	    	} else {
	    	    document.getElementById("delete_object_data").style.display="none";
	    	    document.getElementById("totalFields").style.display="block";



	    	}
    	} else {
    		document.getElementById("delete_object_data").style.display="none";
    		document.getElementById("totalFields").style.display="block";



    	}*/
		
		//sriram code starts
		//alert(this.mem_id);
		//alert(right_type_id);
		if (this.mem_id == 388) {
			
	    	if (right_type_id == 1506) {
	    		document.getElementById("delete_object_data").style.display="block";
	    		document.getElementById("totalFields").style.display="none";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";
				document.getElementById("disclaimer_box").style.display="none";



	    		
	    	} else if(right_type_id == 1505||right_type_id == 1507||right_type_id == 1521){
				
				if(right_type_id == 1521){
					//alert("test1");
					document.getElementById("my_object_data").style.display="block";
					//added by sriram for preventing other on dsrm object data code starts
		
					var eventObj2 = new RightNow.Event.EventObject(this, {data:{customer_objection_data: right_type_id,mem_id: this.mem_id}});
					//alert("print");
					//console.log(eventObj2);
					RightNow.Event.fire("evt_objection_changed", eventObj2);
					//added by sriram for preventing other on dsrm object data code ends
				}else{
				document.getElementById("my_object_data").style.display="none";
				}
	    	    document.getElementById("delete_object_data").style.display="none";
	    	    document.getElementById("totalFields").style.display="block";
				document.getElementById('coach_fields').style.display = "block";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";
				document.getElementById("disclaimer_box").style.display="none";



	    	}else{
				 document.getElementById("totalFields").style.display="none";
				 document.getElementById("disclaimer_box").style.display="none";
			}
    	}
		else if(this.mem_id == 389) {
			//for customer delete
			if(right_type_id == 1507){
				
				document.getElementById("update_object_data").style.display="block";
			}else{
				document.getElementById("update_object_data").style.display="none";
			}
			if(right_type_id == 1506){
				 document.getElementById("disclaimer_box").style.display="block";
				 var eventObj1 = new RightNow.Event.EventObject(this, {data:{customer_delete_data: "ok"}});
				 RightNow.Event.fire("evt_customerdelete_changed", eventObj1);


			}else{
				 document.getElementById("disclaimer_box").style.display="none";

			}
			//test
			if(right_type_id == 1521){
					//alert("test");
					document.getElementById("my_object_data").style.display="block";
					//added by sriram for preventing other on dsrm object data code starts
					var eventObj2 = new RightNow.Event.EventObject(this, {data:{customer_objection_data: right_type_id,mem_id: this.mem_id}});
					console.log(eventObj2);
					RightNow.Event.fire("evt_objection_changed", eventObj2);
					//added by sriram for preventing other on dsrm object data code ends
			}else{
				document.getElementById("my_object_data").style.display="none";
			}
			//added for customer/delete

    		if(right_type_id != 1505 && right_type_id != 1507 && right_type_id != 1521&& right_type_id != 1506){

	    	    document.getElementById("totalFields").style.display="none";
	    	    document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";

				
	    	} else{
				
				document.getElementById("totalFields").style.display="block";
				document.getElementById('customer_fields').style.display = "block";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";

			}
			

    	}else{
				document.getElementById("delete_object_data").style.display="none";
				document.getElementById("totalFields").style.display="none";
				document.getElementById("disclaimer_box").style.display="none";

		}
		//sriram code ends

    	var eventObj = new RightNow.Event.EventObject(this, {data:  {rightType: right_type_id}});
		RightNow.Event.fire("evt_righttype_changed", eventObj);

    },
	member_type_changed: function() {
		var mem_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;

		if(document.getElementById('coach_fields'))
		{
			document.getElementById('coach_fields').style.display = "none";
		}
		if(document.getElementById('customer_fields'))
		{
			document.getElementById('customer_fields').style.display = "none";
		}
		if(mem_id == 388)
		{
			/*if(document.getElementById('coach_fields'))
			{
				document.getElementById('coach_fields').style.display = "block";
			}*/
			
			

				document.getElementById('right_type_data').style.display = "block";	
				document.getElementById('totalFields').style.display = "none";	
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";
				document.getElementById("disclaimer_box").style.display= "none";
			
		}
		else if(mem_id == 389)
		{
			/*if(document.getElementById('customer_fields'))
			{
				document.getElementById('customer_fields').style.display = "block";
			}	*/
			
			document.getElementById('right_type_data').style.display = "block";	
			document.getElementById('totalFields').style.display = "none";				
			document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
			document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";
		}	
		else
		{
			document.getElementById('right_type_data').style.display = "none";	
			document.getElementById('totalFields').style.display = "none";
			document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
			document.getElementById("rn_ErrorLocation_gdpr").style.display= "none";

		}
		var eventObj = new RightNow.Event.EventObject(this, {data:  {membertype: mem_id}});
		RightNow.Event.fire("evt_membertype_changed", eventObj);
		
	}
});