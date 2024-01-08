RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomSubmit');
Custom.Widgets.ResponsiveDesign.CustomSubmit = RightNow.Widgets.FormSubmit.extend({ 
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
		 
		 
    /**
     * Event handler for when form has been validated.
     */
	   _onFormValidated: function(type, args) {
		    
		   var consent_full_name = document.getElementById("consent_full_name").value;
		   
		   var consent_email = document.getElementById("consent_email").value;
		   
		   var consent_phone = document.getElementById("consent_phone").value;
		   
		   var consent_relationship = document.getElementById("consent_relationship").value;
		   	   
		   var flag = 1;
		   
		   var postfields = this.getValidatedFields();
		   
			for (var key in postfields) 
			{
				if(postfields[key].name == "Contact.CustomFields.c.consent_full_name")
					{
						var postconsent_full_name = postfields[key].value;
					}
				
				if(postfields[key].name == "Contact.CustomFields.c.consent_email")
					{
						var postconsent_email = postfields[key].value;
					}
					
				if(postfields[key].name == "Contact.CustomFields.c.consent_phone")
					{
						var postconsent_phone = postfields[key].value;
					}
					
				if(postfields[key].name == "Contact.CustomFields.c.consent_relationship")
					{
						var postconsent_relationship = postfields[key].value;
					}	
			}
			
			if(postconsent_full_name != consent_full_name || postconsent_email != consent_email || postconsent_phone != consent_phone || postconsent_relationship!= consent_relationship)
				flag = 1;
			
			else
				flag = 2;
		   
			
			if(flag == 2)
			{
				this._resetFormButton();
				this.displayErrorMessage('No se puede enviar el formulario sin ningún cambio de la información existente','authorized_party');
				return;
			}
			else
			{	
			document.getElementById('rn_errorlocation_coach').style.display="none";
			this._toggleLoadingIndicators(true);
			this.fire("send", this.getValidatedFields());
			}
			 
		},

    /**
     * Event handler for when form fails validation check.
     */
		_onFormValidationFail: function() {
			this.checkvalidation="0";
			document.getElementById('rn_errorlocation_coach').style.display="block";
			this._displayErrorMessages(this._errorMessageDiv);
			RightNow.Event.fire("evt_formValidateFailure", new RightNow.Event.EventObject(this));
		},
		
		 displayErrorMessage: function(message,id) {
            if (id === undefined) { id = ''; }
        	$('#'+id.replace(/\./g, '\\.')).addClass('rn_ErrorField');
            this._toggleLoadingIndicators(false);
            var errorMessage= "<div><b><a href='javascript:void(0)' onclick='document.getElementById(\""+id+"\").focus();'>"+message+"</a></b></div>";;
            this._errorMessageDiv.append(errorMessage);
            this._onFormValidationFail();
            this._resetFormButton();
        },
        		
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

	_onBeforeAjaxRequest: function(type, args)
	{		
				if(args[0].url == "/ci/ajaxRequest/sendForm")
				{
					var signature = document.getElementById("signature").value;
					var formData = JSON.parse(args[0].post.form);
					formData.push({name:'signature',value:signature});
					args[0].post.form = JSON.stringify(formData);
					args[0].url = "/cc/bbresponsivecontroller/coach_consent_submit";  
					this._toggleLoadingIndicators(true); 
					
				}	
	}
});