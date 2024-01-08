RightNow.namespace('Custom.Widgets.ResponsiveDesign.placement_change_checkbox');
Custom.Widgets.ResponsiveDesign.placement_change_checkbox = RightNow.Widgets.extend({     /**
     * Widget constructor.
     */
    constructor: function() {
		
		$(document).ready(function() {
			$('.m-r-10').click(function(){
				var checkCount = $("input[name='RESULT_CheckBox-21']:checked").length;
				if(checkCount == 3){
					document.getElementById("request_details").style.display="block";
					var requestdetails = new RightNow.Event.EventObject(this, {data:1});
					RightNow.Event.fire("requestdetails_placement",requestdetails);   // Subscribed in custom/ResponsiveDesign/sponsor_placement_validate 
				}else{
					document.getElementById("request_details").style.display="none";	
					var requestdetails_notrequired = new RightNow.Event.EventObject(this, {data:2});
					RightNow.Event.fire("requestdetails_placement_notrequired",requestdetails_notrequired);   // Subscribed in custom/ResponsiveDesign/sponsor_placement_validate 
				}
				
			});
		});
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    }
});