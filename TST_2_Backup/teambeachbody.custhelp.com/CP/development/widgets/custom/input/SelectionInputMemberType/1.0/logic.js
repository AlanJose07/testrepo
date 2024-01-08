RightNow.namespace('Custom.Widgets.input.SelectionInputMemberType');
Custom.Widgets.input.SelectionInputMemberType = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: 
	{
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
			this.data.attrs.required = false;
			RightNow.Event.subscribe("evt_getshowhiddenfields", this.showtheFields, this);
			RightNow.Event.subscribe("evt_getShowFields", this.showhideFields, this);
			
			if(FieldName === "Incident.CustomFields.c.member_type")
			{
				this.data.attrs.required = true;
			//	 this._inputField = document.getElementById("rn_SelectionInput_6_Incident.CustomFields.c.member_type");
				  this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);	
				// alert( this._inputField + "member");
				 this.input.on("change", this.memberTypeChanged, this);
				 //alert( this.input + "member");
				
			}
			/*if(FieldName === "Contact.Address.Country")
			{
				//console.log(this.data);
				//console.log("yogesh");
				this.data.attrs.required = true;
			//	 this._inputField = document.getElementById("rn_SelectionInput_6_Incident.CustomFields.c.member_type");
				  this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);	
				 // alert( this._inputField + "country");
				  //this.input.on("change", this.memberTypeChanged, this);
				 this.input.on("change", this.countrySelectChanged, this);
				//  alert( this.input + "country");
			}*/
			
			
			
			
			else if(FieldName === "Incident.CustomFields.c.coach_request_type")	
			{
				 this.data.attrs.required = false;
				 RightNow.Event.subscribe("evt_getShowFields", this.showFields, this);
				
			}
			else if(FieldName === "Incident.CustomFields.c.current_flavor")	
			{
				
				 //this._inputField = document.getElementById("rn_SelectionInputMemberType_10_Incident.CustomFields.c.current_flavor");
				 this.input.on("change", this.currentFlavorChanged, this);
				
			}
			//Changed to save shakemodtype 27-May-2014
			else if(FieldName === "Incident.CustomFields.c.shakemodtype")	
			{
				
				RightNow.Event.subscribe("evt_getShowFields", this.setShakemode, this);
			}
				 
				
			
		
			},
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
	
	
	
memberTypeChanged: function()
	{		
        var value = this.input.get("value");
		//alert(value);
	    var eventObject = new RightNow.Event.EventObject(this, {data: {memb_id: value}});
        RightNow.Event.fire("evt_getShowFields", eventObject); 	
		
	},
	/*countrySelectChanged: function()
	{
		
		
		//alert("Kooi");
      	var value = this.input.get("value");
		//alert(value);
		
	    var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
        RightNow.Event.fire("evt_getCountryFields", eventObject); 	
		
		
	},*/
	
	
currentFlavorChanged: function()
	{
		//console.log("dfsdfs");
		//alert("In function");
        var value = this.input.get("value");
	    var eventObject = new RightNow.Event.EventObject(this, {data: {memb_id: value}});
        RightNow.Event.fire("evt_getshowhiddenfields", eventObject); 	
		
	},

