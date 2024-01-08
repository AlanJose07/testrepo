RightNow.namespace('Custom.Widgets.ResponsiveDesign.KeywordText');
Custom.Widgets.ResponsiveDesign.KeywordText = RightNow.Widgets.KeywordText.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.KeywordText#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			var styled = document.getElementById("rn_" + this.instanceID + '_Text');
            styled.setAttribute('data-hj-whitelist', 'display: block');
        }

        /**
         * Overridable methods from KeywordText:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onChange: function(evt)
        // _onGetFiltersRequest: function(type, args)
        // _setFilter: function()
        // _onChangedResponse: function(type, args)
        // _onResetRequest: function(type, args)
        // _decoder: function(value)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});