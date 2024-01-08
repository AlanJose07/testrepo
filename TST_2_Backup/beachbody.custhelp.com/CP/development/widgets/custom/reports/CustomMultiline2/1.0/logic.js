RightNow.namespace('Custom.Widgets.reports.CustomMultiline2');
Custom.Widgets.reports.CustomMultiline2 = RightNow.Widgets.Multiline.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.Multiline#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },

        /**
         * Overridable methods from Multiline:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _setFilter: function()
        // _searchInProgress: function(evt, args)
        // _setLoading: function(loading)
        // _onReportChanged: function(type, args)
        // _displayDialogIfError: function(error)
        // _updateAriaAlert: function(text)
		
		/////////////////////////////////////////////////////////////////////////////////////////
		// Anuj - CP3 Migration - Overridden methods
		//////////////////////////////////////////////////////////////////////////////////////////

		/**
		 * Event handler received when report data is changed.
		 * Anuj - Overridden to append summary content in answer detail link urls before ajax results
		 * @param {String} type Event name
		 * @param {Array} args Arguments passed with event
		 */
		_onReportChanged: function(type, args) {
			var newdata = args[0].data;

			this._displayDialogIfError(newdata.error);
	
			if (!this._contentDiv) return;
			
			/* Anuj - Mar 26, 14
			 * we don't need ss_data for altdata - set it as null because sometimes if ss_data is large, it causes ajax to error out */
			var senddata = newdata;
			senddata.ss_data = null;
			senddata = RightNow.JSON.stringify(senddata);
	
			// make ajax request to update answer links
			RightNow.Ajax.makeRequest('/cc/AjaxCustom/getAltData', {passedvalues:senddata}, {
			   successHandler: this._onDataResponseReceived,
			   scope: this,
			   json: true
			});
		}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	/////////////////////////////////////////////////////////////////////////////////////////
	// Anuj - CP3 Migration - Custom methods
	//////////////////////////////////////////////////////////////////////////////////////////

	/**
	 * Success handler for when updated report data is received 
	 * major part of this method is taken from _onReportChanged method
	 * @param {Array} args ajax response
	 */
	_onDataResponseReceived: function(args) {
		
		var newdata = args,
			ariaLabel, firstLink,
			newContent = "";
		
		if(newdata.total_num > 0) {
			ariaLabel = this.data.attrs.label_screen_reader_search_success_alert;
			newContent = new EJS({text: this.getStatic().templates.view}).render(newdata);
		}
		else {
			ariaLabel = this.data.attrs.label_screen_reader_search_no_results_alert;
		}

		this._updateAriaAlert(ariaLabel);
		this._contentDiv.set("innerHTML", newContent);

		if (this.data.attrs.hide_when_no_results) {
			this.Y.one(this.baseSelector)[((newContent) ? 'removeClass' : 'addClass')]('rn_Hidden');
		}

		this._setLoading(false);
		RightNow.Url.transformLinks(this._contentDiv);

		if (newdata.total_num && (firstLink = this._contentDiv.one('a'))) {
			//focus on the first result
			firstLink.focus();
		}
	}
});