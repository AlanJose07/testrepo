RightNow.namespace('Custom.Widgets.input.checkboxDisclaimer');
Custom.Widgets.input.checkboxDisclaimer = RightNow.Widgets.extend({ 
    /** 
     * Widget constructor.
     */
    constructor: function() {
		this.input = this.Y.one("#terms_conditions1");
		this.input.on("change", this.checkSelected, this);

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	checkSelected: function() {
		var selectedbox = false;
		if(this.input.get('checked')) 
		{ 
			selectedbox = true;
		}
		var eventObj = new RightNow.Event.EventObject(this, {data:  {isSelected: selectedbox}});
		RightNow.Event.fire("evt_selectbox", eventObj);
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