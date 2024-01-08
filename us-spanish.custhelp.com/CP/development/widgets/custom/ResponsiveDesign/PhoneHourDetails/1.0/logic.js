RightNow.namespace('Custom.Widgets.ResponsiveDesign.PhoneHourDetails');
Custom.Widgets.ResponsiveDesign.PhoneHourDetails = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		
		   
		   this._displayNone(this.data.js.notdisplay);
		   
			if(document.getElementById(this.data.js.display))
			{
				document.getElementById(this.data.js.display).style.display = "block";
			}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	_displayNone: function(displayNone)
	{
		
		
		for (var i=0;i<displayNone.length;i++)
		{
			if(document.getElementById(displayNone[i]))
			{	
				document.getElementById(displayNone[i]).style.display = "none";
			}
		}	
	}
});