RightNow.namespace('Custom.Widgets.search.amccKeyword');
Custom.Widgets.search.amccKeyword = RightNow.Widgets.KeywordText.extend({ 
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
			
		},
		_onGetFiltersRequest: function(type, args) {
		
    },

	_onChangedResponse: function(type, args) {
		var searchObject = new RightNow.Event.EventObject(this, {data: {keyword: this.Y.Lang.trim(this._textElement.get("value"))}});
		RightNow.Event.fire("evt_setValueKeyword", searchObject);
        this._eo.filters.data = this.Y.Lang.trim(this._textElement.get("value"));
        this._searchedOn = this._eo.filters.data;
        return this._eo;
    }
		
        },
		 
		 
	

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


    /**
     * Sample widget method.
     */
	 /**
    * Event handler executed when text has changed
    *
    * @param evt object Event
    */
    
    
    

    methodName: function() {

    }
    
   
});

   