RightNow.namespace('Custom.Widgets.ResponsiveDesign.testchanneldisplay');
Custom.Widgets.ResponsiveDesign.testchanneldisplay = RightNow.Field.extend({ 
   overrides: {
        constructor: function(){
			console.log("control execution 1");
            if (this.data.js.readOnly) return;

			console.log("control execution 2");
            this.parent();
            console.log("control execution 3");
            var attrs = this.data.attrs;
			console.log("control execution 4");
			this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= "<h3>Best way to contact us based on your selection</h3>";
			/*******************************Clickable event code start*****************************************/
			/*var radioitems_count = this.data.js.radioitems_count;
            var radio_button_inputs=this._inputSelector + "_"+(radioitems_count-1);
			var radio_input;
			for(var i=radioitems_count-2;i>=0;i--)
			{
				radio_input=this._inputSelector + "_" + i;
				radio_button_inputs =radio_button_inputs+", "+radio_input;
			}
			this.input = this.Y.all(radio_button_inputs);*/
			
			/*******************************Clickable event code end*******************************************/
			
			
			
            /******************************* Primary[top level] category name and id code start, Self service form details*****************************************/
            var FieldName = this.data.js.name;
			//console.log(FieldName);
			var url=String(window.location);   
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			//this.top_parent= exploded_url[index+1].replace("%20"," ").split('-'); 
			this.top_parent= exploded_url[index+1].split('.'); 
			/******************************* Primary[top level] category name and id code end, Self service form details*****************************************/
			
			
			console.log("control execution 5");
			
			
			/******************************* hide/show of fields. Code below*****************************************/
			if(FieldName=='Incident.CustomFields.c.recommended_channel')			
				{   
				    //alert("before");
				    //this.wait(500);     
					console.log("control execution 6");
					var id=this._inputSelector+"_0";
					this.input = this.Y.one(id);
					var recommend_id_only = this.data.js.recommendedchannel_id;
					//alert("0");
					//alert("before");
					//this.wait(5000);  
					//alert("after");   
					console.log("control execution 7");
					if((typeof(recommend_id_only) !== 'undefined') && (recommend_id_only!==null) && (recommend_id_only!==""))
					{
						   // alert("1");
						   console.log("test8");  
							this.input.on("click", this.display_fields_for_all_categories, this, recommend_id_only[0]);
							//setTimeout(function(){this.input.on("click", this.display_fields_for_all_categories, this, recommend_id_only[0]);},500);
							
							
					}
					
					var displaychannel_id_only=this.data.js.displaychannel_id;
					
					if((typeof(displaychannel_id_only) !== 'undefined') && (displaychannel_id_only!==null) && (displaychannel_id_only!==""))
					{
						    // alert("2");
							var k=1;   
							for(var i=0;i<displaychannel_id_only.length;i++)
							{	
									var id=this._inputSelector+"_"+k;   
									k++;
									this.input = this.Y.one(id);
									this.input.on("click", this.display_fields_for_all_categories, this, displaychannel_id_only[i]);
			
					        }
				    }
					
					RightNow.Event.subscribe("onResponse",this.displayMessage,this);//fired from custom/responsive/UpdateCreditCardFormSubmit 
					
				}
           /******************************* hide/show of fields. Code above*****************************************/
		   
		   
		   
		    if(!this.input) return;

            if(attrs.hint && !attrs.hide_hint && !attrs.always_show_hint) {
                this._initializeHint();
            }

            if(attrs.initial_focus && this.input) {
                if(this.data.js.type === "Boolean" && this.input[0] && this.input[0].focus)
                    this.input[0].focus();
                else if(this.input.focus)
                    this.input.focus();
            }

            if (attrs.validate_on_blur && attrs.required) {
                this.Y.Event.attach('blur', this.blurValidate, this.input instanceof this.Y.NodeList ? this.input.item(1) : this.input, this);
            }
		   
            this.parentForm().on("submit", this.onValidate, this);
			
			
        }
    },

     /**
     * Used by Dynamic Forms to switch between a required and a non-required label
     * @param  {Object} container    The DOM node containing the label
     * @param  {Boolean} requiredness True or false
     * @param  {String} label        The label text to be inserted
     * @param  {String} template     The template text
     */
	 wait: function(ms)
	 {
		 //alert(ms);
		 var start = new Date().getTime();
		 var end = start;
		 while(end < start + ms) {
			 end = new Date().getTime();
		 }
	 },
    swapLabel: function(container, requiredness, label, template) {
        this.Y.augment(this, RightNow.RequiredLabel);
        var templateObject = {
            label: label,
            instanceID: this.instanceID,
            fieldName: this._fieldName,
            required: requiredness,
            hint: this.data.attrs.hint
        };

        container.setHTML('');
        container.append(new EJS({text: template}).render(templateObject));
    },

    /**
     * Triggered whenever a constraint is changed.
     * @param  {String} evt        The event name
     * @param  {Object} constraint A list of constraints being changed
     */
    constraintChange: function(evt, constraint) {
        constraint = constraint[0];
        if(constraint.required === this.data.attrs.required) return;

        //If the requiredness changed and the form has already validated, clear the messages and highlights
        this.toggleErrorIndicator(false);
        if(this.data.attrs.required && this.lastErrorLocation) {
            this.Y.one('#' + this.lastErrorLocation).all("[data-field='" + this._fieldName + "']").remove();
        }

        //Replace any old labels with new labels
        if(this.data.attrs.label_input) {
            if(this.data.js.type === 'Boolean' && !this.data.attrs.display_as_checkbox) {
                this.swapLabel(this.Y.one(this.baseSelector + '_Label'), constraint.required, this.data.attrs.label_input, this.getStatic().templates.legend);
            }
            else {
                this.swapLabel(this.Y.one(this.baseSelector + '_LabelContainer'), constraint.required, this.data.attrs.label_input, this.getStatic().templates.label);
            }
        }

        this.data.attrs.required = constraint.required;
    },

    /**
     * Event handler executed when form is being submitted.
     * @param {String} type Event name
     * @param {Array} args Event arguments
     */
    onValidate: function(type, args) {
        var eo = this.createEventObject(),
            errors = [];

        this.toggleErrorIndicator(false);

        if(!this.validate(errors)) {
            this.lastErrorLocation = args[0].data.error_location;
            this.displayError(errors, this.lastErrorLocation);
            RightNow.Event.fire("evt_formFieldValidationFailure", eo);
            return false;
        }

        RightNow.Event.fire("evt_formFieldValidationPass", eo);
        return eo;
    },

    /**
     * Adds error messages to the common error element and adds
     * error indicators to the widget field and label.
     * @param {Array} errors Error messages
     * @param {String} errorLocation ID of the common error element
     */
    displayError: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation);
        if(commonErrorDiv) {
            for(var id = ((this.input instanceof this.Y.NodeList) ? this.input.item(0).get("id") : this.input.get("id")),
                    i = 0, message; i < errors.length; i++) {
                message = errors[i];
                message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
                commonErrorDiv.append("<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                                "\").focus(); return false;'>" + message + "</a></b></div>");
            }
        }
        this.toggleErrorIndicator(true);
    },

    /**
     * Adds / removes the error indicators on the
     * field and label.
     * @param {Boolean} showOrHide T to add, F to remove
     */
    toggleErrorIndicator: function(showOrHide) {
        var method = ((showOrHide) ? "addClass" : "removeClass");
        this.input[method]("rn_ErrorField");
        this.Y.one(this.baseSelector + "_Label")[method]("rn_ErrorLabel");
    },

    /**
     * Validates the field's requiredness state.
     * Asserts that attrs.required is true.
     */
    blurValidate: function() {
        this.toggleErrorIndicator(!this.getValue());
    },

    /**
     * Event handler executed when country dropdown is changed.
     * Should only be called for the 'contacts.country_id' select field.
     */
    countryChanged: function() {
        var value = this.input.get("value"),
            fireResponse = function(response, eventObject) {
                RightNow.Event.fire("evt_provinceResponse", response, eventObject);
            };
        if(value) {
            var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
            if (RightNow.Event.fire("evt_provinceRequest", eventObject)) {
                this._provinces = this._provinces || {};
                if (this._provinces[value]) {
                    return fireResponse(this._provinces[value], eventObject);
                }
                RightNow.Ajax.makeRequest("/ci/ajaxRequestMin/getCountryValues", eventObject.data, {
                    successHandler: function(response) {
                        this._provinces[value] = response;
                        fireResponse(response, eventObject);
                    },
                    scope: this,
                    json: true,
                    type: "GETPOST"
                });
            }
        }
        else {
            fireResponse({ProvincesLength: 0, Provinces: {}});
        }
    },

    /**
     * Event handler executed when province/state data is returned from the server.
     * Should only be subscribed to by the 'contacts.prov_id' field.
     * @param type String Event name
     * @param args Object Event arguments
     */
    onProvinceResponse: function(type, args) {
        var response = args[0],
            options = '',
            provinces = response.Provinces,
            i, length;
        this.input.set("innerHTML", "");
        if (provinces) {
            if (!this.Y.Lang.isArray(provinces)) {
                // TK - remove when PHP toJSON converts array-like objects into arrays
                var temp = [];
                this.Y.Object.each(provinces, function(val) {
                    temp.push(val);
                });
                provinces = temp;
            }

            if (!provinces[0] || (provinces[0].Name !== "--" && !this.data.hideEmptyOption)) {
                provinces.unshift({Name: "--", ID: ""});
            }
            for (i = 0, length = provinces.length; i < length; i++) {
                options += "<option value='" + provinces[i].ID + "'>" + provinces[i].Name + "</option>";
            }
            this.input.append(options);
            this.input.set('value', this.currentState);
        }
        //Any subsequent province requests should go back to the initial value '--'
        this.currentState = '';
    },

    /**
     * Event handler for when input field changes and field is Incident.StatusWithType.Status. Tries to   
     * find the Incident.Theads field to toggle it's requiredness.
     */
    onStatusChanged: function(){
        var threadInput = this.parentForm().findField('Incident.Threads');
        if(threadInput){
            threadInput.setConstraints({required: this.input.get('value') === '0'});
        }
    },
	
