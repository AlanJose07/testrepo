RightNow.namespace('Custom.Widgets.ResponsiveDesign.ProactiveChatCustom');
Custom.Widgets.ResponsiveDesign.ProactiveChatCustom = RightNow.Widgets.ProactiveChat.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ProactiveChat#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },

		/**
		 * Initiates polling for availability and subsequent prompt if agents become available.
		 * @param {String} type Event name
		 * @param {Object} args Event arguments
		 */
		_start: function(type, args){
			//alert("in start");
			// 1. Verify that we have the minimum required args data.
			// 2. Don't offer chat if the end user is already in a chat session.
			// 3. Don't offer chat if the 'noChat' cookie is set and we are not ignoring it and not in test mode.
			// 4. Don't offer chat more than once if the custom launch event says so.
			if(!args[0] || !args[0].data || this.Y.Cookie.get("CHAT_SESSION_ID") ||
			  (this.Y.Cookie.get('noChat') && !args[0].data.ignoreCookie && !this.data.attrs.test) ||
			  (this._confirmDialog && args[0].data.offerOnlyOnce))
				return;
	
			// Subscribe to event fired on prod/cat change on pages such as the answer's "Advanced Search"
			RightNow.Event.subscribe("evt_productCategoryFilterSelected", this._onProdCatChanged, this);
	
			// Check searches trigger if available. If unavailable or if told to ignore triggers from
			// the custom launch event, just mark the searches check as done.
			if(this.data.js.searches_to_do && !args[0].data.ignoreTriggers)
			{
				if (this.data.js.searches >= this.data.attrs.searches)
				{
					this._searchDone = true;
				}
				else
				{
					this._searchDone = false;
					RightNow.Event.subscribe("evt_searchRequest", this._onSearchCountChanged, this);
				}
			}
			else
			{
				this._searchDone = true;
			}
	
			// Check profile trigger if available. If unavailable or if told to ignore triggers from
			// the custom launch event, just mark the profile check as done.
			if(this.data.js.profile_to_do && !args[0].data.ignoreTriggers)
			{
				if (this.data.js.profile)
				{
					this._profileDone = true;
				}
				else
				{
					this._profileDone = false;
				}
			}
			else
			{
				this._profileDone = true;
			}
	
			// Check delay trigger if available. If unavailable or if told to ignore triggers from
			// the custom launch event, just mark the delay check as done.
			if(this.data.js.seconds_to_do && !args[0].data.ignoreTriggers)
			{
				this._secondsDone = false;
				setTimeout("RightNow.Widgets.getWidgetInstance('" + this.instanceID + "').onSeconds()", this.data.attrs.seconds * 1000);
			}
			else
			{
				this._secondsDone = true;
			}
	
			this._visitorId = args[0].data.visitor_id;
			this._engagementEngineId = args[0].data.ee_id;
			this._estaraId = args[0].data.estara_id;
			this._engagementEngineSessionId = args[0].data.ee_session_id;
			this._eeWidgetId = args[0].data.instance_id;
	
			this._checkDoneStatus();
		},
	
		/**
		 *Publishes PAC stats to DQA
		 */
		_publishStats: function(statAction){
			//alert("publish stats");
			RightNow.Ajax.CT.submitAction(RightNow.Ajax.CT.WIDGET_STATS, statAction);
		},
	
		/*
		* fire event if all status types are done
		*
		*/
		_checkDoneStatus: function()
		{
			//alert("check done status");
			if(this._profileDone && this._searchDone && this._secondsDone)
			{
				this._waiting = true;
				if (this.data.attrs.test == 'true')
				{
					this._onQueueReceived(null, new Array(""));
				}
				else if(RightNow.Event.fire("evt_chatQueueRequest", this._eo))
				{
					RightNow.Ajax.makeRequest(this.data.attrs.get_chat_info_ajax, this._eo.data, {successHandler: this._onQueueReceived, scope: this, json: true, data: this._eo});
				}
			}
		},
	
		/**
		 * Event handler for when the number of searches has been incremented
		 * @param {String} type Event name
	
		 * @param {Object} args Event arguments
		 */
		 _onSearchCountChanged: function(type, args)
		{
			//alert("in search count changed");
			this.data.js.searches++;
			if(this.data.js.searches >= this.data.attrs.searches)
			{
				RightNow.Event.unsubscribe("evt_searchRequest", this._onSearchCountChanged);
				this._searchDone = true;
				this._checkDoneStatus();
			}
		},
	
		/**
		 * Event handler for when the number of seconds has been completed
		 */
		 onSeconds: function()
		{
			//alert("in sec");
			this._secondsDone = true;
			this._checkDoneStatus();
		},
	
		/**
		 * Event handler for server sends response.
		* @param {Object} response Server response
		* @param {Object} origEventObject original event object
		 */
		 _onQueueReceived: function(response, origEventObject)
		{
			//alert("on queue received");
			if(RightNow.Event.fire("evt_chatQueueResponse", {response: response, data: origEventObject}) && this._waiting)
			{
				if(!response && this.data.attrs.test === "true")
				{
					response = {
						q_id: 1,
						stats: {
							availableSessionCount: this.data.attrs.min_agents_avail,
							expectedWaitSeconds: this.data.attrs.wait_threshold
						}
					};
				}
				else if(!response)
				{
					return;
				}
	
				this._waiting = false;
	
				//analyze the queue id and the chat stats
				if((response.q_id > 0 && response.stats.availableSessionCount >= this.data.attrs.min_agents_avail && response.stats.expectedWaitSeconds <= this.data.attrs.wait_threshold))
				{
					this._publishStats({w:this.data.js.dqaWidgetType.toString(), offers:1});
	
					var eo = new RightNow.Event.EventObject(this, {data: {
						id: this._eeWidgetId,
						name: 'ProactiveChat'
					}});
					RightNow.Event.fire("evt_PACChatOffered", eo);
	
					var handleYes = function()
					{
						var pageUrl = this.data.attrs.chat_login_page,
							Url = RightNow.Url;
	
						pageUrl = Url.addParameter(pageUrl, 'pac', 1);
						pageUrl = Url.addParameter(pageUrl, 'request_source', this.data.js.request_source);
						pageUrl = Url.addParameter(pageUrl, 'p', this._eo.data.prod);
						pageUrl = Url.addParameter(pageUrl, 'c', this._eo.data.cat);
	
						var chatData = '';
						chatData = this._addChatDataParam(chatData, 'referrerUrl', encodeURIComponent(window.location.href));
						// Send the visitor ID and engagement engine ID obfuscated in the chat_data URL parameter (if available)
						chatData = this._addChatDataParam(chatData, 'v_id', this._visitorId);
						chatData = this._addChatDataParam(chatData, 'ee_id', this._engagementEngineId);
						chatData = this._addChatDataParam(chatData, 'es_id', this._estaraId);
						chatData = this._addChatDataParam(chatData, 'ee_s_id', this._engagementEngineSessionId);
	
						if(response.rules !== undefined)
						{
							chatData = this._addChatDataParam(chatData, 'state', response.rules.state);
							chatData = this._addChatDataParam(chatData, 'escalation', response.rules.escalation);
						}
	
						chatData = this._addChatDataParam(chatData, 'q_id', response.q_id);
	
						if(chatData.length !== 0)
							pageUrl = Url.addParameter(pageUrl, 'chat_data', RightNow.Text.Encoding.base64Encode(chatData));
	
						if(this.data.attrs.auto_detect_incident)
							pageUrl = Url.addParameter(pageUrl, 'i_id', Url.getParameter('i_id'));
	
						// If any survey information exists, set it for the Chat control here
						if(response.survey_data)
						{
							if(response.survey_data.send_id)
							{
								pageUrl = Url.addParameter(pageUrl, 'survey_send_id', response.survey_data.send_id);
								pageUrl = Url.addParameter(pageUrl, 'survey_send_delay', response.survey_data.send_delay);
	
								if(response.survey_data.send_auth)
									pageUrl = Url.addParameter(pageUrl, 'survey_send_auth', response.survey_data.send_auth);
							}
	
							if(response.survey_data.comp_id && response.survey_data.comp_id != 0)
							{
								pageUrl = Url.addParameter(pageUrl, 'survey_comp_id', response.survey_data.comp_id);
	
								if(response.survey_data.comp_auth)
									pageUrl = Url.addParameter(pageUrl, 'survey_comp_auth', response.survey_data.comp_auth);
							}
	
							if(response.survey_data.term_id && response.survey_data.term_id != 0)
							{
								pageUrl = Url.addParameter(pageUrl, 'survey_term_id', response.survey_data.term_id);
	
								if(response.survey_data.term_auth)
									pageUrl = Url.addParameter(pageUrl, 'survey_term_auth', response.survey_data.term_auth);
							};
						}
	
						var eo = new RightNow.Event.EventObject(this, {data: {
							id: this._eeWidgetId,
							name: 'ProactiveChat'
						}});
						RightNow.Event.fire("evt_PACChatAccepted", eo);
	
						this._confirmDialog.hide();
						this._publishStats({w:this.data.js.dqaWidgetType.toString(), accepts:1});
						if(this.data.attrs.open_in_new_window)
							window.open(pageUrl, 'chatLauncher','width=' + this.data.attrs.chat_login_page_width + ',height=' + this.data.attrs.chat_login_page_height + ',scrollbars=1,resizable=1');
						else
							Url.navigate(pageUrl);
					};
					var mobile = 0;
					//alert("going to");
					if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
					 // some code..
					 	mobile = 1
					}
					var text_pro = "No Thanks";
					var handleNo = function()
					{
						this._confirmDialog.hide();
						this._publishStats({w:this.data.js.dqaWidgetType.toString(), rejects:1});
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
						} 
						else { // code for IE6, IE5
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
							xmlhttp.onreadystatechange=function() {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							
							}
						}
						var uri = window.location;
						var uri_enc = encodeURIComponent(uri);
						var mob = mobile;
						var link_name = 3;
						xmlhttp.open("GET","/cc/AjaxCustom/track_proactive_chat/"+uri_enc+'/'+mob+'/'+link_name+'?'+Math.random()*Math.random(),true);
						xmlhttp.send();	
					};
					handleSubmit = function()
					{
						/*alert("1");
						handleNo();
						alert("2");*/
						if(document.getElementById('proactive_error'))
						{
							document.getElementById('proactive_error').innerHTML="";	
						}
					
						var questionText = "";
						if(document.getElementById('proactive_textarea'))
						{
							questionText = document.getElementById('proactive_textarea').value;
						}
						if(questionText!="")
						{
						//alert("test");
							var launch_width = 380;
							var launch_height = 495;
							var leftPos = (screen.width / 2) - (launch_width / 2);
							var topPos = (screen.height / 2) - (launch_height / 2);
							window.open('/app/chat/chat_landing/proactive/yes/question/'+questionText,"_blank",'status=1,toolbar=0,menubar=0,location=0,resizable=1' +
								',height=' + launch_height + 'px,width=' + launch_width + 'px,left=' + leftPos + ',top=' + topPos);	
							
							if (window.XMLHttpRequest) {
								// code for IE7+, Firefox, Chrome, Opera, Safari
								xmlhttp=new XMLHttpRequest();
							} 
							else { // code for IE6, IE5
									xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
							}
								xmlhttp.onreadystatechange=function() {
								if (xmlhttp.readyState==4 && xmlhttp.status==200) {
								
								}
							}
							this._confirmDialog.hide();
							var uri = window.location;
							var uri_enc = encodeURIComponent(uri);
							var mob = mobile;
							var link_name = 1;
							xmlhttp.open("GET","/cc/AjaxCustom/track_proactive_chat/"+uri_enc+'/'+mob+'/'+link_name+'?'+Math.random()*Math.random(),true);
							xmlhttp.send();
						}
						else
						{
							if(document.getElementById('proactive_error'))
							{
								document.getElementById('proactive_error').innerHTML="Please enter a question to proceed";	
							}
							$(document).ready(function(){
							$(".newClass").addClass("error_appeared");
					});
						}
					};
					var buttons = [
							{ text: text_pro, handler: {fn: handleNo, scope: this}},
							{ text: "Submit Question", handler: {fn:handleSubmit, scope: this}}
					];
					var url = window.location.href;
					var exploded_url = url.split('/');
					var index_lob = exploded_url.indexOf("lob");
					var lob = "team";
					if(index_lob != -1)
					{
						lob = exploded_url[index_lob + 1];
					}
					var con_url = '/app/contact_us/lob/'+lob;
					if(mobile == 1)
					{
						con_url	= '/app/home/lob/'+lob;
					}
					var content = "<div id='proactive_main'><div id='proactive_error' style='color:red;margin: 5px 0px;font-weight: bold;'></div><div id='title_main' class='need_help'>Need help finding an answer?</div><textarea id='proactive_textarea' placeholder='Enter your question to chat with an agent' rows='5' cols='60'></textarea><div class='ask_here'><a onClick='handleSubmit();'></a></div><div class='need_assistance'>For assistance with your order or account, please visit our <div class = 'proactive_contact'><a href='"+con_url+"' target='_self' onClick='redirectContactUs();'>contact us page</a>.</div></div></div>";
					redirectContactUs = function()
					{
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
						} 
						else { // code for IE6, IE5
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
							xmlhttp.onreadystatechange=function() {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							
							}
						}
						var uri = window.location;
						var uri_enc = encodeURIComponent(uri);
						var mob = mobile;
						var link_name = 2;
						xmlhttp.open("GET","/cc/AjaxCustom/track_proactive_chat/"+uri_enc+'/'+mob+'/'+link_name+'?'+Math.random()*Math.random(),true);
						xmlhttp.send();	
					}
					//alert("before dialog appears..." + RightNow.Interface.getMessage("INFORMATION_LBL"));
					if(!this._confirmDialog) {
						var dialogBody = this.Y.Node.create("<div>")
							.addClass("rn_ProactiveChatConfirm")
							.set("innerHTML", content+this.data.attrs.label_chat_question);
						this._confirmDialog = RightNow.UI.Dialog.actionDialog("", dialogBody, {"buttons" : buttons, "close" :  false, 'dialogDescription' : 'rn_' + this.instanceID + '_ProactiveChatBoxDescription'});
						this.setDialog(this._confirmDialog);
						this.Y.DOM.addClass(this._confirmDialog.id, 'rn_dialog');
						RightNow.UI.Dialog.addDialogEnterKeyListener(this._confirmDialog, handleYes, this);
						if (window.XMLHttpRequest) {
							// code for IE7+, Firefox, Chrome, Opera, Safari
							xmlhttp=new XMLHttpRequest();
						} 
						else { // code for IE6, IE5
								xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
							xmlhttp.onreadystatechange=function() {
							if (xmlhttp.readyState==4 && xmlhttp.status==200) {
							
							}
						}
						var uri = window.location;
						var uri_enc = encodeURIComponent(uri);
						var mob = mobile;
						var link_name = 4;
						xmlhttp.open("GET","/cc/AjaxCustom/track_proactive_chat/"+uri_enc+'/'+mob+'/'+link_name+'?'+Math.random()*Math.random(),true);
						xmlhttp.send();	
					}
					var buttons = document.getElementsByTagName('button');
					for (var i = 0; i < buttons.length; i++) {
						var button = buttons[i];
						var button_text = String(button.innerHTML);
						console.log("testing");
						var present = button_text.search("Submit Question");
						if(present != -1)
						{
							button.setAttribute("class", "yui3-button newClass");	
							button.parentNode.setAttribute("class", "submit_que");
							//console.log(button.parentNode.setAttribute("class", "submit_que"));	
						}
						var check = button_text.search("No Thanks");
						if(check != -1)
						{
							//button.parentNode.setAttribute("class", "no_thanks");
						}
						//var type = button.getAttribute('type') || 'submit'; // Submit is the default
						// ...
					}
					$(document).ready(function(){
							$(".yui3-widget-ft").addClass("dont");
					});
					this.Y.Cookie.set("noChat","RNTLIVE", {path: "/"});
					this._confirmDialog.show();
					console.log(this._confirmDialog);
				}
			}
		},
		_cookiesEnabled: function()
		{
			//alert("cookies enabled");
			var cookieEnabled = (navigator.cookieEnabled === true) ? true : false;
			if (typeof navigator.cookieEnabled === "undefined" && !cookieEnabled){
				this.Y.Cookie.set("COOKIE_TEST", "RNT", {path: "/"});
				cookieEnabled = (this.Y.Cookie.get("COOKIE_TEST") !== null) ? true : false;
				this.Y.Cookie.remove("COOKIE_TEST", {path: "/"});
			}
			return cookieEnabled;
		},
	
		/**
		 * Event handler for when the prod/cat search items on a page are changed
		 * @param {String} type Event name
		 * @param {Object} args Event arguments
		 */
		 _onProdCatChanged: function(type, args)
		{
			//alert("in prod cat changed");
			var prodCatType = args[0].data.data_type;
			var value = args[0].data.value;
	
			if (prodCatType.indexOf("Category") > -1)
				this._eo.data.cat = value;
			else // assume prod
				this._eo.data.prod = value;
		},
	
		/**
		 * Adds key/value pair to the chatData parameter that's sent in the chat URL
		 * @param {String} chatData The existing chatData string
		 * @param {String} key The key to add
		 * @param {String} value The value that corresponds to the key
		 * @return {String}
		 */
		_addChatDataParam: function(chatData, key, value)
		{
			//alert("in add chat data");
			// Make sure the chatData var at least exists. Set to empty string if not.
			if(chatData === undefined)
				chatData = '';
	
			// Check that value is set, and not empty
			if(value === undefined || value === null || value.length === 0)
				return chatData;
	
			if(chatData.length !== 0)
				chatData += '&';
	
			chatData += key + '=' + value;
	
			return chatData;
		}

        /**
         * Overridable methods from ProactiveChat:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _start: function(type, args)
        // _publishStats: function(statAction)
        // _checkDoneStatus: function()
        // _onSearchCountChanged: function(type, args)
        // onSeconds: function()
        // _onQueueReceived: function(response, origEventObject)
        // _cookiesEnabled: function()
        // _onProdCatChanged: function(type, args)
        // _addChatDataParam: function(chatData, key, value)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

	
	setDialog: function(param)
	{
		this.dialogdetails = param;
	},
	getDialog: function()
	{
		return 1;
	},
	handleClose: function()
	{
		
		console.log("12121212");
	}
});