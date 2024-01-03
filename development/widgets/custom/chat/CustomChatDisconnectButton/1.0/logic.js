RightNow.namespace('Custom.Widgets.chat.CustomChatDisconnectButton');
Custom.Widgets.chat.CustomChatDisconnectButton = RightNow.Widgets.ChatDisconnectButton.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatDisconnectButton#constructor.
         */
        constructor: function() {
             main = this;
             // EN
            // Call into parent's constructor
                       this.parent();
					  this._disconnectButton.on("click", this.onButtonClickRedirect, this);
					  //this._disconnectButton.on("click", this.onButtonClickRedirect, this);
               }
},
        /**
         * Overridable methods from ChatDisconnectButton:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onButtonClick: function(type, args)
        // _onChatStateChangeResponse: function(type, args)
    onButtonClickRedirect: function() {
		
		//alert("OnButtonClickRedirect");
		//window.location.href = "https://custhelp.gogoinflight.com/app/home";
		var sid=document.getElementById("hiddensid").value;
		// window.location.href = 'https://care.inflightinternet.com/app/chat/chat_survey/sid/'+sid;
		//window.location.href = 'https://care.inflightinternet.com/app/home';
        if(this.data.js['sessionExpireFlag1'] === "Enable"){
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
        else{
            window.location.href = 'https://care.inflightinternet.com/app/chat/chat_survey/sid/'+sid;
        } 
        

    },
	

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});