/**************************************************************display_fields_for_all_categories********************************************************************************/
//This below function is called whenever any of the channel(both recommended and display) is clicked. From this function only the pop up coming functionality and the hide/show of the fields takes place. 
// NOTE:-
//1. First step:- The channel display widget is a dropdown field. In its view page this dropdown is shown as tile format.To make it as tile we changes the view to radio button and by using css radio button changed to tile format. Each of this tile is a link. The First step is used to link the radio button and tha link.
/*****************************************************************************************************************************************************************************/	

	display_fields_for_all_categories: function(type,i)
    { 
	
	     
         //alert("testing from speridian");
		// alert(i);
        /*********************First step(explained above)******************/
		var radios = document.getElementsByName("channel");

		for (var j = 0; j < radios.length; j++)
		{
				if (radios[j].value == i)
				{
						radios[j].checked = true;
						break;
				}
		}
        /*********************First step(explained above)******************/
		
		
		var checked_channel = document.querySelector('input[name="channel"]:checked').value;
		var channel = new RightNow.Event.EventObject(this, {data:checked_channel}); 
		
		
		if(checked_channel!='1528')//self service form
		{
			$('body').addClass("hide-scroll");  
		}
		
		if(checked_channel=='1527')//ask an expert  
		{
			document.getElementById("hidden-channel-value").value="hide-show-scroll-expert";
		}
		
		
		
        if(this.top_parent[0]!=='1704')// if condition-- Not My coach business(not the special categories) 

		{
			
				if(checked_channel=='1527') //ask an expert                    
				{
				
						document.getElementById("rn_ErrorLocation_directly").innerHTML = "";
						document.getElementById("rn_ErrorLocation_directly").classList.remove("rn_MessageBox");	
						document.getElementById("rn_ErrorLocation_directly").classList.remove("rn_ErrorMessage");	
						//================ask error yellow================
						
						if(document.getElementById("directlyChannelEmail"))
						{
								var errdirectlyChannelEmail = document.getElementById("directlyChannelEmail");
								errdirectlyChannelEmail.classList.remove("rn_ErrorField");
						}
						
						if(document.getElementById("directlyChannelQuestion"))
						{
								var errdirectlyChannelQuestion = document.getElementById("directlyChannelQuestion");
								errdirectlyChannelQuestion.classList.remove("rn_ErrorField");
						}
						
						if(document.getElementById("directlyChannelFirstName"))
						{
								var errdirectlyChannelFirstName = document.getElementById("directlyChannelFirstName");
								errdirectlyChannelFirstName.classList.remove("rn_ErrorField");
						}
						
						if(document.getElementById("directlyChannelLastName"))
						{
								var errdirectlyChannelLastName = document.getElementById("directlyChannelLastName");
								errdirectlyChannelLastName.classList.remove("rn_ErrorField");
						}
						
						this.show_ask_expert_Form();
						
						
						/*******************Hide/show of the fields will take place here************/
						var displayBlock =["ask-an-expert-show","ask-title"];
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title",,"facebook-title","phone-us","phone-title","after-submit-email","hide-for-email-confirm-popup","file-upload","email-conf-title","rn_ErrorLocation_directly","membertype"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						/*******************Hide/show of the fields will take place here************/
				
				}//end of ask an expert
				
				
				else if(checked_channel=='1528')//self service form
				{
					
						if(typeof(this.data.js.self_service_form_link_path) !== 'undefined' && this.data.js.self_service_form_link_path!==null && this.data.js.self_service_form_link_path!=="")
						{
						
						this.selfserviceform_details=this.data.js.self_service_form_link_path.split('->');
						
								if(this.selfserviceform_details[1]=="Check Order Status" || this.selfserviceform_details[1]=="Update Credit Card")
								{
								
										this.showPopup(this.selfserviceform_details[1]);
								}
								else
								{
										window.open(this.selfserviceform_details[1]);
								}
						}
				
				
				}//end of self service form
				
				
				else if(checked_channel=='1529')//chat with an agent
				{
				
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
						
						this.showForm();
						
						var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","chat-title","remove-callus-email","hide-for-email-confirm-popup","file-upload","bsf","membertype"];
						var displayNone =["coachid","lifetimerank","phone-us", "phone-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						//}
						/*else
						{
						var regular_chat_hour =["regular-chat-hours","submit-button"];
						this._displayBlock(regular_chat_hour);
						}*/
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						
						RightNow.Event.fire("chat_fields_required",channel);
						RightNow.Event.fire("chat_fields_not_required",channel);
						RightNow.Event.fire("reset",channel);
						//}
				
				
				}// chat with an agent
				
				
				else if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
				{
					
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
						
						this.showForm();
						
						if(checked_channel=='1532')
						{
								document.getElementById("facebook-title").style.display="block";
								document.getElementById("email-title").style.display="none";
								//member type required--facebook
								document.getElementById("membertype").style.display="block";
								document.getElementById("bsf").style.display="block";
								RightNow.Event.fire("facebook_fields_required",channel);
								
						}
						else
						{
								document.getElementById("email-title").style.display="block";
								document.getElementById("facebook-title").style.display="none";
								//member type not required--email
								document.getElementById("membertype").style.display="none";
								document.getElementById("bsf").style.display="none";
						}
						
						var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","submit-button","hide-for-email-confirm-popup","file-upload"];
						var displayNone =["coachid","lifetimerank","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						
						RightNow.Event.fire("email_fields_required",channel);
						RightNow.Event.fire("email_fields_not_required",channel);
						RightNow.Event.fire("reset",channel);
						//}
						
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
				}//end of email us or facebook
				
				
				else if(checked_channel=='1531')//call us
				{
						this.showForm();
						
						var displayBlock =["phone-us","phone-title","hide-for-email-confirm-popup"];
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","membertype"];
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("all_fields_not_required",channel);
						RightNow.Event.fire("reset",channel);
						//}
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
				} //end of call us
		
      }// end of if condition-- Not My coach business
	  
      else // else condition-- My coach business
	  
      {

		if(checked_channel=='1527') //ask an expert                    
		{
				document.getElementById("rn_ErrorLocation_directly").innerHTML = "";
				document.getElementById("rn_ErrorLocation_directly").classList.remove("rn_MessageBox");	
				document.getElementById("rn_ErrorLocation_directly").classList.remove("rn_ErrorMessage");	
				//================ask error yellow================
				if(document.getElementById("directlyChannelEmail"))
				{
						var errdirectlyChannelEmail = document.getElementById("directlyChannelEmail");
						errdirectlyChannelEmail.classList.remove("rn_ErrorField");
				}
				
				if(document.getElementById("directlyChannelQuestion"))
				{
						var errdirectlyChannelQuestion = document.getElementById("directlyChannelQuestion");
						errdirectlyChannelQuestion.classList.remove("rn_ErrorField");
				}
				
				if(document.getElementById("directlyChannelFirstName"))
				{
						var errdirectlyChannelFirstName = document.getElementById("directlyChannelFirstName");
						errdirectlyChannelFirstName.classList.remove("rn_ErrorField");
				}
				
				if(document.getElementById("directlyChannelLastName"))
				{
						var errdirectlyChannelLastName = document.getElementById("directlyChannelLastName");
						errdirectlyChannelLastName.classList.remove("rn_ErrorField");
				}
				
				
				this.show_ask_expert_Form();
				
				
				var displayBlock =["ask-an-expert-show","ask-title"];
				var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title",,"facebook-title","phone-us","phone-title","after-submit-email","hide-for-email-confirm-popup","file-upload","email-conf-title","rn_ErrorLocation_directly","membertype"];
				
				
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
		
		}//end of ask an expert
		
		
		else if(checked_channel=='1528')//self service form
		{
				if(typeof(this.data.js.self_service_form_link_path) !== 'undefined' && this.data.js.self_service_form_link_path!==null && this.data.js.self_service_form_link_path!=="")
				{
						this.selfserviceform_details=this.data.js.self_service_form_link_path.split('->');
						window.open(this.selfserviceform_details[1]);
				}
				
		}//end of self service form
		
		
		else if(checked_channel=='1529')//chat with an agent
		{
		
				if(document.getElementById('after-submit-email').style.display=="block")
				{
						RightNow.Event.fire("clearvalue_special_categories",channel);
				}
				
				this.showForm();
				
				
				var displayBlock =["bsf","lifetimerank","email","first-name","last-name","agent-help","language","coachid","remove-callus-email","chat-title","hide-for-email-confirm-popup","file-upload","zipcode","membertype"];
				var displayNone =["phone-us","phone-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
				
				//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
				//{
				
				RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
				RightNow.Event.fire("chat_fields_required_special_categories",channel);
				RightNow.Event.fire("chat_fields_not_required_special_categories",channel);
				RightNow.Event.fire("remove_required_special_categories",channel);
				RightNow.Event.fire("fire_to_lifetimerank_from_chat_special_categories");
				RightNow.Event.fire("reset",channel);
				//}
		
		
		}// end of chat with an agent
		
		
		else if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
		{
				if(document.getElementById('after-submit-email').style.display=="block")
				{
						RightNow.Event.fire("clearvalue_special_categories",channel);
				}
				
				this.showForm();
				
				if(checked_channel=='1532')
				{
						document.getElementById("facebook-title").style.display="block";
						document.getElementById("email-title").style.display="none";
						//member type required--facebook
						document.getElementById("membertype").style.display="block";
						document.getElementById("zipcode").style.display="block";
						RightNow.Event.fire("facebook_fields_required",channel);
				}
				else
				{
						document.getElementById("email-title").style.display="block";
						document.getElementById("facebook-title").style.display="none";
						//member type not required--email
						document.getElementById("membertype").style.display="none";
						document.getElementById("zipcode").style.display="none";
				}
				
				var displayBlock =["bsf","lifetimerank","email","first-name","last-name","agent-help","language","coachid","submit-button","hide-for-email-confirm-popup","file-upload"];
				var displayNone =["phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
				
				//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
				//{
				
				RightNow.Event.fire("email_fields_required_special_categories1",channel);
				RightNow.Event.fire("email_fields_not_required_special_categories",channel);
				RightNow.Event.fire("fire_to_lifetimerank_from_email_special_categories");
				RightNow.Event.fire("reset",channel);
				//}
				
		}//end of email or facebook
		
		else if(checked_channel=='1531')//call us
		{
				this.showForm();
				
				var displayBlock =["phone-us","phone-title","hide-for-email-confirm-popup"];
				var displayNone =["zipcode","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","bsf","lifetimerank","email","first-name","last-name","agent-help","language","coachid","submit-button","diamond-chat-hours","remove-callus-email","chat-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","membertype"];
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
		}//end of call us

   }// end of else condition-- My coach business

},//end of display_fields_for_all_categories


/*********************************************end of display_fields_for_all_categories()********************************************************************************/

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
	
	showForm: function(type,args)
	{
		
		$('#self-service').addClass('active');
        $('#self-service-form').addClass('active');
	},
	show_ask_expert_Form: function(type,args)
	{
		$('#ask-expert').addClass('active');
        $('#ask-expert-form').addClass('active');
	},
	
	showPopup: function(product_name)
	{
		if(product_name=="Check Order Status")
		{
			var modal = document.getElementById('myModal');
			modal.style.display = "block";
			
		}
		if(product_name=="Update Credit Card")
		{
			$("#responseMessage").hide();
			$("div #heading").html("Credit Card Update");
			document.getElementById("valid_data_vv").innerHTML = "";
			document.getElementById("rn_ErrorLocation_vv").style.display = "none";
			document.getElementById("valid_data_vv").style.display = "block";
			document.getElementById('myModal_ccu').style.display = "block";
			document.getElementById("formdisplay").style.display = "none";
			
		}
		
	},
	
	displayMessage: function(type,args) {
	
	
			$("#responseMessage_cc").show();
			$("#responseMessage_cc").html("<p>" + args[0].data.msg + "</p>");
			$("#formdisplay").hide();
			document.getElementById('closeButton').style.display = "block";
    }
	
	
	
});
    