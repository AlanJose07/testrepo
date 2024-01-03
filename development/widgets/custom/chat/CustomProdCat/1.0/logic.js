RightNow.namespace('Custom.Widgets.chat.CustomProdCat');
Custom.Widgets.chat.CustomProdCat = RightNow.Widgets.ProductCategoryInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProductCategoryInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			this._inputField = document.getElementById("rn_"+this.instanceID+"_Category_Button");
			RightNow.Event.subscribe("evt_getcategory", this._onResponseReceived, this);
        },
		
		selectNode: function(node) {
				
		this._selectedNode = node;
        this._currentIndex = this._selectedNode.index;
        this._selected = true;
        //get next level if the node hasn't loaded children yet, isn't expanded, and isn't the 'No Value' node
        //or if product linking is on and this is the product (regardless of level)
        
        
            this._errorLocation = "";
            //this._checkRequiredLevel();
        
        this.displaySelectedNodesAndClose(true);
        

        return false;
		
		},

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
	
	_onResponseReceived: function(type,args)
{

	var cat_label =args[0].data.value;
	var x = this.tree._tree._nodes;
	for(var i=1;i<=x.length-1;i++)
	{
		if(this.tree._tree._nodes[i].label == cat_label)
		{
			var index = this.tree._tree._nodes[i].index;
			var id=this.tree._tree._nodes[i].hierValue;	
		}
		
	}

		
		//var node=this.tree._getSelectedNode();
		var node=this.tree.selectNodeWithValue(id);
		this.selectNode(node);			
	    
		
	
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});