RightNow.namespace('Custom.Widgets.input.ComplaintCustomSelectionInput');
Custom.Widgets.input.ComplaintCustomSelectionInput = RightNow.Widgets.SelectionInput.extend({ 
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
			RightNow.Event.subscribe("evt_PCchosen_menu", this._getPackageDamageLocationNew, this);
            // Call into parent's constructor
            this.parent();
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
  _getPackageDamageLocationNew: function(data, obj) {
		
		
		
		if(obj[0].data.prod==1474 || obj[0].data.prod==1476)
		{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML="Location of Package Damage"+"<span class='rn_Required'> *</span>";
			this.data.attrs.required = true;
			document.getElementById("defect_location").style.display="block";
		}
		else
		{
			this.input.set('value','');
			this.data.attrs.required = false;
			document.getElementById("defect_location").style.display="none";
			
		}

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});