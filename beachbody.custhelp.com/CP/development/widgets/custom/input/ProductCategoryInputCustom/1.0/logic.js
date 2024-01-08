RightNow.namespace('Custom.Widgets.input.ProductCategoryInputCustom');
Custom.Widgets.input.ProductCategoryInputCustom = RightNow.Widgets.ProductCategoryInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProductCategoryInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
			
			
			
			
            this.parent();
			this.instanceID = instanceID;
   			this.data = data;
  
   	var FieldName = data.js.name;
   
    this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
   
 		
			
        },
		
		
		
			

        /**
         * Overridable methods from ProductCategoryInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _initializeHint: function()
        // _buildMenuPanel: function()
        // _buildTree : function()
        // _levelOfNode: function(node)
        // _displayAccessibleDialog: function()
        // _toggleAccessibleView: function()
        // _getAccessibleTreeViewResponse: function(e, args)
        // _accessibleLinkClick: function(e)
        // _toggleProductCategoryPicker: function(e)
        // _getSelectedNodesMessage: function()
        // _getPropertyChain: function(property)
        // _displaySelectedNodesAndClose: function(focus)
		
		
		_displaySelectedNodesAndClose: function(focus)
    {
		
		
        var hierValues, description, descText;

        this._eo.data.value = this._currentIndex;
		
		
		if(this._checkRequiredLevel() && this.data.attrs.label_input == "Product")
		var i=this._getProdIDfromCurrentIndex();
		
		
		var server_time = this.data.js.server_time;
		var date = new Date(server_time);
		var seconds = date.getSeconds();
		var minutes = date.getMinutes();
		var hour = date.getHours();
		var year = date.getFullYear();
		var month = date.getMonth(); // beware: January = 0; February = 1, etc.
		var day = date.getDate();
		var dayOfWeek = date.getDay(); // Sunday = 0, Monday = 1, etc.
		var milliSeconds = date.getMilliseconds();
		
		if(i=="712")
       
	   	{	
		
			if(hour >= 6 && hour <18)
			{ 	
				if(dayOfWeek >=1 && dayOfWeek <=5 )
				{	
						if(document.getElementById("msgshow"))
						{
						document.getElementById("msgshow").style.display = "none";
						}
						if(document.getElementById("hidechatcustom"))
						{
						document.getElementById("hidechatcustom").style.display = "block";
						}
						if(document.getElementById("hidechat"))
						{
						document.getElementById("hidechat").style.display = "none";
						}
						
						if(document.getElementById("derm"))
						{
						document.getElementById("derm").style.display = "block";
						}
						
						
						
				 }
			}
			
			else
			{		
						if(document.getElementById("btnhide"))
						{
						document.getElementById("btnhide").style.display = "none";
						}
						if(document.getElementById("msgshow"))
						{		
						document.getElementById("msgshow").style.display = "block";
						}
						if(document.getElementById("hidechatcustom"))
						{
						document.getElementById("hidechatcustom").style.display = "block";
						}
						if(document.getElementById("hidechat"))
						{
						document.getElementById("hidechat").style.display = "none";
						}
						if(document.getElementById("derm"))
						{
						document.getElementById("derm").style.display = "block";
						}
			}
		
		
		
		  
		   
		}
		
		
		
		else
		{	document.getElementById("btnhide").style.display = "block";
			document.getElementById("hidechat").style.display = "block";
			document.getElementById("msgshow").style.display = "none";
			document.getElementById("hidechatcustom").style.display = "none";
			if(document.getElementById("derm"))
			{
				document.getElementById("derm").style.display = "none";
			}
			
		}
		
		
	   
	   
         //event to notify listeners of selection
        this._eo.data.hierChain = this._getPropertyChain('hierValue');
        RightNow.Event.fire("evt_productCategorySelected", this._eo);
        delete this._eo.data.hierChain;
        
        this._panel.hide();
        this._displayField.setAttribute("aria-busy", "true");
        //also close the dialog if it exists
        if(this._dialog && this._dialog.get("visible"))
            this._dialog.hide();
        if(this._currentIndex <= this._noValueNodeIndex)
        {
            this._displayFieldVisibleText.setHTML(this.data.attrs.label_nothing_selected);
            descText = this.data.attrs.label_nothing_selected;
        }
        else
        {
            hierValues = this._getSelectedNodesMessage().join("<br>");
			//console.log(hierValues);
            this._displayFieldVisibleText.setHTML(hierValues);
            descText = this.data.attrs.label_screen_reader_selected + hierValues;
			
			if (this.data.attrs.label_input == "Select an item"){
                this._eoShowFields = new RightNow.Event.EventObject();
                this._eoShowFields.data = {"prod" : hierValues};
				RightNow.Event.fire("evt_PCchosen", this._eoShowFields);
            }
			else if(this.data.attrs.label_input == "Product"){
            	this._eoShowFields = new RightNow.Event.EventObject();
                this._eoShowFields.data = {"prod" : hierValues};
                RightNow.Event.fire("evt_ServProdChosen", this._eoShowFields);   
            }
        }
        description = this.Y.one(this.baseSelector + "_TreeDescription");
        if(description)
           description.setHTML(descText);


        this._displayField.setAttribute("aria-busy", "false");
        //don't focus if the accessible dialog is in use or was in use during this page load.
        //the acccessible view and the treeview shouldn't really be mixed
        if(focus && this._displayField.focus && !this._dialog)
            try{this._displayField.focus();} catch(e){}
    }
		
		
		
        // _enterPressed: function(keyEvent)
        // _selectNode: function(clickEvent)
        // _getSubLevelRequest: function(expandingNode)
        // _getSubLevelResponse: function(type, args)
        // _setButtonClick: function()
        // _onValidate: function(type, args)
        // _createHintElement: function(visibility)
        // _toggleHint: function(hideOrShow)
        // _checkRequiredLevel: function()
        // _removeRequiredError: function(currentNode)
        // _displayRequiredError: function(currentNode)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	
	_getProdIDfromCurrentIndex : function()
	{
		
        var hierValues = [];
		
		
        //collect node values: work back up the tree
        if(this._currentIndex !== this._noValueNodeIndex)
        {
            var currentNode = this._tree.getNodeByIndex(this._currentIndex);
            while(currentNode && !currentNode.isRoot())
            {
                hierValues.push(currentNode.hierValue);
                currentNode = currentNode.parent;
				
				
            }
        }
		
		
		return hierValues[0];
        
        
	     
        
    }
	
	

	
});