RightNow.namespace('Custom.Widgets.ResponsiveDesign.Submit');
Custom.Widgets.ResponsiveDesign.Submit = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function(data,instanceID,Y) {
            // Call into parent's constructor
			
			var url=String(window.location);
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("catid");
			this.catid= exploded_url[index+1];
			
			//for myx bike category  submit text change 
            var index=exploded_url.indexOf("TLP"); 
            this.top_parent= exploded_url[index+1].split('.'); 
			
            this.parent();
			this.data = data;
   			this.instanceID = instanceID;
			this.checkvalidation="";
			RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjaxRequest, this);
			
			
        },

        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
		 
		 //jithin
		 
		 
            _onButtonClick: function(evt) {
        // cancel unsaved changes dialog box
        this.inputDataChanged = false;

        if (evt && evt.halt) {
            evt.halt();
        }
        if (this._requestInProgress) return false;

        this._toggleClickListener(false);

        this._removeFormErrors();

        //since the form is submitted by script, deliberately tell IE to do auto completion of the form data
        if (this.Y.UA.ie && window.external && "AutoCompleteSaveForm" in window.external) {
            window.external.AutoCompleteSaveForm(document.getElementById(this._parentForm));
        }
        this._fireSubmitRequest();
    },

    _fireSubmitRequest: function() {
        var eo = new RightNow.Event.EventObject(this, {data: {
            form: this._parentForm,
            f_tok: this.data.js.f_tok,
            error_location: this._errorMessageDiv.get("id"),
            timeout: this.data.attrs.timeout * 1000
        }});
        RightNow.Event.fire("evt_formButtonSubmitRequest", eo);
        this.fire("collect", eo);
    },

    /**
     * Event handler for when form has been validated.
     */
   _onFormValidated: function() {
	   
	   this.checkvalidation="1";
	    document.getElementById('rn_errorlocation_chat').style.display="none";
		RightNow.Event.fire("evt_submitFormRequestForChat");
        this._toggleLoadingIndicators();
        
         //Code for the popup enable reminder
          if (window.location.href.indexOf("prechatsurvey") > -1) {
            var tempFlag = document.getElementById('membertype').style.display;
            if(tempFlag=="block"){
            document.getElementById('popup-message-guest').style.display = "block";
            }
            else if(tempFlag=="none"){
            document.getElementById('popup-message-loggedin').style.display = "block";    
            }
         
        }

        this.fire("send", this.getValidatedFields());
				//var chatflag = 0;
					//this._track_btn_clicks(chatflag);
		  
    },

    /**
     * Event handler for when form fails validation check.
     */
    _onFormValidationFail: function() {
		this.checkvalidation="0";
		document.getElementById('rn_errorlocation_chat').style.display="block";
        this._displayErrorMessages(this._errorMessageDiv);
        RightNow.Event.fire("evt_formValidateFailure", new RightNow.Event.EventObject(this));
    },

    /**
     * Clears the informational flash data div if present
     */
    _clearFlashData: function() {
		
        var infoDiv = this.Y.one('.rn_MessageBox.rn_InfoMessage');
        if (infoDiv) {
            //Skip clearing SmartAssistant message div
            var parentClass = infoDiv.ancestor().getAttribute('class');
            if (parentClass && parentClass.search("rn_SmartAssistantDialog") === -1)
                infoDiv.set('innerHTML', '').removeClass('rn_InfoMessage');
        }
    },

    /**
     *Returns the element's absolute position on the page
     * @param {Object} element Y.node 
     */
    _absoluteOffset: function(element) {
		
        var top = 0;
        do {
            top += element.get('offsetTop');
            element = element.get('offsetParent');
        } 
        while(element);

        return top;
    },

    /**
     * For the given node,
     * - adds and removes classes
     * - scrolls to it, if it's not in the viewport
     * - focuses on the first <a> child, or on
     *   the element itself (by setting tabindex)
     * @param  {Object} messageArea Y.Node
     */
    _displayErrorMessages: function(messageArea) {
		
        messageArea.addClass("rn_MessageBox").addClass("rn_ErrorMessage").removeClass("rn_Hidden");
        this._clearFlashData();
        if (!this.Y.DOM.inViewportRegion(this.Y.Node.getDOMNode(messageArea), true)) {
            (new this.Y.Anim({
                node: this.Y.one(document.body),
                to:   { scrollTop: this._absoluteOffset(messageArea) - 40 },
                duration: 0.5
            })).run();
        }
        
        var firstField = messageArea.one("a");
        
        if (firstField) {
            // Focus first link in the error box.
            firstField.focus();
            firstField.setAttribute('role', 'alert');
            // If tabIndex had previously been set via the
            // else case (during a different failure) then remove it now.
            messageArea.removeAttribute('tabIndex');
        }
        else {
            // The error box doesn't have any links, so focus on the box itself.
            // Setting tabIndex to 0 on an element that's not normally tab-focusable gives
            // it normal tab flow in the document.
            messageArea.set('tabIndex', 0);
            messageArea.setAttribute('role', 'alert');
            messageArea.focus();
        }
        var errorLbl = messageArea.all("div").size() > 1 ? RightNow.Interface.getMessage("ERRORS_LBL") : RightNow.Interface.getMessage("ERROR_LBL");
        messageArea.prepend("<h2>" + errorLbl + "</h2>");
        messageArea.one("h2").setAttribute('role', 'alert');
    },

    /**
     * Default handler for form response.
     * @param  {String} type Event name
     * @param  {Array} args EventObjects
     */
    _defaultFormSubmitResponse: function(type, args) {
		
        if (this.fire('defaultResponseHandler', args[0])) {
			
            this._formSubmitResponse(type, args);
        }
    },

    /**
     * Event handler for when form submission returns from the server
     * @param {String} type Event name
     * @param {Array} args Event arguments
     */
    _formSubmitResponse: function(type, args) {
		
        var responseObject = args[0].data,
            result;

        if (!this._handleFormResponseFailure(responseObject) && responseObject.result) {
            result = responseObject.result;

            // Don't process a SmartAssistant response.
            if (!result.sa) {
                if (result.transaction || result.redirectOverride) {
                    return this._handleFormResponseSuccess(result);
                }
                else {
                    // Response object has a result, but not a result we expect.
                    this._displayErrorDialog();
                }
            }
        }

        args[0].data || (args[0].data = {});
        args[0].data.form = this._parentForm;
        RightNow.Event.fire('evt_formButtonSubmitResponse', args[0]);
    },

    /**
     * Deals with a successful sendForm response.
     * @param  {object} result Result from response object
     */
    _handleFormResponseSuccess: function(result) {
		
        this._formSubmitFlag.set("checked", true);

        if (this.data.attrs.label_on_success_banner) {
			
            RightNow.UI.displayBanner(this.data.attrs.label_on_success_banner, { focusElement: this._formButton }).on('close', function() {
                this._confirmOnNavigate(result);
            }, this);
            return;
        }
        this._confirmOnNavigate(result);
    },


    /**
     * Deals with errors in the sendForm response.
     * @param  {Object} responseObject Response Object from the server
     * @return {Boolean}                True if there's an error that was dealt with
     *                                  False if no errors were found
     */
    _handleFormResponseFailure: function(responseObject) {
		
        if (!responseObject) {
            // Didn't get any kind of a response object back; that's... unexpected.
            this._displayErrorDialog(RightNow.Interface.getMessage("THERE_PROB_REQ_ACTION_COULD_COMPLETED_MSG"));

            return true;
        }
        if (responseObject.errors) {
            // Error message(s) on the response object.
            var errorMessage = "";
            this.Y.Array.each(responseObject.errors, function(error) {
                errorMessage += "<div><b>" + error.externalMessage + "</b></div>";
            });
            this._errorMessageDiv.append(errorMessage);
            this._onFormValidationFail();

            return true;
        }
        if (!responseObject.result) {
            // Response object doesn't have a result or errors on it.
            this._displayErrorDialog();

            return true;
        }

        return false;
    },

    /**
     * Given the sendForm result, redirects to the next page.
     * @param  {Object} result Result from response object
     */
    _navigateToUrl: function(result) {
		
        var url;
        if (result.redirectOverride) {
            url = result.redirectOverride + result.sessionParam;
        }
        else if (this.data.attrs.on_success_url) {
            var paramsToAdd = '';
            this.Y.Object.each(result.transaction, function(details) {
                if (details.key) {
                    paramsToAdd += '/' + details.key + '/' + details.value;
                }
            });

            if (paramsToAdd) {
                url = this.data.attrs.on_success_url + paramsToAdd + result.sessionParam;
            }
            else {
                var sessionValue = result.sessionParam.substr(result.sessionParam.lastIndexOf("/") + 1);
                if(!sessionValue && this.data.js.redirectSession)
                    sessionValue = this.data.js.redirectSession;
                url = RightNow.Url.addParameter(this.data.attrs.on_success_url, 'session', sessionValue);
            }
        }
        else {
            url = window.location + result.sessionParam;
        }

        var precharsurveypage=String(window.location);  
		var exploded_url= precharsurveypage.split("/");
		var precharsurveypageindex=exploded_url.indexOf("prechatsurvey");
		if(this.data.js.chat_platform == 2 && precharsurveypageindex!=-1){
			window.open(url,'_blank');
		}else{
        	RightNow.Url.navigate(url + this.data.attrs.add_params_to_url);
		}
    },

    /**
     * Shows a message dialog before redirecting if a success url is defined.
     * @param {Object} result Result from response object
     */
    _confirmOnNavigate : function(result){
			
		 	var url=String(window.location);  
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex=exploded_url.indexOf("facebooksurvey");
			var smsindex=exploded_url.indexOf("smssurvey");
            var callmenowindex=exploded_url.indexOf("callmenow");
			if(index!=-1)
			var checked_channel = 1529;
			else
			{
				if(fbindex!=-1)
					var checked_channel = 1532;
				else if(smsindex!=-1)
					var checked_channel = 1621;	
                else if(callmenowindex!=-1)
                    var checked_channel = 1131;    		    	
				else	
					var checked_channel = document.querySelector('input[name="channel"]:checked').value;
			}
		 if(checked_channel=="1530")
		 {
			
				var incident_ref_no=result['transaction']['incident']['value'];
				if(document.getElementById('hide-for-email-confirm-popup').style.display=="block")
				{
					document.getElementById('hide-for-email-confirm-popup').style.display="none";
					document.getElementById('after-submit-email').style.display="block";
					document.getElementById('doc-title').style.display="none";
					document.getElementById('email-title').style.display="none";
					document.getElementById('email-conf-title').style.display="none";
					var div = document.getElementById('after-submit-email');
					div.innerHTML += "<div class='email-conf-title'><h2>Your Request Has Been Submitted</h2></div><div class='email-conf-cont'><div>Thanks for reaching out to Beachbody. We make every effort to reply to emails within 4 hours.</div><div> If your request comes in after 5pm PT we will reply the next morning. </div><div>You may use this reference number for follow up:&nbsp;<b>"+incident_ref_no+"</b></div></div>";
				
				//this.checkvalidation="0";
				//this._toggleClickListener(true);
				document.getElementById("hidden-channel-value").value="redirect_from_email";
				  
				}  
		
	    }
		if(checked_channel=="1885")
		 {
			
				var incident_ref_no=result['transaction']['incident']['value'];
				if(document.getElementById('hide-for-email-confirm-popup').style.display=="block")
				{
					document.getElementById('hide-for-email-confirm-popup').style.display="none";
					document.getElementById('after-submit-email').style.display="block";
					document.getElementById('email-title').style.display="none";
					document.getElementById('email-conf-title').style.display="none";
					document.getElementById('doc-title').style.display="none";
					var div = document.getElementById('after-submit-email');
					div.innerHTML += "<div class='email-conf-title'><h2>Your Document Has Been Submitted</h2></div><div class='email-conf-cont'><div>We will review your document and email you within two business days.</div><div> You may use this reference number for follow up:&nbsp;<b>"+incident_ref_no+"</b></div></div>";
				
				//this.checkvalidation="0";
				//this._toggleClickListener(true);
				document.getElementById("hidden-channel-value").value="redirect_from_email";
				  
				}  
		
	    }
		if(checked_channel=="1532")//facebook
		{
			this.checkvalidation="0";
			this._toggleClickListener(true);
		}
		
		
        if (this.data.attrs.on_success_url !== 'none') {
			
            if (this.data.attrs.label_confirm_dialog !== '') {
                // Either create confirmation dialog...
                RightNow.UI.Dialog.messageDialog(this.data.attrs.label_confirm_dialog, {
                    exitCallback: {
                        fn: function() { this._navigateToUrl(result); },
                        scope: this
                    },
                    width: '250px'
                });
            }
            else {
                // ...or go directly to the next page.
                if(this.Y.Lang.trim(this.data.attrs.on_success_url) !== '') {
                   this._navigateToUrlFlag = true;
                }
                this._navigateToUrl(result);
            }
        }
    },

    /**
     * Turns loading indicators off,
     * turns back on the click listener,
     * and clears the error div.
     */
    _resetFormForSubmission: function() {
		
        this._navigateToUrlFlag = false;
        this._removeFormErrors();
        this._resetFormButton();
    },

    /**
     * Triggered when the form is updated by the dynamic forms API. If the error
     * div is now empty, hide it from the page.
     */
    _onFormUpdated: function() {
		
        if(this._errorMessageDiv.all('[data-field]').size() === 0) {
            this._errorMessageDiv.addClass("rn_Hidden").set("innerHTML", "");
        }
    },

    /**
     * Handler for the `responseError` form event.
     * If any non-HTTP 200 OK response is received, display a generic error
     * message and reset the form for resubmission.
     * The event object's `data` property contains the full AJAX response object
     * for the request.
     */
    _onErrorResponse: function(response) {
		
        this._displayErrorDialog(response.suggestedErrorMessage || RightNow.Interface.getMessage("THERE_PROB_REQ_ACTION_COULD_COMPLETED_MSG"));
        this._resetFormButton();
    },

    /**
     * Turns loading indicators off and
     * turns back on the click listener.
     */
    _resetFormButton: function() {
		
        if(this._navigateToUrlFlag) {
            return;
        }
        this._toggleLoadingIndicators(false);   //false
        this._toggleClickListener(false);        //true
    },

    /**
     * Clears out the error div.
     */
    _removeFormErrors: function() {
		
        this._errorMessageDiv.addClass("rn_Hidden").setHTML("");
    },

    /**
     * Displays a generic error dialog.
     * @param {string=} message Error message to use; if not supplied
     * a generic 'Error - please try again' message is displayed
     */
    _displayErrorDialog: function(message) {
		
        RightNow.UI.Dialog.messageDialog(message || RightNow.Interface.getMessage('ERROR_PAGE_PLEASE_S_TRY_MSG'), {icon : "WARN"});
    },

    /**
     * Hides / shows the loading icon and status message.
     * @param {Boolean} turnOn Whether to turn on the loading indicators (T),
     * remove the loading indicators (F)
     */
    _toggleLoadingIndicators: function(turnOn) {
		
        this._formButton.setHTML((turnOn) ? this.data.attrs.label_submitting_message : this.data.attrs.label_button)
                        .toggleClass('rn_Loading', turnOn);
    },

    /**
    * Enables / disables the form submit button and adds / removes its onclick listener.
    * @param {Boolean} To enable or disable the button
    */
    _toggleClickListener: function(enable) {
		
		if(this.checkvalidation=="1")
		{
			enable=false;
		}
		else if(this.checkvalidation=="0")
		{
			enable=true;
		}
        this._formButton.set("disabled", !enable);
        this._requestInProgress = !enable;
        this.Y.Event[((enable) ? "attach" : "detach")]("click", this._onButtonClick, this._formButton, this);
        }
        
		
		//jithin
		
		
		
		
		
		
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	test: function() {

    },
	_onBeforeAjaxRequest: function(type, args)
	
	{
		if( document.querySelector('input[name="channel"]:checked'))
		{
			var checked_channel = document.querySelector('input[name="channel"]:checked').value;
		}
		else
		{
			var url=String(window.location);  
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("prechatsurvey");
			var fbindex=exploded_url.indexOf("facebooksurvey");
			var smsindex=exploded_url.indexOf("smssurvey");
            var callmenowindex=exploded_url.indexOf("callmenow");
            
			if(index!=-1)
			var checked_channel = 1529;
			if(fbindex!=-1)
			var checked_channel = 1532;
			if(smsindex!=-1)
			var checked_channel = 1621;
            if(callmenowindex!=-1)
			var checked_channel = 1131;           
					
		}
		
		if(checked_channel=="1529")
			{
		        if(args[0].url == "/ci/ajaxRequest/sendForm" && args[0].scope.instanceID == this.instanceID)
				{
					if(this.data.js.chat_platform == 1){
				    //args[0].url = "/cc/ajaxCustom/submit_chat_ajax";
					args[0].url = "/cc/bbresponsivecontroller/submit_chat_ajax";
					var launch_width = this.data.attrs.launch_width;
					var launch_height = this.data.attrs.launch_height;
					var leftPos = (screen.width / 2) - (launch_width / 2);
					var topPos = (screen.height / 2) - (launch_height / 2);
					var url = this.data.attrs.chat_redirection;
										
					//this.chatWindow = window.open(url, 'chat_landing', 'status=1,toolbar=0,menubar=0,location=0,resizable=1,titlebar=0' + ',height=' + launch_height + 'px,width=' + launch_width + 'px,left=' + leftPos + ',top=' + topPos);
					//this.chatWindow = window.open(url);
					
					this._toggleClickListener(false);
					this._toggleLoadingIndicators(true);
					var x = JSON.stringify($('#hidden_form').serializeArray());
					
					$.ajax('/cc/bbresponsivecontroller/ghostchatsubmitlog', {
					type: 'POST',  // http method
					async: false,
					data: { text: x },  // data to submit
						success: function (response) { 
						}
					});
					
					document.getElementById("hidden_form").submit();
					}else{
						this.data.attrs.on_success_url = "/app/chat/nice_chat";
						args[0].url = "/cc/bbresponsivecontroller/nice_chat/"+this.catid; 
						this._toggleLoadingIndicators(true);
					}
			    }
		    }
			
		if(checked_channel=="1530")//email
			{
				if(args[0].url == "/ci/ajaxRequest/sendForm")
				{
					args[0].url = "/cc/bbresponsivecontroller/emailsubmit/"+this.catid;  
					this._toggleLoadingIndicators(true);
				}
			}
		if(checked_channel=="1885")//doc
			{
				if(args[0].url == "/ci/ajaxRequest/sendForm")
				{
					args[0].url = "/cc/bbresponsivecontroller/docsubmit/"+this.catid;  
					this._toggleLoadingIndicators(true);
				}
			}
	    if(checked_channel=="1532")//facebook
			{
				if(args[0].url == "/ci/ajaxRequest/sendForm")
				{
					this.data.attrs.on_success_url = "/app/contactus_support_facebook";
					args[0].url = "/cc/bbresponsivecontroller/fb/"+this.catid; 
					this._toggleLoadingIndicators(true);
					//window.location="https://faq.beachbody.com/app/responsivebb/home";
				}
			}
		if(checked_channel=="1621")//SMS
			{
				var urlparam=this.catid+","+this.top_parent[0];
				if(args[0].url == "/ci/ajaxRequest/sendForm")
				{
					this.data.attrs.on_success_url = "/app/smssurvey";
					args[0].url = "/cc/bbresponsivecontroller/sms/"+urlparam; 
					this._toggleLoadingIndicators(true);
					//window.location="https://faq.beachbody.com/app/responsivebb/home";
				}
			}	
            
                   //call me now     
                   if(checked_channel=="1131")//Call me now
                   {
	
                       if(args[0].url == "/ci/ajaxRequest/sendForm" && args[0].scope.instanceID == this.instanceID)
                       {

                           if(this.data.js.chat_platform == 1){
							   						   console.log("hgggggggg");
                           //args[0].url = "/cc/ajaxCustom/submit_chat_ajax";
                           args[0].url = "/cc/bbresponsivecontroller/submit_chat_ajax";
                           var launch_width = this.data.attrs.launch_width;
                           var launch_height = this.data.attrs.launch_height;
                           var leftPos = (screen.width / 2) - (launch_width / 2);
                           var topPos = (screen.height / 2) - (launch_height / 2);
                           var url = this.data.attrs.chat_redirection;
                                               
                           //this.chatWindow = window.open(url, 'chat_landing', 'status=1,toolbar=0,menubar=0,location=0,resizable=1,titlebar=0' + ',height=' + launch_height + 'px,width=' + launch_width + 'px,left=' + leftPos + ',top=' + topPos);
                           //this.chatWindow = window.open(url);
                           
                           this._toggleClickListener(false);
                           this._toggleLoadingIndicators(true);
                           var x = JSON.stringify($('#hidden_form').serializeArray());
                           
                           $.ajax('/cc/bbresponsivecontroller/ghostchatsubmitlog', {
                           type: 'POST',  // http method
                           async: false,
                           data: { text: x },  // data to submit
                               success: function (response) { 
                               }
                           });
                           
                           document.getElementById("hidden_form").submit();
                           }else{
							   console.log("hhghghghghghhghghgh");
                               this.data.attrs.on_success_url = "/app/nice_call";
                               args[0].url = "/cc/bbresponsivecontroller/nice_call/"+this.catid; 
                             //  args[0].url = "/cc/CallMeNowCache/cache/"+this.catid; 
                               this._toggleLoadingIndicators(true);
                           }
                       }
                   }
               //call me now     
            
	}
});