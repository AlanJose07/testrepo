RightNow.namespace('Custom.Widgets.reports.MultilineAnswersCustom');
Custom.Widgets.reports.MultilineAnswersCustom = RightNow.ResultsDisplay.extend({
	overrides: {
		constructor: function() {
		
			//alert("1");
			
			this.parent();
			this._contentDiv = this.Y.one(this.baseSelector + "_Content");
			this._loadingDiv = this.Y.one(this.baseSelector + "_Loading");
			
			(RightNow.Event.isHistoryManagerFragment() && this._setLoading(true));
			this.searchSource(this.data.attrs.report_id)
			.on("response", this._onReportChanged, this)
			.on("send", this._searchInProgress, this);
			this._setFilter();
			/* When a search is done, the event "on_before_ajax_request" is subscribed */
			RightNow.Event.subscribe("on_before_ajax_request", this._onBeforeAjax, this);
			/* To Show/Hide the answer details   */
			for(var i=0;i<this.data.js.cntresult;i++) {
				this.wh_ = this.Y.one('#' +"list_"+i);
				this.wh_.on('click', this._ShowHide,this);
			}
		}
	},
	
	/**
	* Function to show/hide the answer details on clicking the question
	*/
	_ShowHide:  function(type,args) {
		
		var btnid=type._currentTarget.id;
		var lno = btnid.substr(btnid.lastIndexOf('list_') + 5);
		var a_id=this.Y.one('#' +'get_ans_'+lno).get('value');
		var lid="list_"+lno;
		var prodid=this.data.js.prod; 
		console.log("Prod ID :::--"+prodid);
		if(this.Y.one('#' +'ans_'+lno).getStyle('display')=="none") {
			if(prodid!=false)
			{
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/set_answer_viewbyprod/', {a_id:a_id,prodid:prodid}, {
				successHandler: function(response) { 
					console.log("Sucess 1");
					console.log(response);
				},
				errorHandler:function(response){
					console.log("Error");
					console.log(response);
				}
			});
			}
			document.getElementById(lid).className = 'minusarrow';
			this.Y.one('#' +'ans_'+lno).setStyle('display','block');
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/set_answer_view/', {a_id:a_id}, {
				successHandler: function(response) { 
					console.log("Sucess 2");
					console.log(response);
				},
				errorHandler:function(response){
					console.log("Error 2");
					console.log(response);
				}
			});
		}
		else {
			
			document.getElementById(lid).className = 'arrow';     
			this.Y.one('#' +'ans_'+lno).setStyle('display','none');
		}
		
	},
	
	
	/**
	* Initialization function to set up search filters for report.
	*/
	_setFilter: function() {
	
		//alert("3");
		var eo = new RightNow.Event.EventObject(this, {filters: {
			token: this.data.js.r_tok,
			format: this.data.js.format,
			report_id: this.data.attrs.report_id,
			allFilters: this.data.js.filters
		}});
		eo.filters.format.parmList = this.data.attrs.add_params_to_url;
		this.searchSource().fire("setInitialFilters", eo);
	},
	
	/**
	* Event handler received when search data is changing.
	* Shows progress icon during searches.
	* @param {string} evt Event name
	* @param {args} args Arguments provided from event fire
	*/
	_searchInProgress: function(evt, args) {
		
		//alert("4");
		var params = args[1];
		
		if(!params || !params.newPage) {	//alert('if6');
			this._setLoading(true);
		}
	},
	
	/**
	* Changes the loading icon and hides/unhide the data.
	* @param {Boolean} loading Whether to add or remove the loading indicators
	*/
	_setLoading: function(loading) {
	
		//alert("5");
		
		if (this._contentDiv && this._loadingDiv) {
			var method, toOpacity, ariaBusy;
			if (loading) {
				//alert('if1');
				ariaBusy = true;
				method = "addClass";
				toOpacity = 0;
				
				//keep height to prevent collapsing behavior
				this._contentDiv.setStyle("height", this._contentDiv.get("offsetHeight") + "px");
			}
			else {
				//alert('if2');
				ariaBusy = false;
				method = "removeClass";
				toOpacity = 1;
				
				//now allow expand/contract
				this._contentDiv.setStyle("height", "auto");
			}
			document.body.setAttribute("aria-busy", ariaBusy + "");
			//IE rendering: so bad it can't handle eye-candy
			if(this.Y.UA.ie){
				//alert('if3');
				this._contentDiv[method]("rn_Hidden");
			}
			else{
				//alert('if4');
				this._contentDiv.transition({
					opacity: toOpacity,
					duration: 0.4
				});
			}
			this._loadingDiv[method]("rn_Loading");
		}
	},
	
	/**
	* Event handler received when report data is changed.
	* @param {String} type Event name
	* @param {Array} args Arguments passed with event
	*/
	_onReportChanged: function(type, args) {
		
		//alert("6");
		
		setTimeout(doSomething, 30000);
		
		function doSomething() {
			//do whatever you want here
		}
		
		var newdata = args[0].data,
		ariaLabel, firstLink,
		newContent = "";
		
		if (newdata.error) {
			RightNow.UI.Dialog.messageDialog(newdata.error, {"icon": "WARN"});
		}
		
		if (!this._contentDiv) return;
		
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
	},
	
	/**
	* Updates the text for the ARIA alert div that appears above the results listings.
	* @private
	* @param {String} text The text to update the div with
	*/
	_updateAriaAlert: function(text) {
	
		//alert("7");
		if (!text) return;
		this._ariaAlert = this._ariaAlert || this.Y.one(this.baseSelector + "_Alert");
		if(this._ariaAlert) {
			this._ariaAlert.set("innerHTML", text);
		}
	},
	
	/* To call the custom ajax controller to retrieve data when a search is done ( to retain the links in the answers) */
	_onBeforeAjax: function(type,args) {
		//alert("8");
		//console.log(args[0]);
		if(args[0].url == "/ci/ajaxRequest/getReportData") {			
			args[0].url = "/cc/ajaxCustom/getReportData";
		}
	}
});
