RightNow.namespace('Custom.Widgets.ResponsiveDesign.CallMeNowChatHours');
Custom.Widgets.ResponsiveDesign.CallMeNowChatHours = RightNow.Field.extend({ 
    /**
     * Widget constructor.
     */
     overrides: {
    constructor: function() {
		
		//console.log(this.data.js);

        var callmenowhours = new RightNow.Event.EventObject(this, {data:this.data.js.checkcallmenowday});
        RightNow.Event.fire("callmenowhours",callmenowhours);   // Subscribed in custom/ResponsiveDesign/ChannelDisplay 
		

 

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