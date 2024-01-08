RightNow.namespace('Custom.Widgets.input.OtherContainer');
Custom.Widgets.input.OtherContainer = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		RightNow.Event.subscribe("evt_PCchosen", this._getResponse, this);
        jQuery.noConflict();
        jQuery("#othercontainer").hide();

    },
	
	_getResponse: function(data, obj)
    {
        
        if (obj[0].data.prod.search("Other - Please Specify") > 0)
        {
            jQuery.noConflict();
            jQuery("#othercontainer").slideDown("slow");
           
            
        }else{
            
            jQuery.noConflict();
            jQuery("#othercontainer").slideUp("slow");
           
        }
        
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});