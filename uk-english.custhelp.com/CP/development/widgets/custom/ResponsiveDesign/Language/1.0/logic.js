RightNow.namespace('Custom.Widgets.ResponsiveDesign.Language');
Custom.Widgets.ResponsiveDesign.Language = RightNow.Widgets.SelectionInput.extend({ 
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
			//this.clearOnLoad();
			
			var url=String(window.location);   
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			//this.top_parent= exploded_url[index+1].replace("%20"," ").split('-'); 
			this.top_parent= exploded_url[index+1].split('.'); 
			
			if(this.fieldName == "Incident.CustomFields.c.language_shk")
			{ 
			  RightNow.Event.subscribe("show_regular_chathours_details", this.show_regular_chathours_details, this);
			  this.input.on("change", this.show_regular_chathours_details,this);
			  RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
			  RightNow.Event.subscribe("clearvalue", this._clearfieldvalue, this);
			  RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
			  RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
			  RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
			  RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
			  RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
			  RightNow.Event.subscribe("reset", this._reset, this);
		      RightNow.Event.subscribe("make_remove_required_language_based_on_lifetimerank", this._make_remove_required_language_based_on_lifetimerank, this);
			  RightNow.Event.subscribe("fire_to_language_from_lifetimerank", this.show_regular_chathours_details, this);
			 
			 document.getElementById("rn_" + this.instanceID).className+=" downarrow"; 
			 document.getElementById("rn_" + this.instanceID).className+=" is-completed"; 
			  
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
	show_regular_chathours_details: function(type, args)
	{
		
		var channel_id="";
		try
		{
            channel_id=args[0].data;
		}
		catch(err)
		{
			var url=String(window.location);  		
            var exploded_url= url.split("/");		
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex=exploded_url.indexOf("facebooksurvey");
			if(index!=-1)		
				var channel_id = 1529;		
			else
			{
			if(fbindex!=-1)
				var channel_id = 1532;
			else	
				var channel_id=document.querySelector('input[name="channel"]:checked').value;
			}	
			
		}
		
		var language_id=this._inputField.value;
		if(channel_id=="1529")//chat with an agent
		{
			if(language_id==1182)//english
			{
				
				var regular_chat_hour =["regular-chat-hours","submit-button"];
				this._displayBlock(regular_chat_hour);
				
			}
			
			else// not english, not french and not spanish
			{
				//var regular_chat_hour_hide =["regular-chat-hours","submit-button"];
				//this._displayNone(regular_chat_hour_hide);
				var message=["regular-chat-hours","submit-button"];
				this._displayBlock(message);
			}
		}
		else if(channel_id=="1530")//email us
		{
				var regular_chat_hour =["regular-chat-hours"];
				this._displayNone(regular_chat_hour);
				var message=["submit-button"];
				this._displayBlock(message);  
				
		}
		     // RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
			 // RightNow.Event.subscribe("email_fields_required", this._fields_required, this);
			 // RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);   
	},
	
	   
	_displayNone: function(displayNone)
	{
		
		
		for (var i=0;i<displayNone.length;i++)
		{
			if(document.getElementById(displayNone[i]))
			{	
				document.getElementById(displayNone[i]).style.display = "none";
			}
		}	
	},
	
	_displayBlock: function(displayBlock)
	{
		
		for (var i=0;i<displayBlock.length;i++)
		{
			if(document.getElementById(displayBlock[i]))
			{
				document.getElementById(displayBlock[i]).style.display = "block";
			}
		}
	},
	_fields_required: function(type,args)
	{ 
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_fields_not_required: function(type,args)
	{
		    this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= this.data.attrs.label_input;
	},
	_reset: function(type,args)
	{
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		errorWidget.classList.remove("rn_ErrorField");
		document.getElementById("rn_errorlocation_chat").innerHTML = "";
		document.getElementById("rn_errorlocation_chat").classList.remove("rn_MessageBox");	
	},
	_make_remove_required_language_based_on_lifetimerank: function(type,args)
	{
		var url=String(window.location);  		
		var exploded_url= url.split("/");		
		var index=exploded_url.indexOf("prechatsurvey");	
		var fbindex=exploded_url.indexOf("facebooksurvey");
		if(index!=-1)		
			var channel = 1529;	
		else
			{
				if(fbindex!=-1)
					var channel = 1532;
				else	
					var channel=document.querySelector('input[name="channel"]:checked').value;
			}	
		
		
		if((this.top_parent[0]!=='1706' && args[0].data=="492" && channel=="1529") || (this.top_parent[0]=='1706' && channel=="1529")) 
		{
			
			this.data.attrs.required=false;
		}
		else
		{
		   
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			
		}
	},
	
	_clearfieldvalue: function(type,args)
	{
		this.input.set('value','1182');
	}
	
	
	/*clearOnLoad: function () {
		this.input.set('value','');
	}*/
});