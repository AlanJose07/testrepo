RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomChatHours');
Custom.Widgets.ResponsiveDesign.CustomChatHours = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		console.log(this.data.js);

        var chatHours = new RightNow.Event.EventObject(this, {data:this.data.js.checkday});
        RightNow.Event.fire("chatHours",chatHours);   // Subscribed in custom/ResponsiveDesign/ChannelDisplay 

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});