RightNow.namespace('Custom.Widgets.input.SubmitGDPR');
var customer_delete_data;
var isSelected;
var checked;
    
Custom.Widgets.input.SubmitGDPR = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			this._toggleClickListener(false);
			
			RightNow.Event.subscribe("evt_checkbox", this.checkbox_stage, this);
			RightNow.Event.subscribe("evt_customerdelete_changed", this.customerdeleteselected, this);
			RightNow.Event.subscribe("evt_selectbox", this.selectboxchecked, this);

			//this._formButton = this.Y.one(this.baseSelector + "_Button");
			//this.on("validation:fail", this.submitButton_clicked, this);
            //this.on("validation:pass", this.submitButton_clicked, this)
				//this.Y.one("#rn_QuestionSubmit_GDPR").on("submit",this.submitButton_clicked, this);
			this._formButton.on("click", this.submitButton_clicked, this);
			


        }

        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onButtonClick: function(evt)
        // _fireSubmitRequest: function()
        // _onFormValidated: function()
        // _onFormValidationFail: function()
        // _formSubmitResponse: function(type, args)
        // _onFormUpdated: function()
        // _onErrorResponse: function()
        // _displayErrorDialog: function(message)
        // _onFormTokenUpdate: function(type, args)
        // _enableFormExpirationWatch: function()
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
    },

    /**
     * Sample widget method.
     */
    submitButton_clicked: function(evt) {
		document.getElementById("rn_ErrorLocation_gdpr").style.display= "block";
    },
    

	/*checkbox_stage: function(type, args) {
		var checked=args[0].data.isChecked;
		
		
			this._toggleClickListener(checked);
		
	},*/
	
	customerdeleteselected: function(type, args) {
		this._toggleClickListener(false);
		document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;
		customer_delete_data=args[0].data.customer_delete_data;
		//alert(customer_delete_data);

	},
	selectboxchecked: function(type, args) {
		isSelected=args[0].data.isSelected;
		//this._toggleClickListener(isSelected);
		//alert(isSelected);
		//alert(customer_delete_data);
		if(customer_delete_data == "ok"){
			if( checked == true){
				this._toggleClickListener(isSelected);
			}	
		} else{
			this._toggleClickListener(isSelected);

		}


	},

	
	
	//added for checkbox disclaimer ends
	checkbox_stage: function(type, args) {
		checked=args[0].data.isChecked;
		
		if(customer_delete_data == "ok"){
			if( isSelected == true){
				this._toggleClickListener(checked);
			}	
		} else{
			this._toggleClickListener(checked);

		}

		//this._toggleClickListener(checked);
	},

	
	
});