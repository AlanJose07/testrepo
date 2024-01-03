RightNow.namespace('Custom.Widgets.search.KeywordTextPrivate');
Custom.Widgets.search.KeywordTextPrivate = RightNow.Widgets.KeywordText.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.KeywordText#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			var sla=this.data.js.sla;
			if(this._textElement.get("value")==="" && sla==="AMCC")
		{
			
		document.getElementById("res").style.display="none";
		document.getElementById("snow").style.display="block";
		
		
		}
		
			
			if(this._textElement.get("value") != "" && sla!=="AMCC")
			{
				
			YUI().use('node', function(Y) { 
			
			Y.one('#rn_PageContent').addClass('highlight');
			
			
			});
			}
			else
			{
				
			YUI().use('node', function(Y) { 
			
			Y.one('#rn_PageContent').removeClass('highlight');
			
			
			});
			
			
			}
        },
		
		_onGetFiltersRequest: function(type, args) {
			var sla=this.data.js.sla;
		if(this._textElement.get("value")!="" && sla==="AMCC")
		{
			
		document.getElementById("snow").style.display="none";
		document.getElementById("res").style.display="block";
		}
			
		
		
		var searchObject = new RightNow.Event.EventObject(this, {data: {keyword: this.Y.Lang.trim(this._textElement.get("value"))}});
		
		RightNow.Event.fire("evt_setValueKeyword", searchObject);
        
        this._eo.filters.data = this.Y.Lang.trim(this._textElement.get("value"));
		
		if(this._textElement.get("value") != "" && sla!=="AMCC")
		{
			
			YUI().use('node', function(Y) { 
			 
			 Y.one('#rn_PageContent').addClass('highlight');
			 
			
			});
		}
		else
		{
			
			YUI().use('node', function(Y) { 
			 
			 Y.one('#rn_PageContent').removeClass('highlight');
			 
			
			});
			
			
		}
		
        this._searchedOn = this._eo.filters.data;
		
	
	 
        return this._eo;
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