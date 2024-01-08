/***********************************************************************************************************************************************************************************
// Note:- This widget is extended from the Selection input widget. While extending its view is overridden. If the view get override, then the logic of the widget will be new. By default it won't get the features or the functions of the parent widget. To make it available, 'RightNow.widgets.extend' is changed to 'RightNow.Field.extend'.
// NOTE:- Please do not try to edit the already exist standard code until it is required. Otherwise it may result in the error. As per the requirement the code part which got edited is properly commented 
***********************************************************************************************************************************************************************************/


RightNow.namespace('Custom.Widgets.ResponsiveDesign.ChannelDisplay');
Custom.Widgets.ResponsiveDesign.ChannelDisplay = RightNow.Field.extend({ 
   overrides: {
        constructor: function(){
			
			
			
            if (this.data.js.readOnly) return;

			
            this.parent();
			

            //this.a_clicked = a_clicked;
            var attrs = this.data.attrs;
			
			this.data.attrs.required=false;
			
			//window.pta_login = RightNow.Interface.getConfig('PTA_EXTERNAL_LOGIN_URL');
			//pta_login = pta_login.replace("&returnurl=%next_page%"," ");
			var str = window.location.pathname;
			this.url_parameter = str.slice(23);
			

			RightNow.Event.subscribe("chatHours",this.chatHours,this);//fired from custom/ResponsiveDesign/CustomChatHours 
			RightNow.Event.subscribe("phoneHours",this.phoneHours,this);//fired from custom/ResponsiveDesign/CustomPhoneHours 
			RightNow.Event.subscribe("fbHours",this.fbHours,this);//fired from custom/ResponsiveDesign/CustomPhoneHours
			RightNow.Event.subscribe("smsHours",this.smsHours,this);//fired from custom/ResponsiveDesign/SMSChatHours
			RightNow.Event.subscribe("callmenowhours",this.callmenowhours,this);//fired from custom/ResponsiveDesign/CallMeNowChatHours
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
			
			var url=String(window.location);   
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			//this.top_parent= exploded_url[index+1].replace("%20"," ").split('-'); 
			this.top_parent= exploded_url[index+1].split('.'); 
			/******************************* Primary[top level] category name and id code end, Self service form details*****************************************/
			
			
			
			
			
			/******************************* hide/show of fields. Code below*****************************************/
			if(FieldName=='Incident.CustomFields.c.recommended_channel')			
				{   
				    
					var id=this._inputSelector+"_0";
					this.input = this.Y.one(id);
					var recommend_id_only = this.data.js.recommendedchannel_id;
					
					if((typeof(recommend_id_only) !== 'undefined') && (recommend_id_only!==null) && (recommend_id_only!==""))
					{
						   
						   console.log("test8");
							this.input.on("click", this.display_fields_for_all_categories, this, recommend_id_only[0]);
							
							
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
		   
            this.parentForm().on("submit", this.onValidate, this)
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
 
		var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support/"," ");
		login_url = login_url.trim();
			
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
		
		if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
			{
				$('#box-style-email').addClass('box-style-email-popup');
				
			}
        else
			{
				$('#box-style-email').removeClass('box-style-email-popup');
				
			}			
		if(checked_channel!='1528')//self service form
		{
			$('body').addClass("hide-scroll");  
		}
		
		if(checked_channel=='1527')//ask an expert  
		{
			document.getElementById("hidden-channel-value").value="hide-show-scroll-expert";
		}
		
		if(checked_channel=='1621')//SMS
		{
			
						
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for SMS so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
 */						
									  
					RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/sms', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{
								window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=smssurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/smssurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	}); 
					
		}
		
				//CAll me Now start	
				if(checked_channel=='1131')	
				{	
						
									
		/*	
		-----------------------------------------------------------------------------------------------------------------------------------------------------	
		 Below code . Create a session on clicking the a tag for call me now so that upon successful login from hook we can redirect it to corresponding next page.	
		-----------------------------------------------------------------------------------------------------------------------------------------------------	
		 */							
							
							RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/callmenow', {text:login_url}, {	
							successHandler: function(response) {	
											
										//alert(response['loggedin']);	
											
											
										if(response['loggedin'] ==  'no')	
										{	
										window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=callmenow/'+encodeURIComponent(this.url_parameter);	
										}	
										else{	
											window.location = '/app/callmenow/'+this.url_parameter;	
										}	
											
									},	
									scope: this,	
									json: true,	
									type: "POST"	
							}); 	
								
				}	
					
		//Call me now end
		
        if((this.top_parent[0]!=='1704') && (this.top_parent[0]!=='1706'))// if condition-- Not My coach business(not the special categories) and not bblive instructor 

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
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","facebook-title","phone-us","phone-title","after-submit-email","hide-for-email-confirm-popup","file-upload","email-conf-title","rn_ErrorLocation_directly","membertype"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						/*******************Hide/show of the fields will take place here************/
				
				}//end of ask an expert
				
				
				else if(checked_channel=='1528')//self service form
				{/*
					
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
				
				
				*/}//end of self service form
				
				
				else if(checked_channel=='1529')//chat with an agent
				{
					//alert(this.a_clicked);
				   
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
					
						//this.showForm();
 /*
 -----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/			
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{ 
								window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/prechatsurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/prechatsurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	});
					
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
						
						var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","chat-title","remove-callus-email","hide-for-email-confirm-popup","bsf","membertype","lifetimerank"];/**/
						var displayNone =["coachid","phone-us", "phone-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
						
				
				
				}// chat with an agent
				
				
				else if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
				{
					
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
						
						
						
						if(checked_channel=='1532')
						{
							
							/*							-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/			
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/facebook', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{ 
									window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/facebooksurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/facebooksurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	});
					
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
							var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","hide-for-email-confirm-popup","bsf","membertype","lifetimerank","facebook-title"];/**/
						var displayNone =["coachid","phone-us", "phone-title","email-title","ask-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","chat-title","remove-callus-email"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						
					
						
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
								
								
						}
						else
						{
								this.showForm();
								document.getElementById("doc-title").style.display="none";
							    document.getElementById("email-title").style.display="block";
								document.getElementById("facebook-title").style.display="none";
								//member type not required--email
								document.getElementById("membertype").style.display="none";
								document.getElementById("bsf").style.display="none";
								if(this.data.js.isloggedin=="loggedin")
								{
									if(this.top_parent[0]=='3784') 
									{
                                        var displayBlock =["file-upload","agent-help","submit-button","order-no","bike-serial","tablet-id"];
                                    var displayNone =["phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","bsf","lifetimerank","language","coachid"];
                                    }
                                    else
									{
                                        var displayBlock =["file-upload","agent-help","submit-button"];
										var displayNone =["phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","bsf","lifetimerank","language","coachid"];
                                    }
								}
								else 
								{
                                    if(this.top_parent[0]=='3784') {
                                        var displayBlock =["zipcode","email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank","agent-help","membertype","order-no","bike-serial","tablet-id"];
                                    var displayNone =["coachid","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
                                    }
                                    else{
                                       var displayBlock =["zipcode","email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank","agent-help","membertype"];
                                    var displayNone =["coachid","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"]; 
                                    }

									 
								}

						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
					
						

						
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						//explained above
						
						
						
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
						RightNow.Event.fire("email_fields_required",channel);
						RightNow.Event.fire("email_fields_not_required",channel);
						RightNow.Event.fire("email_fields_desc_required",channel);
						RightNow.Event.fire("reset1",channel);
						RightNow.Event.fire("reset",channel);
								
					}
						
						
				}//end of email us or facebook
				
				else if(checked_channel=='1885')//Document 
		        {
								this.showForm();
								document.getElementById("email-title").style.display="none";
								document.getElementById("facebook-title").style.display="none";
								document.getElementById("doc-title").style.display="block";
								//member type not required--email
								document.getElementById("membertype").style.display="none";
								document.getElementById("zipcode").style.display="none";
						if(this.data.js.isloggedin=="loggedin")
						{
					     var displayBlock =["language","submit-button","hide-for-email-confirm-popup","file-upload","coachid","bsf"];
						var displayNone =["agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","order-no","bike-serial","tablet-id","zipcode","lifetimerank"];
							}
						else
						{
							var displayBlock =["email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","coachid","bsf"];
						var displayNone =["agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","order-no","bike-serial","tablet-id","zipcode"];
						}
						
						
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("file_attachement_field_required",channel);
						RightNow.Event.fire("email_fields_required_special_categories1",channel);
						RightNow.Event.fire("email_fields_not_required_special_categories",channel);
						RightNow.Event.fire("fire_to_lifetimerank_from_email_special_categories");
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("reset1",channel);
				}
				
				else if(checked_channel=='1531')//call us
				{
						this.showForm();
						document.getElementById("email-title").style.display="none";
						document.getElementById("facebook-title").style.display="none";
						document.getElementById("doc-title").style.display="none";
						var displayBlock =["phone-us","phone-title","hide-for-email-confirm-popup"];
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","membertype","order-no","bike-serial","tablet-id"];
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("all_fields_not_required",channel);
						RightNow.Event.fire("reset",channel);
						//}
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
				} //end of call us
		
      }// end of if condition-- Not My coach business
	  
      else if(this.top_parent[0]=='1704')  // else condition-- My coach business
	  
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
				var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","facebook-title","phone-us","phone-title","after-submit-email","hide-for-email-confirm-popup","file-upload","email-conf-title","rn_ErrorLocation_directly","membertype"];
				
				
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
		
		}//end of ask an expert
		
		
		else if(checked_channel=='1528')//self service form
		{/*
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
				
		*/}//end of self service form
		
		
		else if(checked_channel=='1529')//chat with an agent
		{
		
				if(document.getElementById('after-submit-email').style.display=="block")
				{
						RightNow.Event.fire("clearvalue_special_categories",channel);
				}
				
				//this.showForm();
/*				
-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
 */						
			
											  
					RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{
								window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/prechatsurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/prechatsurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	}); 
					
					
		
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
				
				
				var displayBlock =["bsf","lifetimerank","email","first-name","last-name","agent-help","language","coachid","remove-callus-email","chat-title","hide-for-email-confirm-popup","zipcode","membertype"];
				var displayNone =["phone-us","phone-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","email-conf-title","file-upload"];
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
				RightNow.Event.fire("file_attachement_field_not_required",channel);
				//}
		
		
		}// end of chat with an agent
		
		
		else if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
		{
				if(document.getElementById('after-submit-email').style.display=="block")
				{
						RightNow.Event.fire("clearvalue_special_categories",channel);
				}
				
				
				
				if(checked_channel=='1532')
				{
					/*							-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/			
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/facebook', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{ 
									window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/facebooksurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/facebooksurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	});
					
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
						
							var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","hide-for-email-confirm-popup","bsf","membertype","lifetimerank","facebook-title"];/**/
						var displayNone =["coachid","phone-us", "phone-title","email-title","ask-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","chat-title","remove-callus-email"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						
					
						
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
								
								
						
				}
				else
				{
						this.showForm();
						document.getElementById("doc-title").style.display="none";
						document.getElementById("email-title").style.display="block";
						document.getElementById("facebook-title").style.display="none";
						//member type not required--email
						document.getElementById("membertype").style.display="none";
						document.getElementById("zipcode").style.display="none";
						
							if(this.data.js.isloggedin=="loggedin")
							{ 
								if(this.top_parent[0]=='3784') 
								{
									var displayBlock =["file-upload","agent-help","submit-button","order-no","bike-serial","tablet-id"];
                                    var displayNone =["phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","bsf","lifetimerank","language","coachid"];
								}
								else
								{
                                    var displayBlock =["file-upload","agent-help","submit-button"];
                                    var displayNone =["phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","bsf","lifetimerank","language","coachid"];
                                }

							}
							else
							{
								 if(this.top_parent[0]=='3784') 
								 {
									var displayBlock =["zipcode","email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank","agent-help","membertype","myx-fields","order-no","bike-serial","tablet-id"];
                                    var displayNone =["coachid","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"];
								 }
								 else
								 {
                                       var displayBlock =["zipcode","email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank","agent-help","membertype"];
									   var displayNone =["coachid","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title"]; 
                                 }
							}
						
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
				
				//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
				//{
					RightNow.Event.fire("file_attachement_field_not_required",channel);
					RightNow.Event.fire("email_fields_required",channel);
					RightNow.Event.fire("email_fields_not_required",channel);
					RightNow.Event.fire("email_fields_desc_required",channel);
					RightNow.Event.fire("reset1",channel);
					RightNow.Event.fire("reset",channel);
				}
				
				
				//}
				
		}//end of email or facebook
		else if(checked_channel=='1885')//Document 
		{
								this.showForm();
								document.getElementById("email-title").style.display="none";
								document.getElementById("facebook-title").style.display="none";
								document.getElementById("doc-title").style.display="block";
								//member type not required--email
								document.getElementById("membertype").style.display="none";
								document.getElementById("zipcode").style.display="none";
						if(this.data.js.isloggedin=="loggedin")
						{
					     var displayBlock =["language","submit-button","hide-for-email-confirm-popup","file-upload","coachid","bsf"];
						var displayNone =["agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","email","first-name","last-name","order-no","bike-serial","tablet-id","zipcode","lifetimerank"];
							}
						else
						{
							var displayBlock =["email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","coachid","bsf"];
						var displayNone =["agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","order-no","bike-serial","tablet-id","zipcode"];
						}
						
						
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("file_attachement_field_required",channel);
						RightNow.Event.fire("email_fields_required_special_categories1",channel);
						RightNow.Event.fire("email_fields_not_required_special_categories",channel);
						RightNow.Event.fire("fire_to_lifetimerank_from_email_special_categories");
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("reset1",channel);
		}
		else if(checked_channel=='1531')//call us
		{
				this.showForm();
				document.getElementById("email-title").style.display="none";
				document.getElementById("facebook-title").style.display="none";
				document.getElementById("doc-title").style.display="none";
				var displayBlock =["phone-us","phone-title","hide-for-email-confirm-popup"];
				var displayNone =["zipcode","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","bsf","lifetimerank","email","first-name","last-name","agent-help","language","coachid","submit-button","diamond-chat-hours","remove-callus-email","chat-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","membertype","order-no","bike-serial","tablet-id"];
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
		}//end of call us

   }// end of else condition-- My coach business
   
   else //BBlive instructor condition
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
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","facebook-title","phone-us","phone-title","after-submit-email","hide-for-email-confirm-popup","file-upload","email-conf-title","rn_ErrorLocation_directly","membertype","bblive-chat-hours","bblive-chat-status"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						/*******************Hide/show of the fields will take place here************/
				
				}//end of ask an expert
				
				
				else if(checked_channel=='1528')//self service form
				{/*
					
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
				
				
				*/}//end of self service form
				
				
				else if(checked_channel=='1529')//chat with an agent
				{
				
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
						
						//this.showForm();
						
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
 */						
			
											  
					RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{
								window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/prechatsurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/prechatsurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	}); 
					
			
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
						
						var displayBlock =["zipcode","email","first-name","last-name","agent-help","chat-title","remove-callus-email","hide-for-email-confirm-popup","bsf","membertype","lifetimerank","bblive-chat-hours","bblive-chat-status"];
						var displayNone =["coachid","phone-us", "phone-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						//RightNow.Event.fire("show_bblive_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						
						
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						RightNow.Event.fire("fire_to_bblivechathour");//fire to the bblive chathour widget under ResponsiveDesign
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
						
				
				
				}// chat with an agent
				
				
				else if(checked_channel=='1530' || checked_channel=='1532')//email us or facebook
				{
					
						if(document.getElementById('after-submit-email').style.display=="block")
						{
								RightNow.Event.fire("clearvalue",channel);
						}
						
						
						
						if(checked_channel=='1532')
						{
							/*							-----------------------------------------------------------------------------------------------------------------------------------------------------
 Below code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/			
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/facebook', {text:login_url}, {
                    successHandler: function(response) {
								
								//alert(response['loggedin']);
								
								if(response['loggedin'] ==  'no')
								{ 
									window.location = 'https://canada-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/facebooksurvey/'+encodeURIComponent(this.url_parameter);
								}else{
									window.location = '/app/chat/facebooksurvey/'+this.url_parameter;
								}
								
							},
							scope: this,
							json: true,
							type: "POST"
                	});
					
					
/*
-----------------------------------------------------------------------------------------------------------------------------------------------------
above code . Create a session on clicking the a tag for chat so that upon successful login from hook we can redirect it to corresponding next page.
-----------------------------------------------------------------------------------------------------------------------------------------------------
*/
							
							var displayBlock =["zipcode","email","first-name","last-name","agent-help","language","hide-for-email-confirm-popup","bsf","membertype","lifetimerank","facebook-title"];/**/
						var displayNone =["coachid","phone-us", "phone-title","email-title","ask-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","chat-title","remove-callus-email"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						
					
						
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("file_attachement_field_not_required",channel);
								
								
						
								
						}
						else
						{
								this.showForm();
								document.getElementById("email-title").style.display="block";
								document.getElementById("facebook-title").style.display="none";
								//member type not required--email
								document.getElementById("membertype").style.display="none";
								document.getElementById("bsf").style.display="none";
								
								if(this.data.js.isloggedin=="loggedin")
								{
									var displayBlock =["zipcode","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank"];
						var displayNone =["coachid","agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","bblive-chat-status","bblive-chat-hours","email","first-name","last-name"];
								}
								else
								{
									var displayBlock =["zipcode","email","first-name","last-name","language","submit-button","hide-for-email-confirm-popup","file-upload","lifetimerank"];
						var displayNone =["coachid","agent-help","phone-us","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","remove-callus-email","chat-title","phone-title","ask-title","after-submit-email","rn_errorlocation_chat","email-conf-title","bblive-chat-status","bblive-chat-hours"];
								}
								
								
						
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("file_attachement_field_required",channel);
						RightNow.Event.fire("email_fields_required",channel);
						RightNow.Event.fire("email_fields_not_required",channel);
						
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_email_categories");
						//explained above
						
						
						//}
						
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						RightNow.Event.fire("reset",channel);
						RightNow.Event.fire("reset1",channel);
						}
						
						
				}//end of email us or facebook
				
				
				else if(checked_channel=='1531')//call us
				{
						this.showForm();
						
						var displayBlock =["phone-us","phone-title","hide-for-email-confirm-popup"];
						var displayNone =["email","first-name","last-name","agent-help","coachid","bsf","lifetimerank","zipcode","language","regular-chat-hours","spanish-chat-hours","spanish-message-outbound-time","spanish-message-chat-not-available","submit-button","remove-callus-email","chat-title","email-title","ask-title","facebook-title","after-submit-email","rn_errorlocation_chat","file-upload","email-conf-title","membertype","bblive-chat-hours","bblive-chat-status"];
						//if(typeof(set_fire_subscribe) == 'undefined' || set_fire_subscribe==null || set_fire_subscribe=="")
						//{
						RightNow.Event.fire("all_fields_not_required",channel);
						RightNow.Event.fire("reset",channel);
						//}
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
				} //end of call us
		
      
   }//BBlive instructor condition
     
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
		$("body").removeClass("v-scroll").addClass("v-scroll-hide");
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
    },
