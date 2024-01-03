RightNow.namespace('Custom.Widgets.chat.ChatAgentStatusCustom');
Custom.Widgets.chat.ChatAgentStatusCustom = RightNow.Widgets.ChatAgentStatus.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatAgentStatus#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },

        /**
         * Overridable methods from ChatAgentStatus:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onChatEngagementParticipantAddedResponse : function(type, args)
        // _onChatEngagementParticipantRemovedResponse : function(type, args)
        // _onChatAgentStatusChangeResponse : function(type, args)
        // _onChatStateChangeResponse : function(type, args)
		
		
		
		
		
		  _onChatEngagementParticipantAddedResponse : function(type, args)
    {
        if(!args[0].data.agent)
            return;

        var agent = args[0].data.agent;
        
	
		
        //create HTML, create Node, and append to roster
        this._roster.appendChild(this.Y.Node.create(new EJS({text: this.getStatic().templates.participantAddedResponse}).render({
            attrs: this.data.attrs,
            instanceID: this.instanceID,
           
		   	agentName: this._getAgentName(args[0].data.agent.name),  
            clientID: agent.clientID})));

        RightNow.UI.show(this._container);
    },
		
		
		
		
    },

    /**
     * Sample widget method.
     */
	 
	/* Moncy --trimming to get agent firstname*/
    _getAgentName : function(agentName)
    {	       	
		var resArray = agentName.split(" ");		
		return resArray[0];
			
    }
});