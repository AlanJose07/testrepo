RightNow.namespace('Custom.Widgets.ResponsiveDesign.test');
Custom.Widgets.ResponsiveDesign.test = RightNow.Widgets.ChatLaunchButton.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatLaunchButton#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        }

        /**
         * Overridable methods from ChatLaunchButton:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _getReferrerUrl: function()
        // _openChatWindow: function()
        // _onFormValidated: function()
        // _showErrorMessage: function(errorMessage)
        // _addHiddenPostField: function(name, value)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});