showFields: function(type, args)
	{
		
		var mem_type = (args[0].data.memb_id);
		if(mem_type == 50)
			{
				this.data.attrs.required = true;
				document.getElementById("shoehide").style.display = "block";
				
				
			} 
		else
			{
				this.data.attrs.required = false;
				this.data.js.initialValue = null;
				var da=document.getElementsByName("Incident.CustomFields.c.coachcustomernumber");
				da[0].value = null;
				var dat=document.getElementsByName("Incident.CustomFields.c.coach_request_type");
				dat[0].value = "";
				document.getElementById("shoehide").style.display = "none";
			
			}

	},
	//event on change shakemodtype
	setShakemode: function(type, args)
	{
		
			var str=this._inputSelector;
			
    var strin=str.split("#"); 
    var strid=strin[1].replace("\\","").replace("\\","").replace("\\","");
	
	var mem_type = (args[0].data.memb_id);	
		
		if(mem_type == 50)
			{
  			document.getElementById(strid).value = "287";//.getElementsByTagName("option")[2].selected = "selected";
			}
			else if (mem_type == 49)
			{
				 document.getElementById(strid).value = "286";//.getElementsByTagName("option")[1].selected = "selected";
			}
       
		
	},
	//New function Written for show/hide div while selecting a member type (Customer/Coach)
	showhideFields: function(type, args)
	{
		
		var mem_type = (args[0].data.memb_id);	
		
		if(mem_type == 50)
			{
				this.data.attrs.required = true;
				document.getElementById("divcoachid").style.display = "block";
				document.getElementById("divssn").style.display = "block";
				document.getElementById("divcoachnote").style.display = "block";
				document.getElementById("spCoach").style.display = "block";
				document.getElementById("spCustomer").style.display = "none";
				document.getElementById("spCustomerHeader").style.display = "none";
				document.getElementById("spCoachHeader").style.display = "block";
				
				
			} 
		else
			{
			/*	this.data.attrs.required = false;
				this.data.js.initialValue = null;
				var da=document.getElementsByName("Incident.CustomFields.c.coachcustomernumber");
				da[0].value = null;
				var dat=document.getElementsByName("Incident.CustomFields.c.coach_request_type");
				dat[0].value = "";*/
				
				document.getElementById("divcoachid").style.display = "none";
				document.getElementById("divssn").style.display = "none";
				document.getElementById("divcoachnote").style.display = "none";
				//Footer Div
				document.getElementById("spCustomer").style.display = "block";
				document.getElementById("spCoach").style.display = "none";
				//Header Div
				document.getElementById("spCustomerHeader").style.display = "block";
				document.getElementById("spCoachHeader").style.display = "none";
		
			}

	},
	
	showtheFields: function(type, args)
	{
		//alert("kjbhkjnkj");
		var mem_type = (args[0].data.memb_id);
		//alert(mem_type);
		if(mem_type == "")
			{
				//alert("Vannu");
				//this.data.attrs.required = true;
				document.getElementById("input_wrapper").style.display = "none";
				document.getElementById("txt_display").style.display = "none";
				
			} 
		else
			{
				//this.data.attrs.required = false;
				//this.data.js.initialValue = null;
				//var da=document.getElementsByName("Incident.CustomFields.c.coachcustomernumber");
				//da[0].value = null;
				//var dat=document.getElementsByName("Incident.CustomFields.c.coach_request_type");
				//dat[0].value = "";
				document.getElementById("input_wrapper").style.display = "block";
				document.getElementById("txt_display").style.display = "block";
			}

	},

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	    _onValidate: function(type, args)
    {
        this._parentForm = this._parentForm || RightNow.UI.findParentForm("rn_" + this.instanceID);
        var eo = new RightNow.Event.EventObject();
        eo.data = {
            "name" : this.data.js.name,
            "value" : this._getValue(),
            "table" : "incidents",
            "required" : (this.data.attrs.required ? true : false),
            "prev" : this.data.js.prev,
            "form" : this._parentForm
            };
        if (RightNow.UI.Form.form === this._parentForm)
        {
            this._formErrorLocation = args[0].data.error_location;

            if(this._validateRequirement())
            {
                if(this.data.js.profile)
                    eo.data.profile = true;
                if(this.data.js.customID)
                {
                    eo.data.custom = true;
                    eo.data.customID = this.data.js.customID;
                    eo.data.customType = this.data.js.type;
                }
                else
                {
                    eo.data.custom = false;
                }
                eo.w_id = this.data.info.w_id;
                RightNow.Event.fire("evt_formFieldValidateResponse", eo);
            }
            else
            {
                RightNow.UI.Form.formError = true;
            }
        }
        else
        {
            RightNow.Event.fire("evt_formFieldValidateResponse", eo);
        }
        RightNow.Event.fire("evt_formFieldCountRequest");
    },
	
	 _getValue: function()
    {
         if(this.data.js.type === RightNow.Interface.Constants.EUF_DT_INT)
        {
            if(this._inputField.value !== "")
                return parseInt(this._inputField.value);
        }
        if(this.data.js.mask)
            return this._stripMaskFromFieldValue();
        return this._inputField.value;
    },
	
	CheckReasonForChange: function(type,args)
	{
		var ReasonForChange = this.input.get("value");
		
		if(this._getTextValue() != "Other")
		{
           
			 this.Y.one('#rn_please_explain').addClass('rn_Hidden');
        } 
		else 
		{
           
			 this.Y.one('#rn_please_explain').removeClass('rn_Hidden');
        }
	},
	
	CheckFlavorValue: function(type, args)
	{
		
		
		var Flavorvalue = this.input.get("value");
		if(Flavorvalue=="")
		{
			 this.data.attrs.required = true;
	       // this.Y. YAHOO.util.Dom.addClass("rn_" + this.instanceID , "rn_Hidden");
			// this.Y.one('#rn_'+ this.instanceID).addClass('rn_Hidden');
			 this.Y.one('#rn_ChangeOptions').addClass('rn_Hidden');
			
	         //YAHOO.util.Dom.removeClass('rn_ChangeOptions', "rn_EditSelectionHidden");
			
		}
		else
		{
			
			 this.data.attrs.required = false;
    	     //YAHOO.util.Dom.removeClass("rn_" + this.instanceID, "rn_Hidden"); 
    	     //YAHOO.util.Dom.addClass('rn_ChangeOptions', "rn_EditSelectionHidden");
			  this.Y.one('#rn_ChangeOptions').removeClass('rn_Hidden');
			
		}
		
	   
	},
	
	Checkordermodtype: function(type, args)
	{
	  var orderModeType = this.input.get("value");
	  
	  var evtObj = new RightNow.Event.EventObject();
    	if(orderModeType == 290)
        {
        	 evtObj.data = {"HideAddress" : true}; 
        	 this.Y.one('#ordermodtype').removeClass('rn_Hidden');
			  
        }
		else
		{
        	evtObj.data = {"HideAddress" : false};
        	this.Y.one('#ordermodtype').addClass('rn_Hidden');
			 
		}

        RightNow.Event.fire("evt_oneTimeHide", evtObj);
	
	  
	  
	
	},
	 _getTextValue: function () {
        //select value
        return this._inputField.options[this._inputField.selectedIndex].text;
    },
	
	

});