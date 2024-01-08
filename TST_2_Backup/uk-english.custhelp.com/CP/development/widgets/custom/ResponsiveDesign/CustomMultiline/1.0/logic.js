RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomMultiline');
Custom.Widgets.ResponsiveDesign.CustomMultiline = RightNow.ResultsDisplay.extend({
    overrides: {
        constructor: function() {
            this.parent();
			
			this.tlp = 0;
			this.catid = 0;
            this._contentDiv = this.Y.one(this.baseSelector + "_Content");
            this._loadingDiv = this.Y.one(this.baseSelector + "_Loading");

            (RightNow.Event.isHistoryManagerFragment() && this._setLoading(true));
            this.searchSource(this.data.attrs.report_id)
                    .on("response", this._onReportChanged, this)
                    .on("send", this._searchInProgress, this);
            this._setFilter();
            this._displayDialogIfError(this.data.js.error);
			RightNow.Event.subscribe("evt_answer_link", this.answerLink, this);
        }
    },

    /**
     * Initialization function to set up search filters for report...
     */
    _setFilter: function() {
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
       var params = args[1];

       if(!params || !params.newPage)
           this._setLoading(true);
    },

    /**
    * Changes the loading icon and hides/unhide the data.
    * @param {Boolean} loading Whether to add or remove the loading indicators
    */
    _setLoading: function(loading) {
        if (this._contentDiv && this._loadingDiv) {
            var method, toOpacity, ariaBusy;
            if (loading) {
                ariaBusy = true;
                method = "addClass";
                toOpacity = 0;

                //keep height to prevent collapsing behavior
                this._contentDiv.setStyle("height", this._contentDiv.get("offsetHeight") + "px");
            }
            else {
                ariaBusy = false;
                method = "removeClass";
                toOpacity = 1;

                //now allow expand/contract
                this._contentDiv.setStyle("height", "auto");
            }
            document.body.setAttribute("aria-busy", ariaBusy + "");
            //IE rendering: so bad it can't handle eye-candy
            if(this.Y.UA.ie){
                this._contentDiv[method]("rn_Hidden");
            }
            else{
                this._contentDiv.transition({
                    opacity: toOpacity,
                    duration: 0.4
                });
            }
            this._loadingDiv[method]("rn_Loading");
        }
		if(loading==true)
		{
			return 1;
		}
		else
		{
			return 0;
		}
    },

    /**
     * Event handler received when report data is changed.
     * @param {String} type Event name
     * @param {Array} args Arguments passed with event
     */
    _onReportChanged: function(type, args) {
		//alert("on report changed ---- clear console");
		
        var newdata = args[0].data,
            ariaLabel, firstLink,
            newContent = "";
			
		var report_data = args[0].data.data;	
		var report_data_length = newdata.data.length;
		var temp = "";
		var stripped_string = "";
		var temporalDivElement;
		for(var i = 0; i<report_data_length; i++)
		{
			var res = report_data[i][1];// for removing div with specific class
			var pos = res.search('div class="hide_this_section_from_answer_list"');
			if(pos != -1)
			{
				res = this.checkForClass(res);// for removing div with specific class
				res = this.checkForClass(res);// for removing div with specific class
			}
			report_data[i][1] = this.stripHtml(res); //for stripping HTML tags
			report_data[i][1] = report_data[i][1].substr(0,this.data.attrs.truncate_size)+ "...";
			
			stripped_string = this.stripHtml(report_data[i][2]);
			
			var isTLP = stripped_string.search("TLP");
			var isCatid = stripped_string.search("catid");
			if(isTLP == -1)
			{
				stripped_string+="/TLP/"+this.tlp;	
			}
			if(isCatid == -1)
			{
				stripped_string+="/catid/"+this.catid;	
			}
			
			
			report_data[i][2] = stripped_string;//"<a href = '"+stripped_string+"'>"+stripped_string+"</a>";
			
		}
        this._displayDialogIfError(newdata.error);

        if (!this._contentDiv) return;

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

         var x=this._setLoading(false);
		 
		 if(x==0)
		{
			document.getElementById("stickyclass_hide_show_answerlist").value="0";
		}
		else
		{
			document.getElementById("stickyclass_hide_show_answerlist").value="1";
		}
		
        RightNow.Url.transformLinks(this._contentDiv);
    },

    /**
     * Displays a warning dialog when a report error is encountered.
     * @private
     * @param {null|String} error
     */
    _displayDialogIfError: function(error) {
        if (error) {
            RightNow.UI.Dialog.messageDialog(error, {"icon": "WARN"});
        } 
    },

    /**
     * Updates the text for the ARIA alert div that appears above the results listings.
     * @private
     * @param {String} text The text to update the div with
     */
    _updateAriaAlert: function(text) {
        if (!text) return;
        this._ariaAlert = this._ariaAlert || this.Y.one(this.baseSelector + "_Alert");
        if(this._ariaAlert) {
            this._ariaAlert.set("innerHTML", text);
        }
    },
	
	answerLink: function(type, args) {
		var level = args[0].data.level;
		var id = args[0].data.value;
		if(level == 0)
		{
			//alert("tlp - "+id);
			this.tlp = id;
			this.catid = id;
		}
		else
		{
			//alert("cat id - "+id);
			this.catid = id;
		}
	},
	checkForClass: function(res) {
		var pos = res.search('div class="hide_this_section_from_answer_list"');
		if(pos != -1)
		{
			var start_pos = pos-1;
			//console.log("start pos = "+start_pos);
			pos = res.indexOf('/div',pos);
			var end_pos = pos + 5;
			//console.log("end pos = "+end_pos);
			var first = res.substring(0,start_pos);
			//console.log("first = "+first);
			var second = res.substring(end_pos);
			//console.log("second = "+second);
			res = first+second;
			return res;
		}
	},
	stripHtml: function(html){
		temp = html;
		temporalDivElement = document.createElement("div");
		// Set the HTML content with the providen
		temporalDivElement.innerHTML = temp;
		// Retrieve the text property of the element (cross-browser support)   
		stripped_string = temporalDivElement.textContent || temporalDivElement.innerText || "";
		return stripped_string;
	}
});
