RightNow.namespace('Custom.Widgets.input.SelectionInput_Country');
Custom.Widgets.input.SelectionInput_Country = RightNow.Widgets.SelectionInput.extend({ 
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
			var fieldName = this.data.js.name;
			if(fieldName === "Contact.Address.Country" || fieldName === "Contact.Address.StateOrProvince"){
       
              RightNow.Event.subscribe("evt_intlChecked", this._onIntlChecked, this);
			  
            }
        }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },
	
	
	_onIntlChecked: function(type, args){
        
		this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
        var Label = document.getElementById("rn_" + this.instanceID + "_Label");
        if (args[0].data.checked){
            this.data.attrs.required = false;
            this._inputField.value = "";
            this._inputField.disabled = true;
            this._inputField.style.opacity = .6;
            Label.innerHTML = Label.innerHTML.replace('<span class="rn_Required">*</span>',' ');
        }else{
            this.data.attrs.required = true;
            this._inputField.disabled = false;
            this._inputField.style.opacity = 1;
            Label.innerHTML = Label.innerHTML.concat('<span class="rn_Required">*</span>');
        }
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});