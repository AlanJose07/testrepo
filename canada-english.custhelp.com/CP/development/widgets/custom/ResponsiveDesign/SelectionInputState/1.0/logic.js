RightNow.namespace('Custom.Widgets.ResponsiveDesign.SelectionInputState');
Custom.Widgets.ResponsiveDesign.SelectionInputState = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
			
			if(FieldName === "Contact.Address.StateOrProvince")
			{
			//document.getElementById("state_province").value=this.data.attrs.label_input;
			RightNow.Event.subscribe("country_creditcard_selection", this.checkCountry, this);
			}
        }  

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // swapLabel: function(container, requiredness, label, template)
        // constraintChange: function(evt, constraint)
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
        // onStatusChanged: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	checkCountry: function(type, args) 
	{
		
		var id = args[0].data.country_id;
		
		RightNow.Ajax.makeRequest('/cc/AjaxCustom1/countrybasedstateorprovince', {country_id:id}, {
			    successHandler: function(response) {
				
				console.log(response);
				var widget_id=this._inputField;
				var selbox = this.Y.one(widget_id);
				this.Y.one(widget_id).get('options').remove();
				selbox.append("<option value=''>--</option>");
				for(i=0;i<response.length;i++)
				{
				   selbox.append("<option value='"+response[i].ID +"'>"+response[i].Name +"</option>");
				   selbox.set("selectedIndex", 0);
				}
				this._inputField.selectedIndex=0;
									
				},
				scope: this,
				json: true,
				type: "POST"
			});
		
		if(id==7)
		{
			this.input.set('value','');	
			this.data.attrs.required = false;
			var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			label.innerHTML=this.data.attrs.label_input;
			this.input.set('disabled',true);
		}
		else
		{
			 this.data.attrs.required = true;
			 var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			 label.innerHTML=this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			 this.input.set('disabled',false); 
		}
		
    }
});