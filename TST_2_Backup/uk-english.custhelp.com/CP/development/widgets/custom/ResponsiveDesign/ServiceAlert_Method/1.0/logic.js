RightNow.namespace('Custom.Widgets.ResponsiveDesign.ServiceAlert_Method');
Custom.Widgets.ResponsiveDesign.ServiceAlert_Method = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		this.instanceID = instanceID;
		this.data = data;
		try
		{
			$('.message-close').on('click', function(e) {
			  $('.message').hide();//addClass('close');
			  try
			  {
				sessionStorage.setItem("service_alert_session",2);
			  }
			  catch(err_inner)
			  {}
			});
			$('body').on('click',function(e){ 
				if(e.target)
				{
					console.log("targer is");
					console.log(e.target.className);
					if(e.target.className != "message" && e.target.className != "message-text" && e.target.className != "message-close")
					{
						$('.message').hide();
						try
						{
							sessionStorage.setItem("service_alert_session",2);
						}
						catch(err_inner)
						{}
					}
				}
			});
		}
		catch(err)
		{
		
		}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});