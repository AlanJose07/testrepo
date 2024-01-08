RightNow.namespace('Custom.Widgets.Chat_Hidden_Fields.CategoryInput');
Custom.Widgets.Chat_Hidden_Fields.CategoryInput = RightNow.Widgets.ProductCategoryInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProductCategoryInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			var url=String(window.location);
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("catid");
			this.top_parent= exploded_url[index+1];
			RightNow.Event.subscribe("evt_submitFormRequestForChat", this._getfieldvalues, this);
        }

        /**
         * Overridable methods from ProductCategoryInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _initializeHint: function()
        // buildPanel: function ()
        // _resetProductCategoryMenu: function()
        // _updatePermissionedHierData: function (dataType)
        // displaySelectedNodesAndClose: function(focus, fireSelectionEvent)
        // selectNode: function(node)
        // getSubLevelRequest: function (expandingNode)
        // getSubLevelRequestEventObject: function(expandingNode)
        // getSubLevelResponse: function(type, args)
        // _setButtonClick: function()
        // _onValidate: function(type, args)
        // _createHintElement: function(visibility)
        // _toggleHint: function(hideOrShow)
        // _realignHint: function(delay)
        // swapLabel: function(container, requiredLevel, label, template)
        // updateRequiredLevel: function(evt, constraint)
        // _checkSelectionErrors: function()
        // _removeErrorMessages: function()
        // _displayErrorMessage: function(message, currentNode)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	_getfieldvalues: function()
	{
          
	}
});