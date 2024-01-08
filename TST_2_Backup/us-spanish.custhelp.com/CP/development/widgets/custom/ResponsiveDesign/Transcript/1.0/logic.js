RightNow.namespace('Custom.Widgets.ResponsiveDesign.Transcript');
Custom.Widgets.ResponsiveDesign.Transcript = RightNow.Widgets.ChatTranscript.extend({ 
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
			//alert("testing");
            this.parent();
        },
		/**
     * Handles when chat session is terminated.
     * @param type string Event name
     * @param args object Event arguments
     */
    _onChatDisconnect: function(type, args) {
		//alert("_onChatDisconnect");
        if(this.data.attrs.is_persistent_chat)
        {
            this._active = false;
            var messages = [];
            var context = null;
            if(args[0].data.isUserDisconnect)
            {
                if(args[0].data.reason === 'IDLE_TIMEOUT')
                {
                    messages.push(RightNow.Interface.getMessage("DISCONNECTED_CHAT_DUE_INACTIVITY_MSG"));
                }
                else
                {
                    messages.push(this.data.attrs.label_you);
                    messages.push(this.data.attrs.label_have_disconnected);
                    context = args[0].data;
                }
            }
            else
            {
                var agent = args[0].data.agent;
                messages.push(agent.name);
                messages.push(this.data.attrs.label_has_disconnected);
            }
            messages.push(this.data.attrs.label_restart_chat_text);
            var postData = {
                attrs: null,
                messages: messages,
                context: context
            }
            var _postData = JSON.parse(JSON.stringify(postData));
            var key = this._ls._disconnectPrefix + new Date().getTime();
            _postData.chatWindowId = this._ls._thisWindowId;
            _postData.type = 'CHAT_DISCONNECT';
            this._ls.setItem(key, _postData);
            setTimeout(function() {
              this._ls.removeItem(key);
            }, 5000);
        }
    },

    /**
     * Handles the state of the chat has changed.
     * @param type string Event name
     * @param args object Event arguments
     */
    _onChatStateChangeResponse: function(type, args)
    {
		//alert("_onChatStateChangeResponse");
        var currentState = args[0].data.currentState;
        var previousState = args[0].data.previousState;
        var ChatState = RightNow.Chat.Model.ChatState;
        var newMessage = null;

        if(currentState === ChatState.CONNECTED)
            RightNow.UI.show(this._transcriptContainer);
        else if(currentState === ChatState.RECONNECTING)
        {
            this._stateBeforeReconnect = previousState;
            if(previousState === ChatState.CONNECTED)
                newMessage = RightNow.Interface.getMessage("COMM_RN_LIVE_SERV_LOST_PLS_WAIT_MSG");
        }
        else if(currentState === ChatState.DISCONNECTED && (args[0].data.reason === 'RECONNECT_FAILED' || args[0].data.reason === 'ERROR'))
        {
            newMessage = RightNow.Interface.getMessage("COMM_RN_LIVE_SERV_LOST_CHAT_SESS_MSG");
            if(this.data.attrs.is_persistent_chat)
            {
                newMessage = null;
            }
        }

        if (currentState === ChatState.DISCONNECTED || currentState === ChatState.REQUEUED) {
            // notify videochat widget to end video chat
            this._transcript.all('.rn_VideoChatAction').remove();
        }

        if(currentState === ChatState.CONNECTED && previousState === ChatState.RECONNECTING)
            newMessage = RightNow.Interface.getMessage("CONNECTION_RESUMED_MSG");
		//alert("clear console");
		//alert(newMessage);
		console.log(newMessage);
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
    * Event received when a participant joins the chat. Adds note to transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _onChatEngagementParticipantAddedResponse: function(type, args)
    {
		//alert("_onChatEngagementParticipantAddedResponse");
		
		var question = null;
		if(this.data.js.question_thread)
		{
			question =this.data.js.question_thread;	
		}
		
		 var eo = new RightNow.Event.EventObject(this, {data: {
            messageBody: question,
            isEndUserPost: true,
            isOffTheRecord: false
        }});

        RightNow.Event.fire("evt_chatPostMessageRequest", eo);
		
		
		
        var agent = args[0].data.agent;
        var role = args[0].data.role;
        var message = "";

        if(role === "LEAD")
        {
			//alert("lead");
			//alert(agent.greeting);
			//alert(this.data.attrs.label_has_joined_chat);
			
            if(RightNow.Chat.UI.Util.hasLeaveScreenIssues())
            {
                this._appendEJSToChat(this.getStatic().templates.systemMessage, {
                    attrs: this.data.attrs,
                    messages: [this.data.attrs.label_leave_screen_warning],
                    context: null
                });
            }

            this._transcript.all('.rn_VideoChatAction').remove();
            message = agent.greeting;//"Hi, let me take a quick look at your question, and we'll get started";/*': ' + agent.greeting;*/
        }
        else
        {
            message = this.data.attrs.label_has_joined_chat;/*' ' + this.data.attrs.label_has_joined_chat;*/
        }

            //test="jpj"+message; 
        this._appendEJSToChat(this.getStatic().templates.participantAddedResponse, {
            template: 'participantAddedResponse',
            attrs: this.data.attrs,
            agentName: this._getAgentIdString(args[0].data.agent.name),
            role: role,
            message: message,
            createdTime: args[0].data.createdTime     
        });
    },

    /**
    * Event received when participant leaves the chat. Adds note to transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _onChatEngagementParticipantRemovedResponse: function(type, args)
    {
		//alert("_onChatEngagementParticipantRemovedResponse");
        var reason = args[0].data.reason;
        var agent = args[0].data.agent;

        if(!agent)
            return;

        this._appendEJSToChat(this.getStatic().templates.systemMessage, {
            attrs: this.data.attrs,
            messages: [this._getAgentIdString(agent.name), (args[0].data.reason === RightNow.Chat.Model.ChatDisconnectReason.TRANSFERRED_TO_QUEUE ? this.data.attrs.label_has_disconnected : this.data.attrs.label_has_left_chat)],
            context: null
        });
    },
    /**
     * Handles adding a new chat post to the transcript.
     * @param type string Event name
     * @param args object Event arguments
     */
    _onChatPostResponse: function(type, args)
    {
        var message = args[0].data.messageBody;
        var messageId = args[0].data.messageId;
        var isEndUserPost = args[0].data.isEndUserPost;
        var postID;
        var name;

        // ignore duplicate messages
        if (messageId !== undefined && typeof(this._messageIds) !== "undefined") {
            if (this._messageIds[messageId] !== undefined)
                return;

            this._messageIds[messageId] = 1;
        }

        if (!this.data.attrs.mobile_mode && args[0].data.isEndUserPost === true)
            message = this._formatLinks(message);
        else if (args[0].data.richText === undefined || args[0].data.richText === false)
            message = this.Y.Escape.html(message).replace(/\n/g, "<br/>");
        else if(!this.data.attrs.mobile_mode)
            message = this._formatLinks(message);

        if(args[0].data.isOffTheRecord)
            message = this.data.attrs.label_off_the_record + ' ' + message;

        if(args[0].data.isEndUserPost)
        {
            postID = 'eup_' + messageId;
            this._setEndUserName(args);
            name = this._endUserName;
        }
        else
        {
            postID = args[0].data.serviceFinishTime;
            name = this._getAgentIdString(args[0].data.agent.name);
        }

        this._appendEJSToChat(this.getStatic().templates.chatPostResponse, {
                template: 'chatPostResponse',
                attrs: this.data.attrs,
                endUserName: name,
                agentName: name,
                message: message,
                createdTime: args[0].data.createdTime,
                context: args[0].data
        }, postID);
    },

    _setEndUserName: function(args)
    {
		//alert("_setEndUserName");
        // Only parse enduser name once; it won't change, and this function is hit often, so this tweak is worthwhile.
        //if(!this._endUserName || this._endUserName === '')
        //{
            var endUser = args[0].data.endUser;

            if(endUser.firstName === null && endUser.lastName === null)
            {
                if(endUser.email === null)
                    this._endUserName = "";//this.data.attrs.label_enduser_name_default_prefix;
                else
                    this._endUserName = "";//endUser.email;
            }
            else
            {
                if(endUser.firstName !== null && endUser.lastName !== null)
                {
                    var internationalNameOrder = RightNow.Interface.getConfig("intl_nameorder", "COMMON");
                    this._endUserName = "";//internationalNameOrder ? endUser.lastName + " " + endUser.firstName : endUser.firstName + " " + endUser.lastName;
                }
                else if(endUser.firstName !== null)
                {
                    this._endUserName = "";//endUser.firstName;
                }
                else
                {
                    this._endUserName = "";//endUser.lastName;
                }

                this._endUserName += RightNow.Interface.getMessage("NAME_SUFFIX_LBL");

                // Ensure that any < or > characters are escaped to avoid vulnerabilities
                this._endUserName = this._endUserName.replace(/</g, "&lt;");
                this._endUserName = this._endUserName.replace(/>/g, "&gt;");
            }
        //}
    },
    /**
    * Event received when a post has been successfuly sent
    * @param response object Event response object
    */
    _onChatPostCompletion: function(type, args)
    {
		//alert("_onChatPostCompletion");
        var messageId = args[0];
        var timestamp = args[1];
        var post = this.Y.one('#eup_' + messageId);
        var insertNode;

        if(post)
        {
            post.set('id', timestamp);

            if(post.previous() && post.previous().get('id') > timestamp)
            {
                insertNode = post.previous();
                post.remove();
                insertNode.insert(post, "before");
            }
            else if(post.next() && post.next().id < timestamp)
            {
                insertNode = post.next();
                post.remove();
                insertNode.insert(post, "after");
            }
        }
    },
    /**
    * Event received when the engagement has been concluded. Adds note to transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _onChatEngagementConcludedResponse: function(type, args)
    {
		//alert("_onChatEngagementConcludedResponse");
        var agent = args[0].data.agent;
        var messages = [];
        var context = null;

        this._transcript.all('.rn_CoBrowseAction').remove();
        this._transcript.all('.rn_VideoChatAction').remove();
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
            messages.push(agent.name);
            messages.push(this.data.attrs.label_has_disconnected);
        }

        if(this.data.attrs.is_persistent_chat)
        {
            messages.push(this.data.attrs.label_restart_chat_text);
        }

        this._appendEJSToChat(this.getStatic().templates.systemMessage, {
            attrs: this.data.attrs,
            messages: messages,
            context: context
        });
    },
   
    /**
    * Event received when an agent has gone absent. Adds note to transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _agentAbsentUpdateResponse: function(type, args)
    {
		//alert("_agentAbsentUpdateResponse");
        if(args[0].data.requeueSeconds)
            this._appendEJSToChat(this.getStatic().templates.systemMessage, {
                attrs: this.data.attrs,
                messages: [RightNow.Interface.getMessage("REQUEUED_APPROXIMATELY_0_MSG").
                                    replace("{0}", args[0].data.requeueSeconds)],
                context: null
            });
    },
   
    /**
    * Event received when a reconnect status update is triggered. Adds a note about the reconnection attempt status to the transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _reconnectUpdateResponse: function(type, args)
    {
		//alert("_reconnectUpdateResponse");
        if(this._stateBeforeReconnect === RightNow.Chat.Model.ChatState.CONNECTED)
            this._appendEJSToChat(this.getStatic().templates.systemMessage, {
                attrs: this.data.attrs,
                messages: [RightNow.Interface.getMessage("DISCONNECTION_IN_0_SECONDS_MSG")
                                           .replace("{0}", args[0].data.secondsLeft)],
                context: null
            });
    },
    /**
    * Event received when an agent's status is changed. Notes about the status change are added to the transcript.
    * @param type string Event name
    * @param args object Event arguments
    */
    _onAgentStatusChangeResponse: function(type, args)
    {
		//alert("_onAgentStatusChangeResponse");
        var agent = args[0].data.agent;
        if(!agent)
            return;

        var message = null;
        if(agent.activityStatus === RightNow.Chat.Model.ChatActivityState.ABSENT)
            message = RightNow.Interface.getMessage("COMM_DISP_NAME_LOST_PLS_WAIT_MSG");
        else if(args[0].data.previousState === RightNow.Chat.Model.ChatActivityState.ABSENT)
            message = RightNow.Interface.getMessage("COMM_DISPLAY_NAME_RESTORED_MSG");
		//alert("abc");
		//alert(message);
        if(message !== null)
            this._appendEJSToChat(this.getStatic().templates.agentStatusChangeResponse, {
                template: 'agentStatusChangeResponse',
                attrs: this.data.attrs,
                message: message,
                agentName: agent.name
            });
    },
    /**
    * Function is used to pre-load all images that could be used in the chat transcript. Avoids issues delays showing new images in transcript.
    * Also avoids a bug where connection is lost and an icon is used in the transcript.
    */
    _preloadImages: function()
    {
		//alert("_preloadImages");
        var imageArray = [];

        imageArray.push(this.data.attrs.alert_icon_path);
        imageArray.push(this.data.attrs.agent_message_icon_path);
        imageArray.push(this.data.attrs.off_the_record_icon_path);
        imageArray.push(this.data.attrs.video_chat_icon_path);

        if(!this.data.attrs.mobile_mode)
            imageArray.push(this.data.attrs.cobrowse_icon_path);

        if(this.data.attrs.enduser_message_icon_path)
            imageArray.push(this.data.attrs.enduser_message_icon_path);

        for(var x = 0; x < imageArray.length; x++)
            eval("var imageObject" + x + " = new Image(); imageObject" + x + ".src = imageArray[x];");
    },

    /**
     * Handles adding a new chat post to the transcript.
     * @param postText object EJS object
     * @param postData object JSON object containing data to be passed to EJS
     * @param postID string (optional) If desired, an ID can be assigned to the created EJS by specifying this attribute
     */
    _appendEJSToChat: function(postText, postData, postID)
    {
		//alert("_appendEJSToChat");
        var newEntry = this.Y.Node.create(new EJS({text: postText}).render(postData));
		newEntry._node.innerHTML = newEntry._node.innerHTML.replace(':','');
		/*console.log(newEntry._node.innerText);
		var mystring = newEntry._node.innerText;
		mystring = mystring.replace(':','');
		newEntry._node.innerText = mystring;*/
        var _postData;

        if(postID !== undefined)
        {
            newEntry.set("id", postID);
        }

        this._transcript.appendChild(newEntry);
        if(this.data.attrs.is_persistent_chat && this._ls.isSupported && this.Y.Cookie.get("CHAT_SESSION_ID"))
        {
            _postData = JSON.parse(JSON.stringify(postData));
            //don't store these properties in local storage
            delete _postData.attrs;
            if(_postData.context)
            {
                delete _postData.context.w_id;
                delete _postData.context.rn_contextData;
                delete _postData.context.rn_contextToken;
                delete _postData.context.rn_timestamp;
                delete _postData.context.rn_formToken;
            }
            var key = this._ls._transcriptPrefix + new Date().getTime(),
                chatSessionID = this.Y.Cookie.get("CHAT_SESSION_ID");

            _postData.chatWindowId = this._ls._thisWindowId;
            _postData.type = 'CHAT_TRANSCRIPT';
            if(_postData && _postData.createdTime)
            {
                var lastUpdatedKey = this._ls._lastUpdateKey + chatSessionID,
                    lastUpdated = this._ls.getItem(lastUpdatedKey);

                if(!lastUpdated || lastUpdated < _postData.createdTime)
                {
                    this._ls.setItem(key, _postData);
                    this._ls.bufferItem(chatSessionID, _postData);
                    this._ls.setItem(lastUpdatedKey, _postData.createdTime);
                }
            }
            else
            {
                this._ls.bufferItem(chatSessionID, _postData);
                this._ls.setItem(key, _postData);
            }

            var ls = this._ls;
            setTimeout(function() {
              ls.removeItem(key);
            }, 2500);
        }

        // Using scrollIntoView doesn't have consistent behavior across browsers (particularly IE). Use YUI Anim instead.
        var scrollAnim = new this.Y.Anim({
            node: this._transcriptContainer,
            to: {
                scroll: function(node) { return [0, node.get('scrollHeight')] }
            }
        }).run();

        if(this.data.attrs.unread_messages_titlebar_enabled && !this._windowFocused)
        {
            document.title = '(' + (++this._unreadCount) + ') ' + this._baseTitle;
        }
    },

    /**
     * Handles adding a new chat post to the transcript when chat post is stored in the local storage.
     * @param type string Event name
     * @param args object Event arguments
     */
    _appendEJSToOtherChatWindow: function(type, args)
    {
		//alert("_appendEJSToOtherChatWindow");
        if((!this.Y.Cookie.get("CHAT_SESSION_ID") || this._active === false) && type !== 'evt_notifyChatDisconnect')
        {
            return;
        }
        if(type === 'evt_notifyChatDisconnect')
        {
           this._active = false;
        }
        var postText,
            postData = args[0].data,
            template = postData.template ? postData.template : '';

        postData.attrs = this.data.attrs;
		//alert("template");
		//alert(template);
        switch(template)
        {
            case 'chatPostResponse':
                postText = this.getStatic().templates.chatPostResponse;
                break;
            case 'participantAddedResponse':
                postText = this.getStatic().templates.participantAddedResponse;
                break;
            case 'agentStatusChangeResponse':
                postText = this.getStatic().templates.agentStatusChangeResponse;
                break;
            case 'CoBrowsePremiumInvitationResponse':
                postText = this.getStatic().templates.CoBrowsePremiumInvitationResponse;
                break;
            case 'systemMessage':
                postText = this.getStatic().templates.systemMessage;
                break;
        }
        if(postText === undefined)
        {
			//alert("2233");
            postText = this.getStatic().templates.systemMessage;
            postData.messages = postData.messages || [];
        }

        if(postData && postData.context && postData.context.isEndUserPost && this._transcript.one('.rn_AgentTextPrefix'))
        {
            var newEntry = this.Y.Node.create(new EJS({text: postText}).render(postData));
			//alert("new entry");
			//alert(newEntry);
			console.log(newEntry);
            this._transcript.appendChild(newEntry);
        }
        else
        {
			//alert("1111");
            var newEntry = this.Y.Node.create(new EJS({text: postText}).render(postData));
            this._transcript.appendChild(newEntry);
        }

        // Using scrollIntoView doesn't have consistent behavior across browsers (particularly IE). Use YUI Anim instead.
        var scrollAnim = new this.Y.Anim({
            node: this._transcriptContainer,
            to: {
                scroll: function(node) { return [0, node.get('scrollHeight')] }
            }
        }).run();

        if(this.data.attrs.unread_messages_titlebar_enabled && !this._windowFocused)
        {
            document.title = '(' + (++this._unreadCount) + ') ' + this._baseTitle;
        }
    },

    /**
    * Format anchor tags and optionally text URLs into a clickable link in transcript.
    * @param text string Input text to process
    */
    _formatLinks: function(text)
    {
		//alert("_formatLinks");
        var newText = '';
        var stringArray;
        var tempString = text;
        var titles = {};
        var hrefs = {};
        var descs = {};
        var tags = {};
        var quotedUrls = {};
        var aMatches = 0;
        var qMatches = 0;
        var tMatches = 0;
        var anchorMatch = "";

        while(anchorMatch = tempString.match(this._anchorRE))
        {
            descs[aMatches] = anchorMatch[2];
            stringArray = tempString.split(anchorMatch[0]);

            var title = anchorMatch[0].match(this._titleRE);
            if(title != null)
                titles[aMatches] = title[1];

            href = hrefs[aMatches] = anchorMatch[0].match(this._hrefRE);
            if(href != null)
            {
                hrefs[aMatches] = href[1];

                if(!hrefs[aMatches].match(/^(http(s)?)/i))
                    hrefs[aMatches] = "http://" + hrefs[aMatches];

                newText += stringArray[0] + "{RNTAMATCH" + aMatches + "}";

                aMatches++;
            }

            if(stringArray.length > 0)
            {
                stringArray.shift();
                tempString = stringArray.join(anchorMatch[0]);
            }
        }

        if(aMatches !== 0)
        {
            newText += tempString;
            tempString = newText;
            newText = "";
        }
        tempString = tempString.replace(this._tagBR,'{BR}'); 
        //Replace tags with tokens so we don't end up with tags inside tags
        while(urlMatch = tempString.match(this._tagRE))
        {
             tags[tMatches] = urlMatch[0];
             tempString = tempString.replace(urlMatch[0], "{RNTTMATCH" + tMatches + "}");
             tMatches++;
        }

        //Replace quoted URL's so we don't modify those
        var urlMatch = "";
        while(urlMatch = tempString.match(this._quotedUrlRE))
        {
            quotedUrls[qMatches] = urlMatch[0];
            tempString = tempString.replace(urlMatch[0], "{RNTQMATCH" + qMatches + "}");
            qMatches++;
        }

        while(urlMatch = tempString.match(this._urlRE))
        {
            var href = urlMatch[0];
            stringArray = tempString.split(urlMatch[0]);

            if(urlMatch[0].match(/^ftp\./i))
                href = "ftp://" + urlMatch[0];
            else if(!urlMatch[0].match(/^(http(s)?|ftp)/i))
                href = "http://" + urlMatch[0];

            var replace = "<a href='" + href + "' target='_blank'>" + urlMatch[0] + "</a>";
            newText += stringArray[0] + replace;

            if(stringArray.length > 0)
            {
                stringArray.shift();
                tempString = stringArray.join(urlMatch[0]);
            }
        }

        newText += tempString;

        //Return the quoted URLs
        if(qMatches > 0)
        {
            for(var x = 0; x < qMatches; x++)
                newText = newText.replace("{RNTQMATCH" + x + "}", quotedUrls[x]);
        }

        if(tMatches > 0)
        {
            for(var x = 0; x < tMatches; x++)
                newText = newText.replace("{RNTTMATCH" + x + "}", tags[x]);
        }

        if(aMatches > 0)
        {
            for(var x = 0; x < aMatches; x++)
            {
                if(this.data.attrs.mobile_mode)
                    newText = newText.replace("{RNTAMATCH" + x + "}", descs[x] == null ? hrefs[x] : descs[x] + ' (' + hrefs[x] + ')');
                else
                    newText = newText.replace("{RNTAMATCH" + x + "}", "<a href='" + hrefs[x] + "' " + (titles[x] == null ? "" : "title=\"" + titles[x] + "\" ") + " target=\"_blank\">" + (descs[x] == null ? hrefs[x] : descs[x]) + "</a>");
            }
        }

        newText = newText.replace(/{BR}/g,"</br>");
        return newText;
    },
    _getAgentIdString: function(agentName)
    {
        return "";//return this.data.attrs.agent_id.replace(/{display_name}/g, agentName);
    },

    /**
    * Handles when the window gains focus.
    */
    _onApplicationFocus: function()
    {
        this._windowFocused = true;
        this._unreadCount = 0;

        document.title = this._baseTitle;
    },

    /**
    * Handles when the window loses focus.
    */
    _onApplicationBlur: function()
    {
        this._windowFocused = false;
    },
    /**
    * Event handler when CobrowsePremium Allow is clicked in the transcript.
    * @param e boolean event
    */
    onAllowCoBrowsePremiumClick: function (e)
    {
        e.halt();
        var target = e.currentTarget,
            agentEnvironment = target.getAttribute('data-agentEnvironment'),
            coBrowseSessionId = target.getAttribute('data-coBrowseSessionId');
        RightNow.Widgets.ChatTranscript.sendCoBrowsePremiumResponse(true, agentEnvironment, coBrowseSessionId);
    },
    /**
    * Event handler when CobrowsePremium Decline is clicked in the transcript.
    */
    onDeclineCoBrowsePremiumClick: function ()
    {
        RightNow.Widgets.ChatTranscript.sendCoBrowsePremiumResponse(false);
    },
    /**
    * Event handler when video chat Allow is clicked in the transcript.
    * @param e boolean event
    */
    onAllowVideoChatClick: function (e)
    {
        e.halt();
        var target = e.currentTarget;
        RightNow.Event.fire("evt_chatVideoChatAllowClicked",  e);

        var target = e.currentTarget,
            videoChatSessionId = target.getAttribute('data-videoChatSessionId');

        RightNow.Widgets.ChatTranscript.sendVideoChatResponse(true, videoChatSessionId);
    },
    /**
    * Event handler when Video Chat Decline is clicked in the transcript.
    */
    onDeclineVideoChatClick: function ()
    {
        RightNow.Widgets.ChatTranscript.sendVideoChatResponse(false);
    }
	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});