RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomPhoneHours');
Custom.Widgets.ResponsiveDesign.CustomPhoneHours = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		 var phoneHours = new RightNow.Event.EventObject(this, {data:this.data.js.checkphone});
        RightNow.Event.fire("phoneHours",phoneHours);   // Subscribed in custom/ResponsiveDesign/ChannelDisplay 

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});