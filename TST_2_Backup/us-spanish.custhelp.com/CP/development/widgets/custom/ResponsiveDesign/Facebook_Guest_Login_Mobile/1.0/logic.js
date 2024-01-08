RightNow.namespace('Custom.Widgets.ResponsiveDesign.Facebook_Guest_Login_Mobile');
Custom.Widgets.ResponsiveDesign.Facebook_Guest_Login_Mobile = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
	
	
		var list = document.getElementById("mobile_fb_click_start_session");
		var str = window.location.pathname;
		var url_parameter = str.slice(26);
		
		var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support_fb/"," ");
		login_url = login_url.trim();
		
		list.addEventListener("click", function(e) {
		
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession_fb/facebook', {text:login_url}, {
                    successHandler: function(response) {
						
						if(response['loggedin'] ==  'no')
						{
						window.location = 'https://us-spanish--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/facebooksurvey/'+url_parameter;
						}
                    	
                    },
                    scope: this,
                    json: true,
                    type: "POST"
                });
		});
		
    

    

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});