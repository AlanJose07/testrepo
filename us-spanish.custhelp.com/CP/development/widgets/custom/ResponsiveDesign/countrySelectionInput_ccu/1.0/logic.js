RightNow.namespace('Custom.Widgets.ResponsiveDesign.countrySelectionInput_ccu');
Custom.Widgets.ResponsiveDesign.countrySelectionInput_ccu = RightNow.Widgets.SelectionInput.extend({ 
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
			
			//alert("constructor");
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
	
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			
			
			if(FieldName === "Contact.Address.Country")
			{
				
				this.data.attrs.required = true;
			//	 this._inputField = document.getElementById("rn_SelectionInput_6_Incident.CustomFields.c.member_type");
				  this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);	
				 // alert( this._inputField + "country");
				  //this.input.on("change", this.memberTypeChanged, this);
				 this.input.on("change", this.countrySelectChanged, this);
				//  alert( this.input + "country");
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

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	/*
	_onBeforeAjaxRequest: function(type, args)
	{
		if(args[0].url == "/ci/ajaxRequestMin/getCountryValues") {
		
			args[0].url = "/cc/AjaxCustom1/getFlavour";
		}
	}, */
	
	
	countrySelectChanged: function()
	{
      	var value = this.input.get("value");
	    var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
		var uri = String(window.location);
		var arr = uri.split('/');
		var lob_index = arr.indexOf("lob");
		var lob = arr[lob_index+1];
		
        RightNow.Event.fire("country_creditcard_selection", eventObject);
		
	
            var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
			
	}
});
