RightNow.namespace('Custom.Widgets.ResponsiveDesign.ChatPostMessageFocus');
Custom.Widgets.ResponsiveDesign.ChatPostMessageFocus = RightNow.Widgets.ChatPostMessage.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`...
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatPostMessage#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			this.globalcounter = 0;
			this.checkFocus();
			
        },
		/**
		 * Sets whether the chat is in "virtual agent mode".
		 * If in VA mode, only one post should be sent for each response.
		 * @param {string} type Event name
		 * @param {array} args Event arguments
		 */
		_onChatEngagementParticipantAddedResponse: function(type, args)
		{
			this._vaMode = args[0].data.virtualAgent === undefined ? false : args[0].data.virtualAgent;
		},
		/**
		 * Makes the chat window the active window and puts
		 * focus on the input control on incoming message posts.
		 * @param type string Event name
		 * @param args object Event arguments
		 */
		_onChatPostResponse: function(type, args)
		{  
			document.title = "Assistance en direct";
			var isEndUserPost = args[0].data.isEndUserPost;
			this.change_title;
			var counter = 1;
			if (document.visibilityState == "visible") {
			  //console.log("pageshow event fired - the page is now shown");
			  var isWindowFocussed = true;
			}
			else
			{
				var isWindowFocussed = false;	
			}
			//console.log(isWindowFocussed);
			
			if((!args[0].data.isEndUserPost)||(this.globalcounter == 0))
			{
				//console.log("number 1");
				if(this.data.attrs.focus_on_incoming_messages)
				{
					//console.log("number 2");
					this.input.set('disabled', false);
					var interval_id;
					if(isWindowFocussed == true)
					{
						
						//console.log("number 3"+this.change_title);
						clearInterval(this.change_title);
						counter = 0;
						document.title = "Assistance en direct";
					}
					else
					{
						
						counter = 1;
						this.change_title = setInterval(function() {
							if(counter !=0)
							{
								if (counter++ % 2) {
									document.title = "Beachbody dit..."; // Call Function 1
								} else {
									document.title = "Assistance en direct"; // Call Function 2
								}
							}
						}, 500);
						try
						{
							document.getElementById('interval_id').value = this.change_title;
						}
						catch(err) {}
						//console.log("number 5");
					}
					top.window.focus();
					this.input.focus();
				}
				else if(this._vaMode)
				{
					this.input.set('disabled', false);
					this.input.focus();
				}
			}
			this.globalcounter = 1;
		}

        /**
         * Overridable methods from ChatPostMessage:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onChatStateChangeResponse: function(type, args)
        // _onValueChange: function(e)
        // _onEnterKey: function(e)
        // _onChatPostLengthExceededResponse: function(type, eventObject)
        // _enableControls: function()
        // sendText: function()
        // _onChatPostResponse: function(type, args)
        // _onChatEngagementParticipantAddedResponse: function(type, args)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	checkFocus: function() {
		this.abc =setInterval(function(){
			try
			{
				var title = document.title;
				if(title != "Assistance en direct" && title != "Beachbody dit...")
				{
					document.title = "Assistance en direct";
				}
			}
			catch (err)
			{}
			if (document.visibilityState == "visible") 
			{
				var c = 0;
				try
				{
					c = parseInt(document.getElementById('interval_id').value);
				}
				catch(err) {}
				document.title = "Assistance en direct";
				if(c)
				{
					clearInterval(c);	
				}
			} 
		}, 5);
	}
});
