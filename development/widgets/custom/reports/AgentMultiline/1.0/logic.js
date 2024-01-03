RightNow.namespace('Custom.Widgets.reports.AgentMultiline');
Custom.Widgets.reports.AgentMultiline = RightNow.Widgets.Multiline.extend({ 
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
            (RightNow.Event.isHistoryManagerFragment() && this._setLoading(true));
			this.searchSource(this.data.attrs.report_id)
			.on("response", this._onReportChanged, this)
			.on("send", this._searchInProgress, this);
			this._setFilter();
			RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjax, this);
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
        _onReportChanged: function(type, args) {
        var newdata = args[0].data,
            ariaLabel, firstLink,
            newContent = "";

        this._displayDialogIfError(newdata.error);

        if (!this._contentDiv) return;
		//mkt
		RightNow.Event.fire('evt_reportResults', newdata.total_num);
        if(newdata.total_num > 0) {
            ariaLabel = this.data.attrs.label_screen_reader_search_success_alert;
            newdata.hide_empty_columns = this.data.attrs.hide_empty_columns;
            newdata.hide_columns = this.data.js.hide_columns;
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
    }
        // _displayDialogIfError: function(error)
        // _updateAriaAlert: function(text)
    },

    /**
     * Sample widget method.
     */
   _onBeforeAjax: function(type,args) {
		//alert("8");
		//console.log(args[0]);
		
		if(args[0].url == "/ci/ajaxRequest/getReportData") {			
			args[0].url = "/cc/ajaxCustom/Agent_getReportData";
		}
	}
});