RightNow.namespace('Custom.Widgets.ResponsiveDesign.UpdateCreditCardSelection');
Custom.Widgets.ResponsiveDesign.UpdateCreditCardSelection = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		
		this.instanceID = instanceID;
		this.data = data;
		var FieldName = this.data.attrs.name;
		this._FieldName = FieldName;
		if(FieldName === "Update_Acnt.Update_Account_Info.credit_card_type")
		{
			//this.checkCountryOnLoad(1,7);
			RightNow.Event.subscribe("country_creditcard_selection", this.checkCountry, this);
		}
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

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
    },

    /**
     * Renders the `view.ejs` JavaScript template.
     */
	 
	 checkCountry: function(type, args) {
		// alert(this._FieldName);
		//var fieldName = this._FieldName;
		//var splitFieldName = fieldName.split('.');  
		//var reqFieldName = splitFieldName[1] + "." + splitFieldName[2] + "." + splitFieldName[3];
		var id = args[0].data.country_id;
		     
		var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: id}});
		RightNow.Ajax.makeRequest('/cc/AjaxCustom1/screenCardTypesByCountry', {country_id:id}, {
			successHandler: function(response) {
				var wid = this.baseSelector+"_";
				var selbox = this.Y.one(wid); 
				this.Y.one(wid).get('options').remove();
				selbox.append("<option value=''>--</option>");
				for(i=0;i<response.length;i++)
				{
				   selbox.append("<option value='"+response[i].ID +"'>"+response[i].LookupName +"</option>");	
				   selbox.set("selectedIndex", 0);
				}
				
										
				},
				scope: this,
				json: true,
				type: "POST"
			});
		 
	 },
	 
	 
	 
    renderView: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});