RightNow.namespace('Custom.Widgets.input.ShippingAddressSelectionInputCustom');
Custom.Widgets.input.ShippingAddressSelectionInputCustom = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			this._inputSelector = this.baseSelector + "_" + this.data.js.name;

			this._hasErrors = false;
			
			this._editSelectDiv = "rn_" + this.instanceID + "_EditSelection";
			this._formErrorLocation = null;
			this._editSelectionIsVisible = false;
			
			
			var FieldName = this.data.js.name;
			
			
			if(FieldName === "shippingaddress")
			{
				
				 this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);	
				 this.input.on("change", this._onChange, this);
	
			}
			
			 RightNow.Event.subscribe("evt_editSelectionVisible", this._onEditSelectionVisible, this);
             RightNow.Event.subscribe("evt_editSelectionHidden", this._onEditSelectionHidden, this);
			 RightNow.Event.subscribe("evt_oneTimeHide", this._onOneTimeHide, this);//this field gets hidden if user selects they want a 1 time shipment.
			
			
        },

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        onValidate: function(type, args) 
		{
			
        var eo = this.createEventObject(),
            errors = [];

        this.toggleErrorIndicator(false);
       
		/* code added by lage to handle custom fields */
		this._clearErrors();
		this._hasErrors = false;
		this._formErrorLocation = args[0].data.error_location;
		
		//var eoData = new RightNow.Event.EventObject();
		
        eo.data = { 
            "name": "priv_note",
            "value": this._getValue(),
            "required": false
        }; 
		
		
		
		if(this._inputField.value==1)
		{
			//var GetValueResult = this._getValue();
			
			if(this._hasErrors)
			{
				 RightNow.Event.fire("evt_formFieldValidationFailure", eo);
				
				 return false;
			}
			
		}
		
		/* code added by lage to handle custom fields ends here*/
		
        if(!this.validate(errors)) 
		{
            //this.displayError(errors,this._inputField,this.data.attrs.label_input,);
            RightNow.Event.fire("evt_formFieldValidationFailure", eo);
            return false;
        }
        
        RightNow.Event.fire("evt_formFieldValidationPass", eo);
        return eo;
      }
       ,
	    displayError: function(errorMessage, _inputField, _label, _labelID) 
		{
		
		var commonErrorDiv = document.getElementById(this._formErrorLocation);
			
     
       if (commonErrorDiv) 
		{
            RightNow.UI.Form.errorCount++;
            if (RightNow.UI.Form.chatSubmit && RightNow.UI.Form.errorCount === 1)
                commonErrorDiv.innerHTML = "";

            var errorLink = "<div><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + "rn_" + this.instanceID + _labelID +
                "\").focus(); return false;'>" + _label + " ";

            if (errorMessage.indexOf("%s") > -1)
                errorLink = RightNow.Text.sprintf(errorMessage, errorLink);
            else
                errorLink = errorLink + errorMessage;

            errorLink += "</a></b></div> ";
            commonErrorDiv.innerHTML += errorLink;
        }
		
        //this.toggleErrorIndicator(true);
		
		this.Y.one('#rn_' + this.instanceID + _labelID ).addClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + _labelID + '_Label').addClass('rn_ErrorLabel');
		
		this._hasErrors = true;
		
    },
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	 /**
    * Clear all the error classes
    */
    _clearErrors: function () 
	{
        this._hasErrors = false;
		this.Y.one('#rn_' + this.instanceID + "_first_name" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_first_name_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_last_name" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_last_name_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_address" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_address_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_city" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_city_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_province" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_province_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_zip" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_zip_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_country" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_country_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_phone" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_phone_Label" ).removeClass('rn_ErrorLabel');
		this.Y.one('#rn_' + this.instanceID + "_email" ).removeClass('rn_ErrorField');
		this.Y.one('#rn_' + this.instanceID + "_email_Label" ).removeClass('rn_ErrorLabel');
		
	
    },

	_getValue: function () {
		
		
        //select value
        if (this._inputField.value == 0) 
		{
            return "No Shipping Address Change.";
        }
		

        // Change Shipping Address
        var retChar = "\n";
        var errMsg = " is required";
        var _input = null;
        var value = "Change Shipping Address." + retChar + retChar;

        _input = document.getElementById("rn_" + this.instanceID + "_first_name");
        value += "First Name: " + _input.value + retChar;
		
        if (_input.value == "") 
		{ 
            this.displayError(errMsg, _input, "First Name", "_first_name");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_last_name");
        value += "Last Name: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "Last Name", "_last_name");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_address");
        value += "Address: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "Address", "_address");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_apt");
        value += "Apt., Suite, etc.: " + _input.value + retChar;

        _input = document.getElementById("rn_" + this.instanceID + "_city");
        value += "City: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "City", "_city");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_province");
        value += "State/Province: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "State/Province", "_province");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_zip");
        value += "ZIP/Postal code: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "ZIP/Postal code", "_zip");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_country");
        value += "Country: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "Country", "_country");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_phone");
        value += "Phone number: " + _input.value + retChar;
        if (_input.value == "") {
            this.displayError(errMsg, _input, "Phone number", "_phone");
        }

        _input = document.getElementById("rn_" + this.instanceID + "_email");
        value += "Contact Email Address: " + _input.value + retChar;
        if (_input.value == "") 
		{
            this.displayError(errMsg, _input, "Contact Email Address", "_email");
        }

        return value;
    },
	
	_onChange: function (type, args) 
	{
		//alert(this._inputField.value + "  By onchange Function ");
		
        if (this._inputField.value == 1) 
		{         // Change Shipping Date
            this.Y.one("#"+this._editSelectDiv).removeClass("rn_Hidden");
			this._editSelectionIsVisible = true;
            RightNow.Event.fire("evt_shippingVisibilityChange", 1);
        } else 
		{
			this.Y.one("#"+this._editSelectDiv).addClass("rn_Hidden");
            this._editSelectionIsVisible = false;
            RightNow.Event.fire("evt_shippingVisibilityChange", 0);
        }
        // Remove pre-existing error messages, if any
        
		
		
       
    },
	
	 _onOneTimeHide: function(type,args)
	 {
    	   
    	    if (args[0].data.HideAddress)
			{
    	    	    this._inputField.value = 0; //force set to "No Changes"
    	    	    this._onChange();//send it through its normal way of hiding
    	    	 
					this.Y.one('#shippingdiv').addClass('rn_Hidden');
					
    	    }else{
    	    	   
				   this.Y.one('#shippingdiv').removeClass('rn_Hidden');
    	    }
    	    
    },
	
});