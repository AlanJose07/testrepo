RightNow.namespace('Custom.Widgets.input.SelectionInputHidden');
Custom.Widgets.input.SelectionInputHidden = RightNow.Widgets.SelectionInput.extend({ 
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
			
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = this.data.js.name;
			this._FieldName = FieldName;
		     
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			this.input = this.Y.one(this._inputSelector);
			
			
			if(this._FieldName=="Incident.CustomFields.c.flavor1")	
			{
				
				RightNow.Event.subscribe("evt_newFlavourSelected", this._onNewFlavourSelected, this);
			}
		     
			else if(this._FieldName=="Incident.CustomFields.c.ordermodtype")	
			{
				
				RightNow.Event.subscribe("evt_OrderModePassValue", this._onchangeordermodtype, this);
				
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
	
	_onNewFlavourSelected: function(type,args)
	{
		this._inputField.value = args;
		
	},

     _onchangeordermodtype: function(type,args)
	{
		if(args!="")
		{
		 this._inputField.value = args;
		}
	},


    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});