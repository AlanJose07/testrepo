RightNow.namespace('Custom.Widgets.reports.ResultInfoSearchLimit');
Custom.Widgets.reports.ResultInfoSearchLimit = RightNow.Widgets.ResultInfo.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ResultInfo#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },

        /**
         * Overridable methods from ResultInfo:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onReportChanged: function(type, args)
        // _updateSearchResults: function(options)
        // _determineNewResults: function(eventObject)
        // _reportCombinedResults: function(evt, args)
        // _watchSearchFilterChange: function(evt, args)
		
		/////////////////////////////////////////////////////////////////////////////////////////
		// Anuj - CP3 Migration - Overridden methods
		//////////////////////////////////////////////////////////////////////////////////////////

		/**
		 * Event handler received when report data is changed.
		 * Anuj - Overridden to Limit search result functionality - Mar 26, 14
		 * @param type String Event type
		 * @param args Object Arguments passed with event
		 */
		_onReportChanged: function(type, args)
		{
			var newData = args[0].data,
				resultQuery = "",
				parameterList = (this.data.attrs.add_params_to_url)
					? RightNow.Url.buildUrlLinkString(args[0].filters.allFilters, this.data.attrs.add_params_to_url)
					: '';
			
			this._determineNewResults(args[0]);
	
			//construct search results message for the searched-on terms
			if(!this.data.attrs.combined_results && this.data.attrs.display_results && newData.search_term)
			{
				var stopWords = newData.stopword,
					noDictWords = newData.not_dict,
					searchTerms = newData.search_term.split(" "),
					displayedNoResultsMsg = false;
	
				for(var i = 0, word, strippedWord; i < searchTerms.length; i++)
				{
					word = searchTerms[i];
					strippedWord = word.replace(/\W/, "");
					if(stopWords && strippedWord && stopWords.indexOf(strippedWord) !== -1)
						word = "<span class='rn_Strike' title='" + this.data.attrs.label_common + "'>" + word + "</span>";
					else if(noDictWords && strippedWord && noDictWords.indexOf(strippedWord) !== -1)
						word = "<span class='rn_Strike' title='" + this.data.attrs.label_dictionary + "'>" + word + "</span>";
					else
						word = "<a href='" + RightNow.Url.addParameter(this.data.js.linkUrl + encodeURIComponent(word.replace(/\&amp;/g, "&")) + parameterList + "/search/1", "session", RightNow.Url.getSession()) + "'>" + word + "</a>";
					resultQuery += word + " ";
				}
				resultQuery = this.Y.Lang.trim(resultQuery);
			}
	
			// suggested
			var suggestedDiv = this.Y.one(this.baseSelector + "_Suggestion");
			if(suggestedDiv)
			{
				if(newData.ss_data)
				{
					var links = this.data.attrs.label_suggestion + " ";
					for(var i = 0; i < newData.ss_data.length; i++) {
						/* Limiting search result functionality - Anuj - Mar 26, 14 */
						if(this.data.attrs.max_suggested_searches == i)
							break;
						links += '<a href="' + this.data.js.linkUrl + newData.ss_data[i] + '/suggested/1' + parameterList + '">' + newData.ss_data[i] + '</a>&nbsp;';
					suggestedDiv.set('innerHTML', links)
								.removeClass('rn_Hidden');
					}
				}
				else
				{
					RightNow.UI.hide(suggestedDiv);
				}
			}
	
			// spelling
			var spellingDiv = this.Y.one(this.baseSelector + "_Spell");
			if(spellingDiv)
			{
				if(newData.spelling)
				{
					spellingDiv.set('innerHTML', this.data.attrs.label_spell + ' <a href="' + this.data.js.linkUrl + newData.spelling + '/dym/1/' + parameterList + '">' + newData.spelling + ' </a>')
							   .removeClass('rn_Hidden');
				}
				else
				{
					RightNow.UI.hide(spellingDiv);
				}
			}
			this._updateSearchResults({
				searchTermToDisplay: resultQuery, 
				userSearchedOn: newData.search_term,
				topics: newData.topics, 
				truncated: newData.truncated
			});
			if(!this.data.attrs.combined_results)
			{
				this.data.js.totalResults = 0;
				this.data.js.firstResult = 0;
				this.data.js.lastResult = 0;
			}
		}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});