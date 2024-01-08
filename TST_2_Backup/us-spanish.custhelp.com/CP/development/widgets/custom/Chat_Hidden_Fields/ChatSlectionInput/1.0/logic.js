RightNow.namespace('Custom.Widgets.Chat_Hidden_Fields.ChatSlectionInput');
Custom.Widgets.Chat_Hidden_Fields.ChatSlectionInput = RightNow.Widgets.SelectionInput.extend({ 
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
			//alert(document.getElementById("top_parent").value);
			if(document.getElementById("top_parent") && document.getElementById("top_parent").value)
			window.top_parent_id = document.getElementById("top_parent").value;
			RightNow.Event.subscribe("evt_submitFormRequestForChat", this._getfieldvalues, this);
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
	_getfieldvalues: function()
	{
          if(this.data.js.name =="Incident.CustomFields.c.recommended_channel")
		{
			var url=String(window.location);  
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex=exploded_url.indexOf("facebooksurvey");
			if(index!=-1)
				var checked_channel = 1529;
			else
			{
				if(fbindex!=-1)
					var checked_channel = 1532;
				else	
					var checked_channel = document.querySelector('input[name="channel"]:checked').value;
			}	
			if(document.getElementsByName("Incident.CustomFields.c.recommended_channel")[1])
		    this.input.set('value',checked_channel);
		}
		
		if(this.data.js.name =="Incident.CustomFields.c.life_time_rank")
		{
			if(document.getElementsByName("Incident.CustomFields.c.life_time_rank")[1])
		    var lifetime = document.getElementsByName("Incident.CustomFields.c.life_time_rank")[1].value;
			//var membertype = document.getElementsByName("Incident.CustomFields.c.member_type_new")[1].value;
			//if(this.data.js.check_day == 2 && lifetime == 492 && membertype == 388) 
			//var lifetime = 478;
		    this.input.set('value',lifetime);
		}
		
		if(this.data.js.name =="Incident.CustomFields.c.language_shk")
		{
			if(document.getElementsByName("Incident.CustomFields.c.language_shk")[1])
			{
		    var language = document.getElementsByName("Incident.CustomFields.c.language_shk")[1].value;
		    this.input.set('value',language);
			}
		}
		if(this.data.js.name =="Incident.CustomFields.c.member_type_new")
		{
			if(document.getElementsByName("Incident.CustomFields.c.member_type_new")[1])
			{
		    var membertype = document.getElementsByName("Incident.CustomFields.c.member_type_new")[1].value;
		    this.input.set('value',membertype);
			}
		}
		if(this.data.js.name =="Incident.CustomFields.c.account_verified")
		{
			//alert(this.instanceID);
			//alert("b4 sub : "+$("#rn_"+this.instanceID+"_Incident\\.CustomFields\\.c\\.account_verified_1").val());
			//alert(CustomSelectionInputInstanceID);
			if($('#rn_'+CustomSelectionInputInstanceID+'_Incident\\.CustomFields\\.c\\.account_verified_1').is(':checked'))
			{
			$("#rn_"+this.instanceID+"_Incident\\.CustomFields\\.c\\.account_verified_1").prop("checked", true);
			//alert("af sub : "+$("#rn_"+this.instanceID+"_Incident\\.CustomFields\\.c\\.account_verified_1").val());
			}
			
			//alert(last);
		    //this.input.set('value',last);
		}
    }
	
});