RightNow.namespace('Custom.Widgets.search.SearchButton_custom');
Custom.Widgets.search.SearchButton_custom = RightNow.Widgets.SearchButton.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SearchButton#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			this._requestInProgress = false;
			this.filters_checked = 0;
			this._urlParam = "";
            this._searchButton = this.Y.one(this.baseSelector + "_SubmitButton");
			this._reportDiv = this.Y.one("#pageResults");
			this._msgDiv = this.Y.one("#selectFilter");
            if (this._searchButton) {
            //    this._enableClickListener();
                this.searchSource().on("response", this._enableClickListener, this);
			}
			this._checkSelected();
			//this._enableClickListener();
			RightNow.Event.subscribe("evt_selectedrequest", this._setClickEnable, this);
        },
		
		/**
		 * 
		 * Sets variable that allows the search button to be enabled.  
		 * 
		 */
		_setClickEnable: function(type, args){
			//If while coming back from detail page, if the filter gets reset
          // alert("Starting" + args[0].filters.data.val);
		   
		    this._Get_No_of_checkBox_Checked();
		   /* Logic changed
			if(this.filters_checked<=-1)
			{
				
				this.filters_checked = 0;
			}
			//ends here
			if (args[0].filters.data.val == "~any~")
			{
				this.filters_checked -= 1;
			}
			else
			{
				this.filters_checked += 1;
			}
			Logic changed due to Ie issue
			*/
			
			//For setting selected values into URL
		   //this._enableClickListener()
		},
		
		_Get_No_of_checkBox_Checked: function()
		{
			var elLength = document.SearchForm.elements.length;
			
			var NoOfcheckbox =0;

			for (i=0; i<elLength; i++)
			{
				var type = SearchForm.elements[i].type;
				if (type=="checkbox" && SearchForm.elements[i].checked)
				{
					NoOfcheckbox  += 1;
				}
				
			}
			this.filters_checked = NoOfcheckbox;
			
			
		},
		
		 /**
		* Event handler executed when the button is clicked
		* @param {Object} evt Event
		*/
		_startSearch: function(evt) {
			
			
		   this._Get_No_of_checkBox_Checked();
			 
			
			if(this.filters_checked > 0)
			{
			this._reportDiv["removeClass"]("rn_Hidden");
			this._msgDiv["addClass"]("rn_Hidden");
			
			if (this._requestInProgress) return;
			
			if (!this.data.attrs.popup_window && (!this.data.attrs.report_page_url && (this.data.attrs.target === '_self')))
				this._disableClickListener();
	
			if (this.Y.UA.ie) {
				// since the form is submitted by script, deliberately tell IE to do auto completion of the form data
				this._parentForm = this._parentForm || this.Y.one(this.baseSelector).ancestor("form");
				if (this._parentForm && window.external && "AutoCompleteSaveForm" in window.external) {
					window.external.AutoCompleteSaveForm(this.Y.Node.getDOMNode(this._parentForm));
				}
			}
			var searchPage = this.data.attrs.report_page_url;

			this.searchSource().fire("search", new RightNow.Event.EventObject(this, {filters: {
				report_id: this.data.attrs.report_id, 
				source_id: this.data.attrs.source_id, 
				reportPage: searchPage,
				newPage: top !== self || (searchPage !== "" && searchPage !== "{current_page}" && !RightNow.Url.isSameUrl(searchPage)),
				target: this.data.attrs.target,
				popupWindow: this.data.attrs.popup_window,
				width: this.data.attrs.popup_window_width_percent,
				height: this.data.attrs.popup_window_height_percent
			}}));
			}
			else // if no filters are selected, reports should not be shown
			{			
			this._reportDiv["addClass"]("rn_Hidden");
			this._msgDiv["removeClass"]("rn_Hidden");
				
				}
		},
		
		/**
		 * Sets the button click listener.
		 */
		_enableClickListener: function() {
			
			this._requestInProgress = false;
			this._searchButton.on("click", this._startSearch, this);
		},
	
		/**
		 * Removes the button click listener.
		 */
		_disableClickListener: function() {
			this._requestInProgress = true;
			this._searchButton.detach("click", this._startSearch);
		}

        /**
         * Overridable methods from SearchButton:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _startSearch: function(evt)
        // _enableClickListener: function()
        // _disableClickListener: function()
		
    },
	

    /**
     * Varun to fix the report display issue while clicking back button
     */
    _checkSelected: function() {
			var urls = window.location.href;
			if( urls.match(/kw/g))
			{
				var count = urls.match(/1/g).length -1 ;
				if(this.filters_checked<=0 && count>0)
				{
					this.filters_checked = count;	
				}
			}
			
    }
});