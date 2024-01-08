RightNow.namespace('Custom.Widgets.input.countrySelectionInput');
Custom.Widgets.input.countrySelectionInput = RightNow.Widgets.SelectionInput.extend({ 
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
			
			if(FieldName === "Contact.Address.Country")
			{
				//alert("KKKOOOIII");
				//console.log(this.data);
				//console.log("yogesh");
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
       RightNow.Event.fire("evt_getCountryFields", eventObject); 
		
		/*for shakology flavour*/
		 fireResponse = function(response, eventObject) {
			 //console.log(fireResponse);
			 //console.log(response);
                RightNow.Event.fire("evt_flavourResponse", response, eventObject);
            };
			
		 fireResponsecurrent = function(response, eventObject) {
			 //console.log(fireResponse);
			 //console.log(response);
                RightNow.Event.fire("evt_currentflavourResponse", response, eventObject);
            };
			

            var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
			
			//console.log(eventObject.data);
			
			/*RightNow.Ajax.makeRequest('/cc/AjaxCustom1/getFlavour', {country_id:value}, {successHandler: this.fireResponse, scope: this, data: eventObject, json: true}); */
			
			RightNow.Ajax.makeRequest('/cc/AjaxCustom1/getFlavour', {country_id:value}, {
                    successHandler: function(response) {
                        fireResponse(response, eventObject);						
                    },
                    scope: this,
                    json: true,
                    type: "POST"
                }); 
			
			
			RightNow.Ajax.makeRequest('/cc/AjaxCustom1/getCurrentFlavour', {country_id:value}, {
                    successHandler: function(response) {
                        fireResponsecurrent(response, eventObject);						
                    },
                    scope: this,
                    json: true,
                    type: "POST"
                }); 
						
		
		//console.log("KKOOII");
		//console.log(fireResponse);
	}
});

