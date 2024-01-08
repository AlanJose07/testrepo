RightNow.namespace('Custom.Widgets.ccc_form.customTextInputSSN_CCC');
Custom.Widgets.ccc_form.customTextInputSSN_CCC = RightNow.Widgets.TextInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {  
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID; 
			this.data = data;
			var fieldName = data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
			
			RightNow.Event.subscribe("hideoptions", this._resetAttrs, this);
			
			if(this.data.js.name == "Incident.CustomFields.c.last_four_ssn")
			{
			
				this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
				RightNow.Event.subscribe("evt_memberType_Changed", this._set_required_attribute, this);
				RightNow.Event.subscribe("country_changed", this._set_required_attribute, this);
				RightNow.Event.subscribe("evt_languagechanged", this._set_required_attribute_lang, this);
				
				RightNow.Event.subscribe("evt_getCountryFields", this.setLabel, this);
				RightNow.Event.subscribe("evt_change_attr_ssn", this._change_attr_ssn, this);
				
				
			}
			
        }

        /**
         * Overridable methods from TextInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // _displayError: function(errors, errorLocation)
        // _toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)
        // _toggleFormSubmittingFlag: function(event)
        // _blurValidate: function(event, validateVerifyField)
        // _validateVerifyField: function(verifyField, errors)
        // _checkExistingAccount: function()
        // _massageValueForModificationCheck: function(value)
        // _onAccountExistsResponse: function(response, originalEventObject)
        // onProvinceChange: function(type, args)
        // _initializeMask: function()
        // _createMaskArray: function(mask)
        // _getSimpleMaskString: function()
        // _compareInputToMask: function(submitting)
        // _showMaskMessage: function(error)
        // _setMaskMessage: function(message)
        // _showMask: function()
        // _hideMaskMessage: function()
        // _onValidateFailure: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	_change_attr_ssn:function(type, args) {
		  
		
		var value=args[0].data['memb_id'];
		
		if(value==771)
		{
			
		var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		labelnew.innerHTML="Last 4 digits of social security number "+"<span class='rn_Required'> *</span>";
		this.data.attrs.required=true;
			
		}
		else if(value==761)
		{
		
			this.data.attrs.required=false;
		
		}
		
		else if(value==""){
		
			this.data.attrs.required=false;
			
		}
		  
	
    },
	
	
	setLabel: function(type, args)
	{
		if (args[0].data.country_id == 1)
		{
			
			
		this.data.attrs.label_input = "Last 4 digits of social security number";
		document.getElementById("rn_" + this.instanceID + "_Label").innerHTML = "Last 4 digits of social security number *";
		}
		else if (args[0].data.country_id==2)
		{
			
		this.data.attrs.label_input = "Last 4 digits of social insurance number";
		document.getElementById("rn_" + this.instanceID + "_Label").innerHTML = "Last 4 digits of social insurance number *";
		}
	

	},
	_makeRequired: function(label,required,labelrequired)
	{
			
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label+"<span class='rn_Required'> *</span>";
			/*this.data.attrs.required=required;*/
			
			this.data.attrs.label_input=label;
			this.data.attrs.required=required;
			this.data.attrs.label_required=labelrequired;
	},
	
	_resetAttrs: function()
	{
			this.input.set('value','');
			this.data.attrs.required=false;
	},
	
	
	_set_required_attribute: function(type, args)
	{	
	   
	    var country_from_drop="null";
	    var country_id_value="null";
		var membertype_from_drop="null";
	   if(document.getElementsByName("Contact.Address.Country")[0].value!="")
		country_from_drop=document.getElementsByName("Contact.Address.Country")[0].value;
		if(document.getElementsByName("Incident.CustomFields.c.member_type_eng")[0].value!="")
		membertype_from_drop=document.getElementsByName("Incident.CustomFields.c.member_type_eng")[0].value;
	   
		var memb_id = args[0].data;
		if(memb_id==7)
	    country_id_value=memb_id;

		var req_eng="is required";
		var req_fre="est requis";
		var req_spa="es requerido";
		if(this.data.js.name == "Incident.CustomFields.c.last_four_ssn")
		{
			
		if(memb_id == 771 || membertype_from_drop==771)//Member Type = Coach English
		{	
		    if(country_id_value==7 || country_from_drop==7){
				
			this._makeRequired("Last 4 digits of Credit Card on file for BSF Fees",true,req_eng);}
			else{
				
			//this._makeRequired("Last 4 digits of credit card number",true,req_eng);	
			this._makeRequired("Last 4 digits of Credit Card on file for BSF Fees",true,req_eng);
			}
		}
		else if(memb_id == 760)//Member Type = Coach French    Les 4 derniers chiffres du numéro de carte de crédit
		{	
			//this._makeRequired("Les 4 derniers chiffres du numéro de carte de crédit",true,req_fre);
			this._makeRequired("4 derniers chiffres de la carte de crédit enregistrée pour vos frais de services du compte Coach",true,req_fre);
			
		}
		else if(memb_id == 762)//Member Type = Coach Spanish
		{	
			this._makeRequired("Los últimos 4 dígitos de la tarjeta de crédito que es utilizada para el pago de la tarifa de Servicio de Negocios",true,req_spa);
			
			//this._makeRequired("Los últimos 4 dígitos del número de tarjeta de crédito",true,req_spa);
			
		}
		
		else
		{   
			this._resetAttrs();
		}
		}
		
	},
		
		_set_required_attribute_lang: function(type, args)
	{	//alert("ent fn4");
		var lang_id = args[0].data;  
		
		if(this.data.js.name == "Incident.CustomFields.c.last_four_ssn")
		{
			this._resetAttrs();
		/*	if(lang_id == 744)//Language =  English
			{	
				this._resetAttrs();
							
			}
			else if(lang_id == 745)//Language =  French
			{	
				this._resetAttrs();
							
			}
			else if(lang_id == 746)//Language =  Spanish
			{	
				this._resetAttrs();
							
			}
			else{
				}*/
		}
	}
});