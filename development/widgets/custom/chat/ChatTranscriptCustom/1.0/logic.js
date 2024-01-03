RightNow.namespace('Custom.Widgets.chat.ChatTranscriptCustom');
Custom.Widgets.chat.ChatTranscriptCustom = RightNow.Widgets.ChatTranscript.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
	 
	
	 
	 
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatTranscript#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            // EN
            this.parent();	
			
        },
		
		
		_onChatStateChangeResponse: function(type, args)
    {
        var currentState = args[0].data.currentState;
        var previousState = args[0].data.previousState;
        var ChatState = RightNow.Chat.Model.ChatState;
        var newMessage = null;
		var s_id=document.getElementById("rn_session").innerHTML;
		var emailid=document.getElementById("rn_email").innerHTML;
		var chatid=RightNow.Chat.Controller.ChatCommunicationsController._engagementID;
        if(currentState === ChatState.DISCONNECTED  &&  previousState ===ChatState.CONNECTED)
		{
			$('.rn_StatusPrefix').addClass('rn_StatusPostfix').removeClass('rn_StatusPrefix');
			var sid=document.getElementById("hiddensid").value;
            // window.location.href = 'https://care.inflightinternet.com/app/chat/chat_survey/sid/'+sid;
            if(RightNow.Url.getParameter('tailNumber')){
                window.location.href = 'https://care.inflightinternet.com/app/chat/chat_survey/sid/'+sid+
                '/flightNumber/'+RightNow.Url.getParameter('flightNumber')+'/flightOrigin/'+
                RightNow.Url.getParameter('flightOrigin')+'/flightDestination/'+RightNow.Url.getParameter('flightDestination')+
                '/tailNumber/'+RightNow.Url.getParameter('tailNumber')+'/clang/'+RightNow.Url.getParameter('clang');
            }
            else{
                window.location.href = 'https://care.inflightinternet.com/app/chat/chat_survey/sid/'+sid;
            }
		}



        if(currentState === ChatState.CONNECTED)
            RightNow.UI.show(this._transcriptContainer);
        else if(currentState === ChatState.RECONNECTING)
        {
            this._stateBeforeReconnect = previousState;
            if(previousState === ChatState.CONNECTED)
                newMessage = RightNow.Interface.getMessage("COMM_RN_LIVE_SERV_LOST_PLS_WAIT_MSG");
        }
        else if(currentState === ChatState.DISCONNECTED && (args[0].data.reason === 'RECONNECT_FAILED' || args[0].data.reason === 'ERROR'))
            newMessage = RightNow.Interface.getMessage("COMM_RN_LIVE_SERV_LOST_CHAT_SESS_MSG");

        if(currentState === ChatState.CONNECTED && previousState === ChatState.RECONNECTING)
		{
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/setcount/', {s_id:s_id,chatid:chatid,emailid:emailid}, {
				successHandler: function(response) {
					//$('#waitingmessage').hide();
					}
			});
            newMessage = RightNow.Interface.getMessage("CONNECTION_RESUMED_MSG");
		}

        if(newMessage !== null)
        {
            this._appendEJSToChat(this.getStatic().templates.systemMessage, {
                attrs: this.data.attrs,
                messages: [newMessage],
                context: null
            });
        }
    },

        /**
         * Overridable methods from ChatTranscript:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onChatStateChangeResponse : function(type, args)
        // _onChatEngagementParticipantAddedResponse : function(type, args)
		
		_onChatEngagementParticipantAddedResponse : function(type, args)
    {		
        var agent = args[0].data.agent;
        var role = args[0].data.role;
        var message = "";
		var s_id=document.getElementById("rn_session").innerHTML;
		var emailid=document.getElementById("rn_email").innerHTML;
		var chatid=RightNow.Chat.Controller.ChatCommunicationsController._engagementID;
		//document.getElementById("chatid").innerHTML=chatid;
		RightNow.Ajax.makeRequest('/cc/AjaxCustom/setsession/', {s_id:s_id,emailid:emailid,chatid:chatid}, {
					successHandler: function(response) {
					console.log(response);
					
					}
			});

        if(role === "LEAD")
        {
			var Name = this._getAgentIdString(agent.name) +' ';  
            message = ': ' + agent.greeting.replace(agent.name,Name);
        }
        else
        {
            message = ' ' + this.data.attrs.label_has_joined_chat;
        }

        this._appendEJSToChat(this.getStatic().templates.participantAddedResponse, {
            attrs: this.data.attrs,
            agentName: this._getAgentIdString(args[0].data.agent.name),
            role: role,
            message: message
        });

	},

        // _onChatEngagementParticipantRemovedResponse : function(type, args)
         //_onChatPostResponse : function(type, args);
        // _setEndUserName : function(args)
        // _onChatPostCompletion : function(type, args)
        // _onChatEngagementConcludedResponse : function(type, args)
		
		    _onChatEngagementConcludedResponse : function(type, args)
    {
        var agent = args[0].data.agent;
        var messages = [];
        var context = null;
		
		
		// agent should never be null if isUserDisconnect is null or false.
        if(args[0].data.isUserDisconnect)
        {
            if(args[0].data.reason === 'IDLE_TIMEOUT')
                messages.push(RightNow.Interface.getMessage("DISCONNECTED_CHAT_DUE_INACTIVITY_MSG"));
            else
            {
                messages.push(this.data.attrs.label_you);
                messages.push(this.data.attrs.label_have_disconnected);
                context = args[0].data;
            }
        }
        else
        {
            messages.push(this._getAgentIdString(args[0].data.agent.name));
            messages.push(this.data.attrs.label_has_disconnected);
        }

        this._appendEJSToChat(this.getStatic().templates.systemMessage, {
            attrs: this.data.attrs,
            messages: messages,
            context: context
        });
    },
		
        // _fileNotifyResponse : function(type, args)
        // _fileUploadResponse : function(type, args)
        // _agentAbsentUpdateResponse : function(type, args)
        // _coBrowseInvitationResponse : function(type, args)
        // _coBrowseAcceptResponse : function(type, args)
        // _coBrowseStatusResponse : function(type, args)
        // _reconnectUpdateResponse : function(type, args)
        // _onAgentStatusChangeResponse : function(type, args)
        // _preloadImages : function()
        // _appendEJSToChat : function(postText, postData, postID)
		 _appendEJSToChat : function(postText, postData, postID)
    {
        var newEntry = this.Y.Node.create(new EJS({text: postText}).render(postData));

        if(postID !== undefined)
            newEntry.set("id", postID);

        this._transcript.appendChild(newEntry);

        // Using scrollIntoView doesn't have consistent behavior across browsers (particularly IE). Use YUI Anim instead.
        var scrollAnim = new this.Y.Anim({
            node: this._transcriptContainer,
            to: { 
                scroll: function(node) { return [0, node.get('scrollHeight')] }
            }
        }).run();

        if(this.data.attrs.unread_messages_titlebar_enabled && !this._windowFocused)
            document.title = '(' + (++this._unreadCount) + ') ' + this._baseTitle;
    },
        // scroll: function(node)
        // _formatLinks : function(text)
        // _getAgentIdString : function(agentName)
		
		
		/* Moncy --to trim agent firstname*/
		 _getAgentIdString : function(agentName)
    {	
	  
		var resArray = agentName.split(" "); 	
		return resArray[0];	
		
		
    }
		
		
		
    },
        // _onApplicationFocus: function()
        // _onApplicationBlur : function()
        // sendCoBrowseResponse : function(accepted, coBrowseUrl)
		
	
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});