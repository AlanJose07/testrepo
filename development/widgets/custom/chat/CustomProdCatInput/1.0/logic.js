var msgshow;
RightNow.namespace('Custom.Widgets.chat.CustomProdCat');
Custom.Widgets.chat.CustomProdCatInput = RightNow.Widgets.ProductCategoryInput.extend({ 
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
			RightNow.Event.subscribe("evt_showmsg",this._hide,this);
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
 _checkSelectionErrors: function() {
			
			
        var currentNode = this.tree.getSelectedNode(),
            currentDepth = (currentNode ? currentNode.depth : 0) + 1,
            noErrorsFound = true;

        this._removeErrorMessages();
        this._notRequiredDueToProductLinking = false;

        if (this.data.js.linkingOn && this.data.js.data_type === "Category" && this._linkedCategorySubset) {
            // If there's some subset of categories that have been loaded then
            // allow submission if either there's only a single 'no value' node...
            if (this.tree.getNumberOfNodes() === 1) {
                this._notRequiredDueToProductLinking = true;
            }
        }

        if (this.data.attrs.required_lvl || !this.userHasFullProdcatPermissions()) {
            if (!this.tree) {
                this.buildTree();
            }

            // Don't allow submission if nothing is selected or 'no value' node is selected
            // or non-leaf/still-loading node not at the required depth is selected
            if (!this._notRequiredDueToProductLinking &&
                    (!currentNode || !currentNode.value ||
                    ((!currentNode.loaded || currentNode.hasChildren) &&
                    (currentDepth < this.data.attrs.required_lvl)))
                ) {
                var message = (!currentNode || !currentNode.value) ? this.data.attrs.label_nothing_selected : this.data.attrs.label_required;
				if(msgshow=="true")
				{
					
                this._displayErrorMessage(message, currentNode);
                noErrorsFound = false;
				}
            }
        }

        if (currentNode && currentNode.value && !this.checkPermissionsOnNode(currentNode.value)) {
			if(msgshow=="true")
				{
					
            this._displayErrorMessage(this.data.attrs.label_not_permissioned, currentNode);
            noErrorsFound = false;
				}
        }

        return noErrorsFound;
    },
	
	 _setButtonClick: function()
    {
        var hierValues = [],
            labelChain = this.tree.get("labelChain"),
            valueChain = this.tree.get("valueChain");

        if (valueChain.length === 0 || valueChain[0] === 0) {
            // Nothing selected
            if (!this._errorMessageDiv) {
                this._errorMessageDiv = this.Y.Node.create("<div class='rn_MessageBox rn_ErrorMessage'/>");
                this.Y.one(this.baseSelector).prepend(this._errorMessageDiv);
            }
            this._errorMessageDiv.setHTML("<b><a href='javascript:void(0);' onclick='document.getElementById(\"" + this.displayField.get('id') + "\").focus(); return false;'>" +
                this.data.attrs.label_nothing_selected + "</a></b>");
           // this._errorMessageDiv.prepend("<h2>" + RightNow.Interface.getMessage("ERROR_LBL") + "</h2>");
            //this._errorMessageDiv.one("h2").setAttribute('role', 'alert');
            RightNow.UI.show(this._errorMessageDiv);
            var errorLink = this._errorMessageDiv.one('a');
            if (errorLink) {
                errorLink.focus();
            }
            return;
        }

        if (!this._checkSelectionErrors()) {
            return;
        }

        //collect node values: work back up the tree
        RightNow.UI.hide(this._errorMessageDiv);

        for(var i = 0; i < labelChain.length; i++)
            hierValues[i] = {"id" : valueChain[i], "label" : labelChain[i]};

        this.tree.resetSelectedNode();
        this.displaySelectedNodesAndClose(false, false);

        this._eo.data.hierSetData = hierValues;
        this._eo.data.id = hierValues[hierValues.length - 1].id;
        this._eo.data.f_tok = this.data.js.f_tok;

        RightNow.Event.fire("evt_menuFilterSelectRequest", this._eo);
    },

	
	  _displayErrorMessage: function(message, currentNode) {
        //indicate the error
		
		
		
			message="All fields required";
			
        this.displayField.addClass("rn_ErrorField");

        if(this.requiredLabel) {

            this.requiredLabel.replaceClass('rn_Hidden', 'rn_Required');
        }

        message = (message.indexOf("%s") > -1) ?
            RightNow.Text.sprintf(message, currentNode.label) :
            message;

        //write out the required label
        if (this.errorLabel) {
            this.errorLabel.setHTML(message).replaceClass('rn_Hidden', 'rn_ErrorLabel');
        }

        var label = this.data.attrs.label_error || this.data.attrs.label_input;
        //report error on common form button area
        if (this._errorLocation) {
            var commonErrorDiv = this.Y.one('#' + this._errorLocation);
            if (commonErrorDiv){
                commonErrorDiv.append(message);
            }
        }
        //if the accessible dialog exists and is open, add the error message to it
        if (this.dialog) {
            this.dialog.addErrorMessageForValue(message, currentNode.value);
        }
        this._realignHint();
		
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
_hide:function(evt,args)
{
	console.log(args[0].data.value);
	if(args[0].data.value=="pass")
	msgshow="true";
	else
	msgshow="false";
	
	
},
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});