//Call Me Now Start	
callmenowhours: function(type,args){	
	//alert("inside callmenowhours");	
//	console.log(args);	
	
	var incallmenowhours = args[0].data;	
   // alert(incallmenowhours);	
		
	var actual_link = window.location.href; 	
	var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support/"," ");	
	login_url = login_url.trim();	
		
		
	if(incallmenowhours==2)	
	{	
		//    alert("inside 2");	
		$(".disable-click-callmenow").css('pointer-events','none');	
			
	}	
	else	
	{   	
			//console.log('unset');	
			$(".continue").attr("href", "https://"+window.location.hostname+"/app/callmenow/"+login_url);	
	}	
		
	   
		
},	
//Call Me Now End
    chatHours: function(type,args){

    //	alert("inside chathours");
		//console.log(args);
	
        var inchathours = args[0].data;
		//alert(inchathours);
	
	    var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support/"," ");
		login_url = login_url.trim();
		
		if(inchathours==2)
		{
			console.log('set');
			$(".disable-click").css('pointer-events','none');
			
		}
		else
		{   
				console.log('unset');
				$(".continue").attr("href", "https://"+window.location.hostname+"/app/chat/prechatsurvey/"+login_url);
		}
        

       

        
    },
	
	fbHours: function(type,args){

    //	alert("inside chathours");
		//console.log(args);
	
        var fbhours = args[0].data;
		//alert(fbhours);
		var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support/"," ");
		login_url = login_url.trim();
	
		/*if(fbhours==2)
		{
			
			$(".disable-click-fb").css('pointer-events','none');
			
		}
		else
		{*/
			$(".continue_fb").attr("href", "https://"+window.location.hostname+"/app/chat/facebooksurvey/"+login_url);
			
		//}
        

       

        
    },
	
	smsHours: function(type,args){

    //	alert("inside chathours");
		//console.log(args);
	
        var smshours = args[0].data;
		//alert(fbhours);
		var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support/"," ");
		login_url = login_url.trim();
	
		if(smshours==2)
		{
			
			$(".disable-click-sms").css('pointer-events','none');
			
		}
		
    },
	
	phoneHours: function(type,args){

    //	alert("inside chathours");
		//console.log(args);
	
        var inphonehours = args[0].data;
		//alert(inchathours);
		
		
		if(inphonehours==2)
		{
			
		//	$(".disable-call-us").css('pointer-events','none'); //temporaraly this functionality is disabled because call us tile should  be 
																//clickable when it is closed. if you want to make it non clikable when it is
																//closed, just make this line uncomment.Fire and subscribe is done to make it work
			
		}
        

       

        
    }
	
});                                                             
    