RightNow.namespace('Custom.Widgets.ResponsiveDesign.ServiceAlert');
Custom.Widgets.ResponsiveDesign.ServiceAlert = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
			this.instanceID = instanceID;
			this.data = data;
			
		if(document.getElementById('service-alert-close-messagebox')){
		var id=document.getElementById('service-alert-close-messagebox');
		this.input = this.Y.one(id);
		this.input.on("click", this.servicealertclose, this); 
		}
    },

    /**
     * Sample widget method.
	 the below test function() created by jithin...do not delete...
     */
    servicealertclose: function() {
		
		try
		{
			$('.message').hide();
			var username = this.getCookie("servicealertclosecookie"); 
			if (username != "") {
					$('.message').hide();
			} else {
					this.setCookie("servicealertclosecookie","enabled",15);     
			
			}
		}
		catch(err)
		{
		
		}

    },
	setCookie:function(cname, cvalue, exmin) {
		var d = new Date();
        d.setTime(d.getTime() + (exmin*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		
		
		},
	getCookie: function(cname) {
		
		var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
      }
    return "";
		
		}
	
});