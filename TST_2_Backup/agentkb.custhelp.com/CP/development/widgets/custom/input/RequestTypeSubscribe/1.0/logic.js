RightNow.namespace('Custom.Widgets.input.RequestTypeSubscribe');
Custom.Widgets.input.RequestTypeSubscribe = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
       		constructor: function(data, instanceID) 
	{
            // Call into parent's constructor
            this.parent();
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
			this._FieldName = FieldName;
			
			this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
			
		if(FieldName === "Incident.CustomFields.c.financial_back_office_reason"|| FieldName ==="Incident.CustomFields.c.corporate_escalation_reason" )
			{
				this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
				this.input.on("change", this.ReasonChanged, this);
			}
			
			var fieldName = data.js.name;
			this._FieldName = fieldName;
			if(fieldName == "Incident.CustomFields.c.corporate_escalation_reason")
			{
				RightNow.Event.subscribe("request_type_corporate", this.showrequesttype, this);
			}
			if(fieldName == "Incident.CustomFields.c.financial_back_office_reason")
			{
				RightNow.Event.subscribe("request_type_corporate", this.requesttype_setattribute, this);
			}
			if(fieldName != "Incident.CustomFields.c.financial_back_office_reason" && "Incident.CustomFields.c.corporate_escalation_reason")
			{
					RightNow.Event.subscribe("request_type_corporate", this.requesttype_none, this);
			}  
        }
		

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },

    /**
     * Sample widget method.
     */
    showrequesttype: function(type, args) {
	fieldName = this._FieldName;
	var value = args[0].data;
	if(value=="Corporate Escalation")
	{
	document.getElementById("escalate").style.display = "block";
	document.getElementById("office").style.display = "none";
	if(fieldName == "Incident.CustomFields.c.corporate_escalation_reason")
			{
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			  labelnew.innerHTML="Corporate Escalation Reason "+"<span class='rn_Required'> *</span>";
			  this.data.attrs.required=true;
			}
		}
	
	else 
 {
  this.input.set('value','');
  this.data.attrs.required=false;
 }
    },
	
	requesttype_setattribute: function(type, args) {
		fieldName = this._FieldName;
		var value = args[0].data;
		if(value=="Financial Back Office")
		{
		if(fieldName == "Incident.CustomFields.c.financial_back_office_reason")
		{
			document.getElementById("office").style.display = "block";	
	document.getElementById("escalate").style.display = "none";
		var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
  labelnew.innerHTML="Financial Back Office Reason "+"<span class='rn_Required'> *</span>";
  this.data.attrs.required=true;	
		}
		}
			else 
 {
	 		
  this.input.set('value','');
  this.data.attrs.required=false;
 }
		
	
	},
	
	
	requesttype_none: function(type, args) {
			 fieldName = this._FieldName;
		var value = args[0].data;
		if(value!=="Financial Back Office")
		{
			if(value!=="Corporate Escalation")
			{		
				if(fieldName != "Incident.CustomFields.c.financial_back_office_reason" && "Incident.CustomFields.c.corporate_escalation_reason")
				{
				document.getElementById("office").style.display = "none";	
				document.getElementById("escalate").style.display = "none";
				}
			}
		}
		else 
 		{
 		this.input.set('value','');
  		this.data.attrs.required=false;
 		}
		
},
	
	methodName: function() {

    },
	
	ReasonChanged: function()
	{
	this.Value = this._inputField.options[this._inputField.selectedIndex].text;
	var value = this.Value;
	var eventObject = new RightNow.Event.EventObject(this, {data:  value});
	RightNow.Event.fire("reason_changed", eventObject);	
		
		}
});