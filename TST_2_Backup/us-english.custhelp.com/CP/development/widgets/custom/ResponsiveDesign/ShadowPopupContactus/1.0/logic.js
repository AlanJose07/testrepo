RightNow.namespace('Custom.Widgets.ResponsiveDesign.ShadowPopupContactus');
Custom.Widgets.ResponsiveDesign.ShadowPopupContactus = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		this.data = data;
		this.instanceID = instanceID;
		this.resultid = this.data.js.id;
		this.duration = this.data.js.duration;
		this.configure_popup = this.data.js.configure_popup;
		/*if(this.data.js.enable)
		{
		this._showPopup();
		}*/

		/*$( "#orderClose1" ).on( "click", function() {	
				var modal = document.getElementById('myModal1');
				modal.style.display = "none";								  
		});*/
		if(document.getElementById('orderClose1')){ 
		var id=document.getElementById('orderClose1'); 
		this.input = this.Y.one(id);
		this.input.on("click", this.popupalertclose, this); 
		//this.input.on("click", this.popupalertclose, this);
		
		}
		/*document.getElementById("orderClose1").addEventListener("click", function() {
			modal.style.display = "none";
			alert("Hello World!");
		}); */	
		
		
    }, 

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	/*_showPopup: function()
	{
		var modal = document.getElementById('myModal1');
		modal.style.display = "block";     
	},*/  
	
	popupalertclose: function() {
		
		try
		{
			instance = this;
			$('.messagepopupclose').hide();
			if(this.configure_popup == 32){
					$.ajax({url: "/cc/bbresponsivecontroller/popup_duration",async:true, json: true, success: function(response){
					var response = JSON.parse(response);																																		 					instance.duration = response.duration;
					console.log(instance.resultid);
					var username = instance.getCookie("popupclosecookie"+instance.resultid); 
					if (username != "") {
							$('.messagepopupclose').hide();
					} else {
							instance.setCookie("popupclosecookie"+instance.resultid,"enabled",instance.duration); 
					
					}
				}}); 
				
			}else{
				var username = this.getCookie("popupclosecookie"+this.resultid); 
				if (username != "") {
						$('.messagepopupclose').hide();
				} else {
						this.setCookie("popupclosecookie"+this.resultid,"enabled",this.duration); 
				
				}
			}
		}
		catch(err)
		{
		
		}

    },
	
	setCookie:function(cname, cvalue, exmin) {
		console.log(exmin);
		var d = new Date();
        d.setTime(d.getTime() + (exmin*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		
		
		},
	getCookie: function(cname) {
		console.log(cname);
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
