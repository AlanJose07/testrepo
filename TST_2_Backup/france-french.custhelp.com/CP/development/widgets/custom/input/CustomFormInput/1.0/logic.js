RightNow.namespace('Custom.Widgets.input.CustomFormInput');
Custom.Widgets.input.CustomFormInput = RightNow.Widgets.TextInput.extend({     /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            RightNow.Event.subscribe("evt_membertype_changed", this.validationReset, this);
            this.parent();
        }        /**
         * Overridable methods from TextInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */        // swapLabel: function(container, requiredness, label, template)        // setLabel: function(newLabel)        // reload: function(content, readOnly)        // _subscribeToFormValidation: function()        // constraintChange: function(evt, constraint)        // getVerificationValue: function()        // onValidate: function(type, args)        // _displayError: function(errors, errorLocation)        // toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)        // _toggleFormSubmittingFlag: function(event)        // _blurValidate: function(event, validateVerifyField)        // _validateVerifyField: function(errors)        // _checkExistingAccount: function()        // _massageValueForModificationCheck: function(value)        // _onAccountExistsResponse: function(response, originalEventObject)        // onProvinceChange: function(type, args)        // _initializeMask: function()        // _createMaskArray: function(mask)        // _getSimpleMaskString: function()        // _compareInputToMask: function(submitting)        // _showMaskMessage: function(error)        // _setMaskMessage: function(message)        // _showMask: function()        // _hideMaskMessage: function()        // _onValidateFailure: function()
    },
    validationReset:function(type,args){
        console.log(args);
        let inputFirstName = document.getElementsByName(`${this.data.attrs.name}`)[0];
		inputFirstName.classList.remove("rn_ErrorField");
		document.querySelector(`label[for="${inputFirstName.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    },    /**
     * Renders the `label.ejs` JavaScript template.
     */
    renderLabel: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.label}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },    /**
     * Renders the `labelValidate.ejs` JavaScript template.
     */
    renderLabelValidate: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.labelValidate}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});