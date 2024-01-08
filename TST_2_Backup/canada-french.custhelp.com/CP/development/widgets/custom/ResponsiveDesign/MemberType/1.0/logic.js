RightNow.namespace('Custom.Widgets.ResponsiveDesign.MemberType');
Custom.Widgets.ResponsiveDesign.MemberType = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			document.getElementById("rn_" + this.instanceID + "_LabelContainer").style.display = "none";
			document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).className+=" mat-input";
			document.getElementById("rn_" + this.instanceID).className+=" mat-div";
			
			
			this.instanceID=instanceID;
			this.fieldName = this.data.js.name;
			this._inputField = document.getElementById("rn_"+this.instanceID+"_"+this.fieldName);
			
			if(this.fieldName == "Incident.CustomFields.c.member_type_new")
			{
				//[below] as per client requirement changed the -- line to 'No Value'
				var get_first_element = document.getElementById("rn_"+this.instanceID+"_"+this.fieldName);
				get_first_element.options[0].text=" ";
				//[above] as per client requirement changed the -- line to 'No Value'
				
				RightNow.Event.subscribe("reset", this._reset, this);
				RightNow.Event.subscribe("chat_fields_required", this.membertype_required_based_channel, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories", this.membertype_required_based_channel, this);
				RightNow.Event.subscribe("email_fields_not_required", this.membertype_required_based_channel, this);
				RightNow.Event.subscribe("email_fields_not_required_special_categories", this.membertype_required_based_channel, this);
				RightNow.Event.subscribe("facebook_fields_required", this.membertype_required_based_channel, this);
				this.input.on("change", this.member_type_changed,this);

				document.getElementById("rn_" + this.instanceID).className+=" is-completed";
			}
			
				var url=String(window.location);  
				var exploded_url= url.split("/");
				var index=exploded_url.indexOf("prechatsurvey");
				var fbindex = exploded_url.indexOf("facebooksurvey");
				if(index!=-1)
					this.membertype_required_based_channel();
				if(fbindex!=-1)
					this.membertype_required_based_channel();
			
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
	member_type_changed: function(type, args)
	{
		var member_id = new RightNow.Event.EventObject(this, {data:this._inputField.value}); 
		RightNow.Event.fire("membertype_changed",member_id);
	},
	_reset: function(type,args)
	{
		if(this.fieldName == "Incident.CustomFields.c.member_type_new")
		{
			var member_id = new RightNow.Event.EventObject(this, {data:this._inputField.value}); 
			RightNow.Event.fire("zip_bsf_based_membertype",member_id);
			RightNow.Event.fire("lifetimerank_based_membertype",member_id);
			RightNow.Event.fire("thread_based_membertype",member_id);
			RightNow.Event.fire("coachid_membertype",member_id);
		}
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		errorWidget.classList.remove("rn_ErrorField");
		document.getElementById("rn_errorlocation_chat").innerHTML = "";
		document.getElementById("rn_errorlocation_chat").classList.remove("rn_MessageBox");	
	},
	membertype_required_based_channel: function(type,args)
	{
		
		var url=String(window.location);  		
		var exploded_url= url.split("/");		
		var index=exploded_url.indexOf("prechatsurvey");
		var fbindex = exploded_url.indexOf("facebooksurvey");
		if(index!=-1)		
		var channel_id = "1529";	
		else
		{
			if(fbindex!=-1)
				var channel_id = "1532";
			else	
				var channel_id=document.querySelector('input[name="channel"]:checked').value;
		}
		console.log(channel_id);
		
		if(channel_id=="1529" || channel_id=="1532")//chat or facebook
		{
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
		}
		else if(channel_id=="1530" && this.data.js.isloggedin=="loggedout")
		{
			console.log("inside member_id");
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
		}
		else
		{
			this.data.attrs.required=false;
		}
	}
});