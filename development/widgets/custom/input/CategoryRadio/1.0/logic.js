RightNow.namespace('Custom.Widgets.input.CategoryRadio');
Custom.Widgets.input.CategoryRadio = RightNow.Field.extend({ 
    /**
     * Widget constructor.
     */
	 overrides: {
    constructor: function() {
		var attrs = this.data.attrs;
			var radioitems_count = this.data.js.radioitems_count;
			/*
			*Gets the count of item in the field
			*Generates the ID 
			*/
		
			this._inputSelector="#rn_"+this.instanceID;
			var radio_button_inputs=this._inputSelector + "_"+(radioitems_count-1);
			var radio_input;
			
			for(var i=radioitems_count-2;i>=0;i--)
			{
				radio_input=this._inputSelector + "_" + i;
				//alert(radio_input);
				radio_button_inputs =radio_button_inputs+", "+radio_input;
				//alert(radio_button_inputs);
			}
			
			
			this.input = this.Y.all(radio_button_inputs);
			
				
            if(!this.input) return;

            if(attrs.hint && !attrs.hide_hint && !attrs.always_show_hint)
                this._initializeHint();

            if(attrs.initial_focus && this.input) {
                if(this.data.js.type === "Boolean" && this.input[0] && this.input[0].focus)
                    this.input[0].focus();
                else if(this.input.focus)
                    this.input.focus();
            }

            if (attrs.validate_on_blur && attrs.required) {
                this.Y.Event.attach('blur', this.blurValidate, this.input instanceof this.Y.NodeList ? this.input.item(1) : this.input, this);
            }

			this._editSelectDiv = "rn_" + this.instanceID + "_EditSelection";
			this._formErrorLocation = null;
			this._editSelectionIsVisible = false;
			
			var FieldName = this.data.js.name;
		  
	
			
					this.input.on("click", this.getcategory, this);//Checks if click event occurs for Reason For Cancellation field
					
				
				//this.parentForm().on("submit", this.onValidate, this);

	}

    },
	 getcategory: function() {
		 var rates = document.getElementsByName("cat_radio");
				var rate_value;
				for(var i = 0; i < rates.length; i++){
				if(rates[i].checked){
				rate_value = rates[i].value;
				//alert(rate_value);
				}
			}
			
			 var eventObject = new RightNow.Event.EventObject(this, {data: {value: rate_value}});
        	RightNow.Event.fire("evt_getcategory", eventObject); 
			
			//alert(document.getElementById("rn_ProductCategoryInput_11_Category_Button").value = rate_value) ;
		},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});