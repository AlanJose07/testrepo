RightNow.namespace('Custom.Widgets.ResponsiveDesign.CatTest');
Custom.Widgets.ResponsiveDesign.CatTest = RightNow.Widgets.ProductCategorySearchFilter.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProductCategorySearchFilter#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			var button_id = this.baseSelector+"_Category_Button";
			this.button = this.Y.one(this.baseSelector+"_Category_Button");
			//this.pop_up = this.Y.one('#ygtv0');
			this.button.on("click", this.buttonClicked, this);
			//this.pop_up.on("click", this.check, this);
			//alert(this.instanceID);
			try
			{
				document.getElementById('ygtv0').style.display = "none";
				document.getElementById('ygtv0').className += " dropdown-menu";
			}
			catch(err)
			{}
			try
			{
				document.getElementById("rn_"+this.instanceID+"_Category_Button").className += " dropdown-toggle";
				$(button_id).attr("data-toggle", "dropdown");
			}
			catch(err)
			{}
			
			/*$('#ygtv0').click(function(event){
				alert("close pop");
			});*/
			
			$(document).click(function(event) { 
				if(!$(event.target).closest('#ygtv0').length) {
					if($('#ygtv0').is(":visible")) {
						$('#ygtv0').hide();
					}
				}        
			});
        },
	/**
     * Selected a node by clicking on its label
     * (as opposed to expanding it via the expand image).
     * @param {object} node The node
     */
    selectNode: function(node) {
		//alert("selectNode");
        if(node !== null) {
            this._getFiltersRequest.lastInstance[this.data.attrs.filter_type] = this.baseDomID;

            if((node.expanded || !node.value) && !this.data.js.linkingOn) {
                this._eo.data.level = node.depth + 1;
                // Setup filter data for report's filter request
                if(this._eo.data.level !== this._eo.filters.data[0].length) {
                    // Filter's been reset or user skipped a level.
                    this._eo.filters.data[0] = node.valueChain;
                }
                else {
                    this._eo.filters.data[0][this._eo.data.level - 1] = node.value || this._eo.data.value;
                    for(var i = this._eo.data.level; i < this._eo.filters.data[0].length; i++)
                        delete this._eo.filters.data[0][i];
                }
            }
            else if(this.data.attrs.search_on_select && !RightNow.Url.isSameUrl(this.data.attrs.report_page_url)) {
                // There's no need to get the sub level requests if we're redirecting, so just build up the event object data
                this._eo.data.level = node.depth + 1;
                this._eo.data.label = node.label;
                this._eo.data.value = node.value;
                this._eo.filters.data[0][node.depth] = node.value;
            }
            else {
                this.getSubLevelRequest(node);
                this.tree.collapseAll();
            }

            RightNow.ProductCategory.prototype.selectNode.call(this, node);

            if (this.data.attrs.search_on_select) {
                this._eo.filters.reportPage = this.data.attrs.report_page_url;
                this.searchSource().fire('search', this._eo);
            }
        }
    },
	/**
     * Responds to the filter reset event which can be fired in three different ways:
     * 1) Using the keyword 'all' - Fired by the advanced search dialog, should cause the last search to be reset
     * 2) Using the specific filterName e.g. 'p' - Fired by the display search filters widget, should revert to no value
     * 3) Using null args parameter - Fired by searchFilter.js when history is restored to init state, should revert to widget init state.
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    _onResetRequest: function(type, args) {
		//alert("_onResetRequest ");
        args = args[0];

        if(this.tree && (!args || args.data.name === 'all' || args.data.name === this.data.js.searchName)) {
            if(args && args.data.name === "all" && this._lastSearchValue) {
                //If all filters are reseting, go to prior search (typically caused by exiting the advanced search dialog)
                this._eo.filters.data[0] = this._lastSearchValue;
            }
            else {
                //If only this filter is reseting, go back to the initial value
                if(args && args.data.reset && this.data.js.linkingOn && this._dataType === "Category") {
                    // reset the productLinkingMap in RightNow.Event.js
                    RightNow.Event.fire('evt_resetFilterRequest', args);
                    // delete link_map if we have not already so that we don't send stale data
                    if(this.data.js.link_map)
                        delete this.data.js.link_map;
                    this.buildTree(true);
                }

                //If the history is going back to the initial state, use initial
                //otherwise empty it out because displaySearchFilter is removing it entirely
                if(!args)
                    this._eo.filters.data = [(this.data.js.initial) ? this.data.js.initial : []];
                else
                    this._eo.filters.data[0] = [];

                this._lastSearchValue = this._eo.filters.data[0].slice(0);
                this._getFiltersRequest.cachedWidgetHier = {};
            }

            this.tree.selectNodeWithValue(this._lastSearchValue[this._lastSearchValue.length - 1] || 0);
            this.displaySelectedNodesAndClose();
        }
    },

    /**
     * Sets filters for searching on report
     */
    _initializeFilter: function() {
		//alert("_initializeFilter");
        this._eo = new RightNow.Event.EventObject(this, {
            data: {
                data_type:      this._dataType = this.data.attrs.filter_type,
                linking_on:     this.data.js.linkingOn,
                cache:          [],
                hm_type:        this.data.js.hm_type,
                linkingProduct: 0
            },
            filters: {
                rnSearchType:   "menufilter",
                searchName:     this.data.js.searchName,
                report_id:      this.data.attrs.report_id,
                fltr_id:        this.data.js.fltr_id,
                oper_id:        this.data.js.oper_id,
                data:           [(this.data.js.initial) ? this.data.js.initial : []]
            }
        });
        this._lastSearchValue = this._eo.filters.data[0].slice(0);
        //Set namespace global for hier menu list linking display
        if(this._dataType === "Product") {
            RightNow.UI.Form.currentProduct = this._eo.filters.data[0][this._eo.filters.data[0].length - 1];
        }
    },
	/**
     * Event handler when a node is expanded.
     * Requests the next sub-level of items from the server.
     * @param {object} expandingNode The node that's expanding
     */
    getSubLevelRequestEventObject: function(expandingNode) {
		//alert("getSubLevelRequestEventObject");
        //only allow one node at-a-time to be expanded
        if(expandingNode.expanded && !this.data.js.linkingOn) return;

        this._eo.data.level = expandingNode.depth + 1;
        this._eo.data.label = expandingNode.label;
        this._eo.data.value = expandingNode.value;

        //static variable for different widget instances but the same data type
        this.getSubLevelRequestEventObject._origRequest = this.getSubLevelRequestEventObject._origRequest || [];
        this.getSubLevelRequestEventObject._origRequest[this._dataType] = expandingNode.value;

        if(this.data.js.link_map) {
            //pass link map (prod linking) to EventBus for first time
            this._eo.data.link_map = this.data.js.link_map;
            this.data.js.link_map = null;
        }
        //setup filter data for report's filter request
        if(this._eo.data.level !== this._eo.filters.data[0].length) {
            //filter's been reset or user skipped a level
            this._eo.filters.data[0] = this.tree.get('valueChain');
        }
        else {
            this._eo.filters.data[0][this._eo.data.level - 1] = this._eo.data.value;
            for(var i = this._eo.data.level; i < this._eo.filters.data[0].length; i++)
                delete this._eo.filters.data[0][i];
        }
		//alert("end of new fn");
        if(!expandingNode.loaded || this.data.js.linkingOn)
            return this._eo;
    },
	/**
     * Event handler when returning from ajax data request
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    getSubLevelResponse: function(type, args) {
		//alert("get sub level response");
        var eventObject = args[0];
        // Compute if the sub level response should be rendered. When false we want to
        // render the event object.
        //
        // When linking is enabled, we check a combination of eventObject.data.value,
        // eventObject.data.via_hier_request, and eventObject.data.via_product_click to
        // see if the response should be rendered. If linking is not enabled, we simply
        // compare the data types of the event and widget, and then compare the report
        // ids of the event and widget.
        //
        // * eventObject.data.value: The event object's value, such as product ID, or 0
        // if top level.
        // * eventObject.data.via_product_click: Indicates whether the event was
        // instantiated via a click on a product (not category), as opposed to page load.
        // * eventObject.data.via_hier_request: Indicates whether the event requested a
        // hierarchy, which happens when either product or categories are selected when
        // product category linking is enabled.
        if(!((eventObject.data.linking_on && ((!eventObject.data.value && eventObject.data.via_hier_request) || (eventObject.data.via_product_click))) ||
                (eventObject.data.data_type !== this._dataType) || (eventObject.filters.report_id !== this.data.attrs.report_id))) {
            RightNow.ProductCategory.prototype.getSubLevelResponse.call(this, eventObject, this._dataType);
        }
    },
	/**
     * Event handler when report has been updated
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    _onReportResponse: function(type, args) {
		//alert("on report response");
        var data = RightNow.Event.getDataFromFiltersEventResponse(args, this.data.js.searchName);
        this._getFiltersRequest.cachedWidgetHier = {};

        if (data[0] && data[0].length) {
            this.buildTree();
            //remove empties
            if(typeof data[0] === "string")
                data[0] = data[0].split(",");
            var finalData = RightNow.Lang.arrayFilter(data[0]);

            this.tree.expandAndCreateNodes(finalData);
            if (this.data.attrs.show_confirm_button_in_dialog) {
                // if confirmation buttons are being used, explicitly fire the confirm event
                // so that the response data is set
                this.dropdown.fire('confirm');
            }

            this._eo.filters.data[0] = finalData;
            this._lastSearchValue = finalData.slice(0);

            if (this._eo.filters.data.reconstructData) {
                this._eo.filters.data.level = this._eo.filters.data.reconstructData.level;
                this._eo.filters.data.label = this._eo.filters.data.reconstructData.label;
            }
        }
        else {
            //always set back to empty array since search eventbus may have inadvertantly set it to null...
            this._eo.filters.data[0] = [];
            if (this.tree) {
                //going from some selection back to no selection
                this.tree.resetSelectedNode();
                this.displaySelectedNodesAndClose();
            }
        }
    },
    /**
     * Selected a node by clicking on its label
     * (as opposed to expanding it via the expand image).
     * @param {object} node The node
     */
    selectNode: function(node) {
		//alert("selectNode");
		try
		{
			document.getElementById('ygtv0').style.display = "none";
		}
		catch(err)
		{}
        if(node !== null) {
            this._getFiltersRequest.lastInstance[this.data.attrs.filter_type] = this.baseDomID;

            if((node.expanded || !node.value) && !this.data.js.linkingOn) {
                this._eo.data.level = node.depth + 1;
                // Setup filter data for report's filter request
                if(this._eo.data.level !== this._eo.filters.data[0].length) {
                    // Filter's been reset or user skipped a level.
                    this._eo.filters.data[0] = node.valueChain;
                }
                else {
                    this._eo.filters.data[0][this._eo.data.level - 1] = node.value || this._eo.data.value;
                    for(var i = this._eo.data.level; i < this._eo.filters.data[0].length; i++)
                        delete this._eo.filters.data[0][i];
                }
            }
            else if(this.data.attrs.search_on_select && !RightNow.Url.isSameUrl(this.data.attrs.report_page_url)) {
                // There's no need to get the sub level requests if we're redirecting, so just build up the event object data
                this._eo.data.level = node.depth + 1;
                this._eo.data.label = node.label;
                this._eo.data.value = node.value;
                this._eo.filters.data[0][node.depth] = node.value;
            }
            else {
                this.getSubLevelRequest(node);
                this.tree.collapseAll();
            }

            RightNow.ProductCategory.prototype.selectNode.call(this, node);

            if (this.data.attrs.search_on_select) {
                this._eo.filters.reportPage = this.data.attrs.report_page_url;
                this.searchSource().fire('search', this._eo);
            }
        }
    },

    /**
     * Event handler when a node is expanded.
     * Requests the next sub-level of items from the server.
     * @param {object} expandingNode The node that's expanding
     */
    getSubLevelRequestEventObject: function(expandingNode) {
		//alert("getSubLevelRequestEventObject");
        //only allow one node at-a-time to be expanded
        if(expandingNode.expanded && !this.data.js.linkingOn) return;
		//alert(1);
        this._eo.data.level = expandingNode.depth + 1;
        this._eo.data.label = expandingNode.label;
        this._eo.data.value = expandingNode.value;
		//alert(2);
        //static variable for different widget instances but the same data type
        this.getSubLevelRequestEventObject._origRequest = this.getSubLevelRequestEventObject._origRequest || [];
        this.getSubLevelRequestEventObject._origRequest[this._dataType] = expandingNode.value;
		//alert(3);
        if(this.data.js.link_map) {
            //pass link map (prod linking) to EventBus for first time
            this._eo.data.link_map = this.data.js.link_map;
            this.data.js.link_map = null;
			//alert(4);
        }
        //setup filter data for report's filter request
        if(this._eo.data.level !== this._eo.filters.data[0].length) {
			//alert(5);
            //filter's been reset or user skipped a level
            this._eo.filters.data[0] = this.tree.get('valueChain');
        }
        else {
			//alert(6);
            this._eo.filters.data[0][this._eo.data.level - 1] = this._eo.data.value;
            for(var i = this._eo.data.level; i < this._eo.filters.data[0].length; i++)
                delete this._eo.filters.data[0][i];
        }
		//alert(7);
        if(!expandingNode.loaded || this.data.js.linkingOn)
            return this._eo;
    },

    /**
     * Event handler when returning from ajax data request
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    getSubLevelResponse: function(type, args) {
		//alert("getSubLevelResponse");
        var eventObject = args[0];
        // Compute if the sub level response should be rendered. When false we want to
        // render the event object.
        //
        // When linking is enabled, we check a combination of eventObject.data.value,
        // eventObject.data.via_hier_request, and eventObject.data.via_product_click to
        // see if the response should be rendered. If linking is not enabled, we simply
        // compare the data types of the event and widget, and then compare the report
        // ids of the event and widget.
        //
        // * eventObject.data.value: The event object's value, such as product ID, or 0
        // if top level.
        // * eventObject.data.via_product_click: Indicates whether the event was
        // instantiated via a click on a product (not category), as opposed to page load.
        // * eventObject.data.via_hier_request: Indicates whether the event requested a
        // hierarchy, which happens when either product or categories are selected when
        // product category linking is enabled.
        if(!((eventObject.data.linking_on && ((!eventObject.data.value && eventObject.data.via_hier_request) || (eventObject.data.via_product_click))) ||
                (eventObject.data.data_type !== this._dataType) || (eventObject.filters.report_id !== this.data.attrs.report_id))) {
            RightNow.ProductCategory.prototype.getSubLevelResponse.call(this, eventObject, this._dataType);
        }
    },

    /**
     * Event handler when report has been updated
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    _onReportResponse: function(type, args) {
		//alert("_onReportResponse");
        var data = RightNow.Event.getDataFromFiltersEventResponse(args, this.data.js.searchName);
        this._getFiltersRequest.cachedWidgetHier = {};

        if (data[0] && data[0].length) {
            this.buildTree();
            //remove empties
            if(typeof data[0] === "string")
                data[0] = data[0].split(",");
            var finalData = RightNow.Lang.arrayFilter(data[0]);

            this.tree.expandAndCreateNodes(finalData);
            if (this.data.attrs.show_confirm_button_in_dialog) {
                // if confirmation buttons are being used, explicitly fire the confirm event
                // so that the response data is set
                this.dropdown.fire('confirm');
            }

            this._eo.filters.data[0] = finalData;
            this._lastSearchValue = finalData.slice(0);

            if (this._eo.filters.data.reconstructData) {
                this._eo.filters.data.level = this._eo.filters.data.reconstructData.level;
                this._eo.filters.data.label = this._eo.filters.data.reconstructData.label;
            }
        }
        else {
            //always set back to empty array since search eventbus may have inadvertantly set it to null...
            this._eo.filters.data[0] = [];
            if (this.tree) {
                //going from some selection back to no selection
                this.tree.resetSelectedNode();
                this.displaySelectedNodesAndClose();
            }
        }
    },

    /**
     * When a search is triggered on the page, returns the filter's value if it matches the current report ID
     * @param {string} type Event name
     * @param {array} args Event arguments
     * @return {object} EventObject
     */
    _getFiltersRequest: function(type, args) {
		//alert("_getFiltersRequest"); 
        //If there are multiple instances of prodCatSF for one report, we need to sync them.
        this._getFiltersRequest.lastInstance[this.data.attrs.filter_type] = this._getFiltersRequest.lastInstance[this.data.attrs.filter_type] || null;
        this._getFiltersRequest.cachedWidgetHier = this._getFiltersRequest.cachedWidgetHier || {};

        var filterName = (this._eo.filters.searchName || "") + this.data.attrs.report_id,
            filterKey = filterName + this.baseDomID,
            mostRecentFilterKey = filterName + this._getFiltersRequest.lastInstance[this.data.attrs.filter_type],
            cachedHier = this._getFiltersRequest.cachedWidgetHier[mostRecentFilterKey];

        this._eo.filters.data.reconstructData = [];

        //The tree is built and a value is selected, construct the data array.
        if(this.tree && this.tree.get('value')) {
            this._eo.data.level = this.tree.get('depth');
            this._eo.data.label = this.tree.get('label');
            this._eo.data.value = this.tree.get('value');
			var level = this._eo.data.level;
			
			var eoAnswerLink = new RightNow.Event.EventObject(this, {data:  {level:this._eo.data.level, value:this._eo.data.value}});
	 		RightNow.Event.fire("evt_answer_link", eoAnswerLink);
			
            var labelChain = this.tree.get('labelChain');

            for (var i = 0; i < labelChain.length; i++) {
                this._eo.filters.data.reconstructData.push({
                    level: i + 1,
                    label: labelChain[i],
                    hierList: this._eo.filters.data[0].slice(0, i + 1).join(",")
                });
            }

            if (cachedHier && filterKey !== mostRecentFilterKey) {
                this._eo.filters.data = cachedHier;
            }
            else {
                this._getFiltersRequest.cachedWidgetHier[filterKey] = RightNow.Lang.cloneObject(this._eo.filters.data);
            }
        }
        else if(cachedHier) {
            //Widget isn't completely initialized, but may still have a cached value of another widget on the page
            this._eo.filters.data = cachedHier;
            this._eo.data.value = cachedHier[0][0];
        }
        else {
            //Widget has nothing, just send empty data.
            this._eo.filters.data[0] = [];
            this._eo.data.value = 0;
        }
        this._lastSearchValue = this._eo.filters.data[0].slice(0);
		//alert("end of fn");
        return this._eo;
    },

    /**
     * Responds to the filter reset event which can be fired in three different ways:
     * 1) Using the keyword 'all' - Fired by the advanced search dialog, should cause the last search to be reset
     * 2) Using the specific filterName e.g. 'p' - Fired by the display search filters widget, should revert to no value
     * 3) Using null args parameter - Fired by searchFilter.js when history is restored to init state, should revert to widget init state.
     * @param {string} type Event name
     * @param {array} args Event arguments
     */
    _onResetRequest: function(type, args) {
		//alert("_onResetRequest");
        args = args[0];

        if(this.tree && (!args || args.data.name === 'all' || args.data.name === this.data.js.searchName)) {
            if(args && args.data.name === "all" && this._lastSearchValue) {
                //If all filters are reseting, go to prior search (typically caused by exiting the advanced search dialog)
                this._eo.filters.data[0] = this._lastSearchValue;
            }
            else {
                //If only this filter is reseting, go back to the initial value
                if(args && args.data.reset && this.data.js.linkingOn && this._dataType === "Category") {
                    // reset the productLinkingMap in RightNow.Event.js
                    RightNow.Event.fire('evt_resetFilterRequest', args);
                    // delete link_map if we have not already so that we don't send stale data
                    if(this.data.js.link_map)
                        delete this.data.js.link_map;
                    this.buildTree(true);
                }

                //If the history is going back to the initial state, use initial
                //otherwise empty it out because displaySearchFilter is removing it entirely
                if(!args)
                    this._eo.filters.data = [(this.data.js.initial) ? this.data.js.initial : []];
                else
                    this._eo.filters.data[0] = [];

                this._lastSearchValue = this._eo.filters.data[0].slice(0);
                this._getFiltersRequest.cachedWidgetHier = {};
            }

            this.tree.selectNodeWithValue(this._lastSearchValue[this._lastSearchValue.length - 1] || 0);
            this.displaySelectedNodesAndClose();
        }
    },

    /**
     * Sets filters for searching on report
     */
    _initializeFilter: function() {
		//alert("_initializeFilter");
        this._eo = new RightNow.Event.EventObject(this, {
            data: {
                data_type:      this._dataType = this.data.attrs.filter_type,
                linking_on:     this.data.js.linkingOn,
                cache:          [],
                hm_type:        this.data.js.hm_type,
                linkingProduct: 0
            },
            filters: {
                rnSearchType:   "menufilter",
                searchName:     this.data.js.searchName,
                report_id:      this.data.attrs.report_id,
                fltr_id:        this.data.js.fltr_id,
                oper_id:        this.data.js.oper_id,
                data:           [(this.data.js.initial) ? this.data.js.initial : []]
            }
        });
        this._lastSearchValue = this._eo.filters.data[0].slice(0);
        //Set namespace global for hier menu list linking display
        if(this._dataType === "Product") {
            RightNow.UI.Form.currentProduct = this._eo.filters.data[0][this._eo.filters.data[0].length - 1];
        }
    }

        /**
         * Overridable methods from ProductCategorySearchFilter:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // selectNode: function(node)
        // getSubLevelRequestEventObject: function(expandingNode)
        // getSubLevelResponse: function(type, args)
        // _onReportResponse: function(type, args)
        // _getFiltersRequest: function(type, args)
        // _onResetRequest: function(type, args)
        // _initializeFilter: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	buttonClicked: function() {
		//alert("clicked");
		try
		{
			if(document.getElementById('ygtv0').style.display == "none")
			{
				//alert("now none");
				document.getElementById('ygtv0').style.display = "block";
			}
			else
			{
				//alert("now block");
				document.getElementById('ygtv0').style.display = "none";
			}
		}
		catch(err)
		{}
	},
    /**
     * Renders the `view.ejs` JavaScript template.
     */
    renderView: function() {
		//alert("renderView");
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },
	check: function() {
		//alert("checked");
	}
});