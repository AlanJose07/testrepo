RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomChatHours');
Custom.Widgets.ResponsiveDesign.CustomChatHours = RightNow.Field.extend({ 
    /**
     * Widget constructor.
     */
     overrides: {
    constructor: function() {
		
		//console.log(this.data.js);

        var chatHours = new RightNow.Event.EventObject(this, {data:this.data.js.checkday});
        RightNow.Event.fire("chatHours",chatHours);   // Subscribed in custom/ResponsiveDesign/ChannelDisplay 
		

 

//var FieldName = this.data.js.name;
//console.log(this.data.js);
//var member_id = new RightNow.Event.EventObject(this, {data:this.data.js});
//console.log(member_id);


    }
},

    /**
     * Sample widget method.
     */
    methodName: function() {

        

    }
});