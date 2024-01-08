RightNow.namespace('Custom.Widgets.ResponsiveDesign.PaginatorGeneric');
Custom.Widgets.ResponsiveDesign.PaginatorGeneric = RightNow.Widgets.Paginator.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.Paginator#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			this.category_id = 0;
			this.tlp = 0;
			
			RightNow.Event.subscribe("get_category_id", this.getCategoryId, this);
        },

		/**
		* Event Handler fired when a direction button is clicked
		*
		* @param {Object} evt Event object
		* @param {Bool} isForward Indicator of button's direction
		*/
		_onDirection: function(evt, isForward)
		{
			evt.preventDefault();
			if(this._currentlyChangingPage)
				return;
	
			this._currentlyChangingPage = true;
			if(isForward)
				this._currentPage++;
			else
				this._currentPage--;
			this._eo.filters.page = this._currentPage;
	
			if (RightNow.Event.fire("evt_switchPagesRequest", this._eo)) {
				this.searchSource().fire("appendFilter", this._eo)
					.fire("search", this._eo);
			}
			window.scroll(0,0);
		},

		/**
		* Event Handler fired when a page link is selected
		*
		* @param {Object} evt Event object
		* @param {Int} pageNumber Number of the page link clicked on
		*/
		_onPageChange: function(evt, pageNumber)
		{
			evt.preventDefault();
	
			if(this._currentlyChangingPage || !pageNumber || pageNumber === this._currentPage)
				return;
	
			this._currentlyChangingPage = true;
			pageNumber = (pageNumber < 1) ? 1 : pageNumber;
			this._eo.filters.page = this._currentPage = pageNumber;
			if (RightNow.Event.fire("evt_switchPagesRequest", this._eo)) {
				this.searchSource().fire("appendFilter", this._eo)
					.fire("search", this._eo);
			}
			window.scroll(0,0);
		}     

        /**
         * Overridable methods from Paginator:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onPageChange: function(evt, pageNumber)
        // _onDirection: function(evt, isForward)
        // _onReportChanged: function(type, args)
        // _shouldShowHellip: function(pageNumber, currentPage, endPage)
        // _shouldShowPageNumber: function(pageNumber, currentPage, endPage)
        // _cloneForwardAndBackwardButton: function()
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	getCategoryId: function(type, args)
	{
		//console.log("cat changed"+args[0].value);
		
		this.depth = args[0].depth;
		if(this.depth == 1)
		{
			this.tlp = args[0].value;
			this.category_id = args[0].value;
		}
		else
		{
			this.category_id = args[0].value;
		}
		for(var i = this.data.js.startPage; i <= this.data.js.endPage; i++)
		{
			if((i!=this.data.js.currentPage))
			{
				// var pageLinkIDBase = this.baseSelector + "_PageLink_" + i;
				// alert("pageLinkBase---"+pageLinkID);
				var pageLinkID = "rn_"+this.instanceID + "_PageLink_" + i;
				//alert(pageLinkID);
				try
				{
					var url_string = document.getElementById("rn_"+this.instanceID + "_PageLink_" + i).href;
					url_string = url_string.substr(url_string.indexOf('app/'));
					//alert(url_string);
					var url = url_string.split('/');
					//console.log("here");
					var cat_pos = url.indexOf('catid');
					var tlp_pos = url.indexOf('tlp');
					//alert(cat_pos+"______"+tlp_pos);
					/*new URL(url_string);
					var cat_id = url.searchParams.get("catid");
					var tlp_id = url.searchParams.get("tlp");*/
					url_string = "/";
					if(cat_pos!=-1 && tlp_pos!=-1)
					{
						url[cat_pos+1] = this.category_id;
						url[tlp_pos+1] = this.tlp;
						url_string =url.join('/');
						//console.log("Reconstructed URL: "+url_string);
						try
						{
							document.getElementById("rn_"+this.instanceID + "_PageLink_" + i).href = "/"+url_string;
						}
						catch(err)
						{}
						
						
					}
					else 
					{
						//alert("123");
						try
						{
							document.getElementById("rn_"+this.instanceID + "_PageLink_" + i).href+="/catid/"+this.category_id+"/tlp/"+this.tlp;
						}
						catch(err)
						{}
					}
				}
				catch(err)
				{}
				//document.getElementById("rn_"+this.instanceID + "_PageLink_" + i).href="www.google.com";//use this
				/* var pageurl=document.getElementById("rn_"+this.instanceID + "_PageLink_" + i);
			
				// pageurl.href="www.google.com";	*/
			}
		}
			//document.getElementsByClassName("rn_PreviousPage").href="www.google.com";
			//document.getElementsByClassName("rn_NextPage").href="www.google.com";
	}
});