RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomLogoutLink');
Custom.Widgets.ResponsiveDesign.CustomLogoutLink = RightNow.Widgets.LogoutLink.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.LogoutLink#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			this.pta_logout = RightNow.Interface.getConfig('PTA_EXTERNAL_LOGOUT_SCRIPT_URL');
        },

        /**
         * Overridable methods from LogoutLink:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onLogoutCompleted: function(response, originalEventObj)
        // _onLogoutClick: function()
		
		 _onLogoutCompleted: function(response, originalEventObj) {
        if(!RightNow.Event.fire("evt_logoutResponse", {data: originalEventObj, response: response}))
            return;

        var Url = RightNow.Url;
        if(response.success === 1 && !RightNow.UI.Form.logoutInProgress && originalEventObj.w_id === this.instanceID)
        { 
            RightNow.UI.Form.logoutInProgress = true;
            //If redirect is specified in the controller, use it, otherwise default
            //to response from server for compatability
            if(this.data.js && this.data.js.redirectLocation)
            { 
                if(response.session)
                    this.data.js.redirectLocation = Url.addParameter(this.data.js.redirectLocation, 'session', RightNow.Text.getSubstringAfter(response.session, 'session/')); 
					this.data.js.redirectLocation = this.pta_logout;
                Url.navigate(this.data.js.redirectLocation, true);
            }
            else
            {
                if(response.socialLogout)
				{
                    Url.navigate(response.socialLogout, true);}
                else if(this.data.attrs.redirect_url === ''){
                    Url.navigate(response.url, true);}
                else{
                    Url.navigate(this.data.attrs.redirect_url + response.session, true);}
            }
        }
    },
	
		_onLogoutClick: function() {
			
        var eventObject = new RightNow.Event.EventObject(this, {data: {
            w_id: this.instanceID,
            currentUrl: window.location.pathname, 
            redirectUrl: this.data.attrs.redirect_url
        }});
        if(RightNow.Event.fire("evt_logoutRequest", eventObject)) {
            RightNow.Ajax.makeRequest(this.data.attrs.logout_ajax,
                eventObject.data,
                {successHandler: this._onLogoutCompleted, scope: this, data: eventObject, json: true});
        }
    }
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});