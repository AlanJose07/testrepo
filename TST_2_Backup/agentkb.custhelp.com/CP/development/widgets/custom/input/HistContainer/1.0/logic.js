RightNow.namespace('Custom.Widgets.input.HistContainer');
Custom.Widgets.input.HistContainer = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		RightNow.Event.subscribe("evt_PCchosen_menu", this._getResponse, this);
        jQuery.noConflict();
		jQuery("#HistContainer10").hide();
		jQuery("#HistContainer11").hide();
        jQuery("#HistContainer").hide();
        jQuery("#HistContainer2").hide();
        jQuery("#HistContainer3").hide();
        jQuery("#HistContainer4").hide();
        jQuery("#HistContainer5").hide();
        jQuery("#HistContainer6").hide();
        jQuery("#HistContainer7").hide();
        jQuery("#HistContainer8").hide();
        jQuery("#HistContainer9").hide();
        jQuery("#HistContainer0").hide();
		jQuery("#HistContainer12").hide();
		jQuery("#HistContainer13").hide();
		
		jQuery("#HistContainer20").hide();
		jQuery("#HistContainer21").hide();
    },
	
	_getResponse: function(data, obj)
    {
        
        this._eoReqFields = new RightNow.Event.EventObject();
            
if (obj[0].data.prod ==1344 || obj[0].data.prod ==1345 || obj[0].data.prod == 1466)
        {
			var symptom;
            jQuery.noConflict();
			if(obj[0].data.prod==1344)
			{
			symptom="illness";
			jQuery("#HistContainer10").slideDown("slow");
			jQuery("#HistContainer11").slideDown("slow");
			jQuery("#HistContainer12").slideUp("slow");
			jQuery("#HistContainer13").slideUp("slow");
			
			jQuery("#HistContainer").slideDown("slow");
            jQuery("#HistContainer2").slideDown("slow");
            jQuery("#HistContainer3").slideDown("slow");
            jQuery("#HistContainer4").slideDown("slow");
            jQuery("#HistContainer5").slideDown("slow");
            jQuery("#HistContainer6").slideDown("slow");
            jQuery("#HistContainer7").slideDown("slow");
            jQuery("#HistContainer8").slideDown("slow");
			
			jQuery("#HistContainer20").slideDown("slow");
			jQuery("#HistContainer21").slideDown("slow");
			
			}
			if(obj[0].data.prod==1466)
			{
			symptom="Allergic reaction";
			jQuery("#HistContainer10").slideDown("slow");
			jQuery("#HistContainer11").slideDown("slow");
			jQuery("#HistContainer12").slideUp("slow");
			jQuery("#HistContainer13").slideUp("slow");
			
			jQuery("#HistContainer").slideDown("slow");
            jQuery("#HistContainer2").slideDown("slow");
            jQuery("#HistContainer3").slideDown("slow");
            jQuery("#HistContainer4").slideDown("slow");
            jQuery("#HistContainer5").slideDown("slow");
            jQuery("#HistContainer6").slideDown("slow");
            jQuery("#HistContainer7").slideDown("slow");
            jQuery("#HistContainer8").slideDown("slow");
			
			jQuery("#HistContainer20").slideDown("slow");
			jQuery("#HistContainer21").slideDown("slow");
			
			}
			
			if(obj[0].data.prod == 1345)
			{
				symptom="injury";
			jQuery("#HistContainer10").slideUp("slow");
			jQuery("#HistContainer11").slideUp("slow");
			
			jQuery("#HistContainer").slideUp("slow");
            jQuery("#HistContainer2").slideUp("slow");
            jQuery("#HistContainer3").slideUp("slow");
            jQuery("#HistContainer4").slideUp("slow");
            jQuery("#HistContainer5").slideUp("slow");
            jQuery("#HistContainer6").slideUp("slow");
            jQuery("#HistContainer7").slideUp("slow");
            jQuery("#HistContainer8").slideUp("slow");
			
			jQuery("#HistContainer12").slideDown("slow");
			jQuery("#HistContainer13").slideDown("slow");
			
			jQuery("#HistContainer20").slideUp("slow");
			jQuery("#HistContainer21").slideUp("slow");
			}
            
            jQuery("#HistContainer9").hide();
            jQuery("#HistContainer0").hide();
			
			
            
            //YAHOO.util.Dom.removeClass('HistContainer', 'rn_Hidden');
			
            this._eoReqFields.data = {"req" : "yes","symptoms":symptom};
            RightNow.Event.fire("evt_EvaluateRequired", this._eoReqFields);
        }
       
		else
		{
			   
			
            //YAHOO.util.Dom.addClass('HistContainer', 'rn_Hidden');
			
            jQuery.noConflict();
			jQuery("#HistContainer10").slideUp("slow");
			jQuery("#HistContainer11").slideUp("slow");
			
            jQuery("#HistContainer").slideUp("slow");
			
            jQuery("#HistContainer2").slideUp("slow");
            jQuery("#HistContainer3").slideUp("slow");
            jQuery("#HistContainer4").slideUp("slow");
            jQuery("#HistContainer5").slideUp("slow");
            jQuery("#HistContainer6").slideUp("slow");
            jQuery("#HistContainer7").slideUp("slow");
            jQuery("#HistContainer8").slideUp("slow");
            jQuery("#HistContainer9").slideUp("slow");
            jQuery("#HistContainer0").slideUp("slow");
			
			jQuery("#HistContainer12").slideUp("slow");
			jQuery("#HistContainer13").slideUp("slow");
			
			jQuery("#HistContainer20").slideUp("slow");
			jQuery("#HistContainer21").slideUp("slow");
			
			
			
			this._eoReqFields.data = {"req" : "no"};
            RightNow.Event.fire("evt_EvaluateRequired", this._eoReqFields);
			//RightNow.Event.fire("evt_EvaluateRequiredinj", this._eoReqFields);
            
        }
        
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});