RightNow.namespace('Custom.Widgets.ResponsiveDesign.SelectionInput');
Custom.Widgets.ResponsiveDesign.SelectionInput = RightNow.Widgets.SelectionInput.extend({ 
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
			document.getElementById("rn_" + this.instanceID + "_LabelContainer").style.display = "none";
			document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name).className+=" mat-input";
			document.getElementById("rn_" + this.instanceID).className+=" mat-div"; 
			
			this.instanceID = instanceID;
			this.data = data;
			this.fieldName = data.js.name;
			this._inputField = document.getElementById("rn_"+this.instanceID+"_"+this.fieldName);
			//this.clearOnLoad();
			
			var url=String(window.location);   
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			//this.top_parent= exploded_url[index+1].replace("%20"," ").split('-'); 
			this.top_parent= exploded_url[index+1].split('.'); 
			
			var catid = exploded_url.indexOf("catid");
			this.categoryid= exploded_url[catid+1].split('/'); 
			
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/bblivecategory', {text:this.categoryid[0]}, {
                    successHandler: function(response) {
								
								console.log(response);
								if(response ==2)
								this.top_parent[0] = '1706';
								
								 
							},
							scope: this,
							json: true,
							async: false,
							type: "POST"
                	});
			
			var url1=String(window.location);  
			var exploded_url1= url.split("/");
			var index1=exploded_url.indexOf("prechatsurvey");
			if(index1!=-1)
			this._fields_required();
			
			var indexfb=exploded_url.indexOf("facebooksurvey");
			if(indexfb!=-1)
			this._fields_required();
			
			if(this.fieldName=="Incident.CustomFields.c.life_time_rank")
			{
				//[below] as per client requirement changed the -- line to 'No Value'
				var get_first_element = document.getElementById("rn_"+this.instanceID+"_"+this.fieldName);
				get_first_element.options[0].text=" ";
				//[above] as per client requirement changed the -- line to 'No Value'
				
				// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				// the first code comment and the second code created..
	
				//RightNow.Event.subscribe("chat_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("chat_fields_required", this._fields_required, this);
				
				RightNow.Event.subscribe("clearvalue_special_categories", this._clearfieldvalue, this);
				RightNow.Event.subscribe("chat_fields_required_special_categories",this._fields_required, this);
				
				RightNow.Event.subscribe("email_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("email_fields_required_special_categories1",this._fields_required, this);
				RightNow.Event.subscribe("all_fields_not_required", this._fields_not_required, this);
				RightNow.Event.subscribe("reset", this._reset, this);
				
				// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				// the first code comment and the second code created..
				RightNow.Event.subscribe("fire_to_lifetimerank_from_email_categories", this.diamond_chat_hour_details, this);
				RightNow.Event.subscribe("fire_to_lifetimerank_from_chat_categories", this.diamond_chat_hour_details, this);
				
				RightNow.Event.subscribe("fire_to_lifetimerank_from_email_special_categories", this.diamond_chat_hour_details, this);
				RightNow.Event.subscribe("fire_to_lifetimerank_from_chat_special_categories", this.diamond_chat_hour_details, this);
				
				RightNow.Event.subscribe("membertype_changed", this.membertype_changed, this);
				RightNow.Event.subscribe("lifetimerank_based_membertype", this.membertype_changed, this);
				
				if(this.data.js.isloggedin=="loggedin")
				{
					var index=exploded_url.indexOf("prechatsurvey");
					if(index!=-1)
					{
					this.diamond_chat_hour_details();
					}
					var fbindex=exploded_url.indexOf("facebooksurvey");
					if(fbindex!=-1)
					{
					this.diamond_chat_hour_details();
					}
				} 
				
				this.input.on("change", this.diamond_chat_hour_details,this);

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
	_fields_not_required_lifetimerank: function(type,args)
	{
		    this.data.attrs.required=false;
			var label = document.getElementById("rn_" + this.instanceID + "_LabelNew");
			label.innerHTML= this.data.attrs.label_input;
	},
	_reset: function(type,args)
	{
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_'+this.data.js.name);
		errorWidget.classList.remove("rn_ErrorField");
		document.getElementById("rn_errorlocation_chat").innerHTML = "";
		document.getElementById("rn_errorlocation_chat").classList.remove("rn_MessageBox");	
	},
	diamond_chat_hour_details: function(type, args)
	{
		var life_time_rank=this._inputField.value;
		var eo = new RightNow.Event.EventObject(this, {data:life_time_rank}); 
		
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
		
		var channel_id = new RightNow.Event.EventObject(this, {data:channel}); 
		
		if(document.getElementsByName("Incident.CustomFields.c.member_type_new")[0])
		{
		 var membertype=document.getElementsByName("Incident.CustomFields.c.member_type_new")[0].value;
		}

        if(channel=="1529")
		{
		if(life_time_rank=="492")//5 Star Diamond and Above
		{
			if(this.top_parent[0]!=='1706' || ((this.top_parent[0]=='1706') && (membertype=='388')))
			{
				if(this.data.js.check_day=="0")
				{
					/*document.getElementById("submit-button").style.display = "none";*/
					//document.getElementById("diamondlineagent").style.display = "block";
				}
				else
				{
					document.getElementById("submit-button").style.display = "block";
					//document.getElementById("diamondlineagent").style.display = "none";
				}
				//commented by sriram
				//var displayNone =["language"];
				//var displayNone =["language","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available"];
				var displayNone =["language","spanish-message-outbound-time","spanish-message-chat-not-available","bblive-chat-hours"];
				//var displayBlock =["diamond-chat-hours"];
				if(this.top_parent[0]=='1706')
				{
				//var displayBlock =["diamond-chat-hours"];
				}
				else
				{
				//var displayBlock =["spanish-chat-hours","diamond-chat-hours"];	
				var displayBlock =["spanish-chat-hours"];
				this._displayBlock(displayBlock);
				}
				
				this._displayNone(displayNone);
				//commented for uk
				RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			
		    }
			   else
			   {
				  
				    var displayBlock =["bblive-chat-hours"];
					var displayNone =["diamond-chat-hours","language","spanish-message-outbound-time","spanish-message-chat-not-available","spanish-chat-hours"];  
					this._displayBlock(displayBlock);
					this._displayNone(displayNone);
					RightNow.Event.fire("fire_to_bblivechathour");
					RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			   }
		}
		else
		{
			if(this.top_parent[0]!=='1706')// not bblive instructor
			{
			//commented for uk
			var displayBlock =["language"];
			var displayNone =["diamond-chat-hours"];
			//this._displayBlock(displayBlock);
			this._displayNone(displayNone);
			RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			RightNow.Event.fire("fire_to_language_from_lifetimerank",channel_id);
			}
			else// else for bblive instructor
			{
			
			var displayBlock =["bblive-chat-hours"];
			var displayNone =["diamond-chat-hours","language","spanish-message-outbound-time","spanish-message-chat-not-available","spanish-chat-hours"];  
			this._displayBlock(displayBlock);
			this._displayNone(displayNone);
			//below code commented...since no language is required for bb live instructor
			//RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			//RightNow.Event.fire("fire_to_language_from_lifetimerank",channel_id);
			//below code commented...since no language is required for bb live instructor
			
			RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			RightNow.Event.fire("fire_to_bblivechathour");
			}
			
			
		}
		}
		else if(channel=="1530" || channel=="1532")
		{
			
			if(life_time_rank=="492")//5 Star Diamond and Above
			{
				
				document.getElementById("language").style.display = "none";
				
			}
			else
			{
				//commented for uk
				//document.getElementById("language").style.display = "block";
			}
			//commeented for uk
			//RightNow.Event.fire("make_remove_required_language_based_on_lifetimerank",eo);
			var hide_chat_hour =["regular-chat-hours","diamond-chat-hours"];
			this._displayNone(hide_chat_hour);
			var message=["submit-button"];
			this._displayBlock(message);
		}
		
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
	_clearfieldvalue: function(type,args)
	{
		this.input.set('value','1182');
	},
	
	membertype_changed:function(type,args)
	{
			var url=String(window.location);  
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex = exploded_url.indexOf("facebooksurvey");
			if(index!=-1)
				var channel_id = 1529;
			else
			{
				if(fbindex!=-1)
					var channel_id = 1532;
				else	
					var channel_id=document.querySelector('input[name="channel"]:checked').value;
			}
		if(channel_id=="1529" || channel_id=="1532")//chat or facebook
		{
			if(args[0].data=="388")
			{
			   this._fields_required();	
			     if(document.getElementById("lifetimerank"))
					{
					document.getElementById("lifetimerank").style.display = "block";
					}
			   
			    // for bblive instructor...
			   this.diamond_chat_hour_details();	
				// for bblive instructor
			}
			else if(args[0].data=="389" || args[0].data=="398" || args[0].data=="1725")
			{
			   this._fields_not_required_lifetimerank();
			    if(document.getElementById("lifetimerank"))
					{
					document.getElementById("lifetimerank").style.display = "none";
					}
			   
			    // for bblive instructor...
			   this.diamond_chat_hour_details();	
				// for bblive instructor
			}
			else
			{
			   this._fields_required();
			    if(document.getElementById("lifetimerank"))
					{
					document.getElementById("lifetimerank").style.display = "block";
					}
			    // for bblive instructor...
			   this.diamond_chat_hour_details();	
				// for bblive instructor
			}
		}
		if(channel_id=="1885")//document
		{
		          if(document.getElementById("lifetimerank"))
					{
					 this._fields_not_required_lifetimerank();
					}
		}	
		if(channel_id=="1530")//email
		{
		   if(args[0].data=="389")
           {
               if(document.getElementById("lifetimerank"))
                {
                    this._fields_not_required_lifetimerank();
                    document.getElementById("lifetimerank").style.display = "none";
                }
           }
           else if(args[0].data=="388")
           {
               if(document.getElementById("lifetimerank"))
                {
                    this._fields_required();    
                    document.getElementById("lifetimerank").style.display = "block";
                }
           }
           else if(args[0].data=="1725")
           {
                this._fields_not_required_lifetimerank();
               document.getElementById("lifetimerank").style.display = "none";
           }
           else
           {
               this._fields_not_required_lifetimerank();
               document.getElementById("lifetimerank").style.display = "none";
           }
		}	
	}
	
	
});