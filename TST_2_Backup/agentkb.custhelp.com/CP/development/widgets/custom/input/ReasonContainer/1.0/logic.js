RightNow.namespace('Custom.Widgets.input.ReasonContainer');
Custom.Widgets.input.ReasonContainer = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		RightNow.Event.subscribe("evt_PCchosen", this._getResponse, this);
        jQuery.noConflict();
		var arr = [16,18,20,22,24];
		for(var i=1;i<=25;i++)
		{
			//if(!arr.includes(i))
			if(arr.indexOf(i) < 0)
			{
							jQuery("#ReasonContainer"+i).hide();
				
			}
		}
    },

    /**
     * Sample widget method.
     */
    _getResponse: function(data, obj) {
        this._eoReqFields = new RightNow.Event.EventObject();
		var reasons = obj[0].data.prod;		
		obj[0].data.prod = reasons.replace("&#x2F;", "/");
		jQuery("#ReasonContainer9").slideUp("slow");
		jQuery("#ReasonContainer10").slideUp("slow");
		jQuery("#ReasonContainer11").slideUp("slow");
		jQuery("#ReasonContainer12").slideUp("slow");
		jQuery("#ReasonContainer13").slideUp("slow");
		jQuery("#ReasonContainer14").slideUp("slow");
		jQuery("#ReasonContainer15").slideUp("slow");
		jQuery("#ReasonContainer17").slideUp("slow");
		jQuery("#ReasonContainer19").slideUp("slow");
		jQuery("#ReasonContainer21").slideUp("slow");
		jQuery("#ReasonContainer23").slideUp("slow");
		jQuery("#ReasonContainer25").slideUp("slow");
		if (obj[0].data.prod.search("Damaged Packaging") > 0||obj[0].data.prod.search("Foreign Material") > 0)
        {
            jQuery.noConflict();
			jQuery("#ReasonContainer1").slideDown("slow");
			jQuery("#ReasonContainer2").slideDown("slow");
			jQuery("#ReasonContainer3").slideDown("slow");
			jQuery("#ReasonContainer4").slideDown("slow");
			jQuery("#ReasonContainer5").slideDown("slow");
			jQuery("#ReasonContainer6").slideDown("slow");
			jQuery("#ReasonContainer7").slideDown("slow");
			jQuery("#ReasonContainer8").slideDown("slow");
			if((obj[0].data.prod.search("Foreign Material") > 0)&&(obj[0].data.prod.search("Plastic") > 0))
			{
				jQuery("#ReasonContainer9").slideDown("slow");
				jQuery("#ReasonContainer10").slideDown("slow");
				jQuery("#ReasonContainer11").slideDown("slow");
				jQuery("#ReasonContainer12").slideDown("slow");
				jQuery("#ReasonContainer13").slideDown("slow");
				jQuery("#ReasonContainer14").slideDown("slow");
			}
			if((obj[0].data.prod.search("Foreign Material") > 0)&&(obj[0].data.prod.search("Unknown Filth") > 0))
			{
				jQuery("#ReasonContainer15").slideDown("slow");
				jQuery("#ReasonContainer17").slideDown("slow");
				jQuery("#ReasonContainer19").slideDown("slow");
			}
			if((obj[0].data.prod.search("Foreign Material") > 0)&&(obj[0].data.prod.search("Pests/Infestation") > 0))
			{
				jQuery("#ReasonContainer21").slideDown("slow");
				jQuery("#ReasonContainer23").slideDown("slow");
				jQuery("#ReasonContainer25").slideDown("slow");
			}
			
			this._eoReqFields.data = {"req" : "yes"};
            RightNow.Event.fire("evt_Required", this._eoReqFields);
		}
		else
		{
			jQuery.noConflict();
			jQuery("#ReasonContainer1").slideUp("slow");
			jQuery("#ReasonContainer2").slideUp("slow");
			jQuery("#ReasonContainer3").slideUp("slow");
			jQuery("#ReasonContainer4").slideUp("slow");
			jQuery("#ReasonContainer5").slideUp("slow");
			jQuery("#ReasonContainer6").slideUp("slow");
			jQuery("#ReasonContainer7").slideUp("slow");
			jQuery("#ReasonContainer8").slideUp("slow");
			
			this._eoReqFields.data = {"req" : "no"};
            RightNow.Event.fire("evt_Required", this._eoReqFields);
		}
	

    }
});