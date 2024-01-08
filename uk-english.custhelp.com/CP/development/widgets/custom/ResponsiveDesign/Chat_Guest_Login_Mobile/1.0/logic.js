RightNow.namespace('Custom.Widgets.ResponsiveDesign.Chat_Guest_Login_Mobile');
Custom.Widgets.ResponsiveDesign.Chat_Guest_Login_Mobile = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		
		var list = document.getElementById("mobile_click_start_session");
		var str = window.location.pathname;
		var url_parameter = str.slice(28);
		
		var actual_link = window.location.href; 
		var login_url = actual_link.replace("https://"+window.location.hostname+"/app/contactus_support_chat/"," ");
		login_url = login_url.trim();
		
		//window.pta_login = RightNow.Interface.getConfig('PTA_EXTERNAL_LOGIN_URL');
		//pta_login = pta_login.replace("&returnurl=%next_page%"," ");
		
		list.addEventListener("click", function(e) {
		
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/loginsession', {text:login_url}, {
                    successHandler: function(response) {
						
						if(response['loggedin'] ==  'no')
						{
						window.location = 'https://uk-english--tst2.custhelp.com/cc/openlogin/oauth/authorize/beachbody?returnurl=chat/prechatsurvey/'+url_parameter;
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

