RightNow.namespace('Custom.Widgets.input.IllnessMenuDisplay');
Custom.Widgets.input.IllnessMenuDisplay = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		
		RightNow.Event.subscribe("evt_PCchosen_menu", this._getResponse, this);

    },

    /**
     * Sample widget method.
     */
    _getResponse: function(data, obj) {
		
		
		
		if(obj[0].data.prod==1344 || obj[0].data.prod==1466)
		{
			document.getElementById("multiselect").style.display="block";
		}
		else
		{
			document.getElementById("multiselect").style.display="none";
			
		}

    },

    /**
     * Makes an AJAX request for `default_ajax_endpoint`.
     */
    getDefault_ajax_endpoint: function() {
        // Make AJAX request:
        var eventObj = new RightNow.Event.EventObject(this, {data:{
            w_id: this.data.info.w_id,
            // Parameters to send
        }});
        RightNow.Ajax.makeRequest(this.data.attrs.default_ajax_endpoint, eventObj.data, {
            successHandler: this.default_ajax_endpointCallback,
            scope:          this,
            data:           eventObj,
            json:           true
        });
    },

    /**
     * Handles the AJAX response for `default_ajax_endpoint`.
     * @param {object} response JSON-parsed response from the server
     * @param {object} originalEventObj `eventObj` from #getDefault_ajax_endpoint
     */
    default_ajax_endpointCallback: function(response, originalEventObj) {
        // Handle response
    }
});