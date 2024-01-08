RightNow.namespace('Custom.Widgets.ResponsiveDesign.BbliveChatHour');
Custom.Widgets.ResponsiveDesign.BbliveChatHour = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
    RightNow.Event.subscribe("fire_to_bblivechathour", this._hide_show_submitbutton, this);
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	
	_hide_show_submitbutton: function(){
		
		 if(this.data.js.check_day_bbliveinstructor=="1")
		 {
			  
			 document.getElementById("submit-button").style.display = "block";
		 }
		 else
		 {
			 
			 document.getElementById("submit-button").style.display = "none";
		 }
		
		}
});