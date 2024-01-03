var changecounter = 0;
var limit = 4;	
RightNow.namespace('Custom.Widgets.custom.buttonEnable');
Custom.Widgets.custom.buttonEnable = RightNow.Widgets.extend({     /**
     * Widget constructor.
     */
	
    constructor: function() {
		
		RightNow.Event.subscribe("changed_text_input", this.setcounter);
		RightNow.Event.subscribe("removed_text_input", this.resetcounter);
		
    },
    /**
     * Sample widget method.
     */
    setcounter: function() {
		changecounter++;
		console.log(changecounter);
		
		if(changecounter==limit)
		{
			var btnid = document.getElementsByClassName("rn_DisplayButton")[0].id;	
			$("#"+btnid).attr('style', 'background-color: #40B1E5 !important;color:#212529 !important;');
			//document.getElementById(btnid).style.backgroundColor="#40B1E5!important";
		}
		
    },
	resetcounter: function() {
		changecounter--;
		if(changecounter<limit)
		{
			var btnid = document.getElementsByClassName("rn_DisplayButton")[0].id;	
			$("#"+btnid).attr('style', 'background-color: #D2D2D2 !important; color:#fff !important;');
		}	
	}
});