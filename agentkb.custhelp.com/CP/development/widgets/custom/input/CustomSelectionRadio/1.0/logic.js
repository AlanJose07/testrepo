RightNow.namespace('Custom.Widgets.input.CustomSelectionRadio');
Custom.Widgets.input.CustomSelectionRadio = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			//alert("hellooo");
		
	this.instanceID = instanceID;
	this.data = data;
	var fieldName = data.js.name;
	this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);//code by albin
	
	//alert(this.instanceID);
	//alert(this.data);
	
	if(fieldName == "Incident.CustomFields.c.pc_coach")
{

 
 this.input.on("change", this.coach_id_change, this);
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
	
	coach_id_change: function() {
		 //this._inputField = document.getElementsByName("rn_" + this.instanceID + "_" + this.data.js.name); 
        // console.log(this._inputField);
		
		 var rates = document.getElementsByName(this.data.js.name);
var rate_value;
for(var i = 0; i < rates.length; i++){
    if(rates[i].checked){
        rate_value = rates[i].value;
    }
	
	}
	
	

//alert(rate_value);
	var eventObject = new RightNow.Event.EventObject(this, {data:  rate_value});

	RightNow.Event.fire("evt_coach_id", eventObject);
	
/*if(rate_value == 0)
{
	alert("NO");
	document.getElementById("coach_id").style.display = "block";
	//var labelnew = document.getElementById("coach_id");
	//alert(labelnew);
	//labelnew.innerHTML= "Customer#";
}
if(rate_value == 1)
{
	alert("YES");
	document.getElementById("coach_id").style.display = "block";	
	//var labelnew = document.getElementById("coach_id");
	//labelnew.innerHTML= "Coach ID";
}*/



	//alert("Hello");
	//var value=args[0];
	//console.log(args);
	},
    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});