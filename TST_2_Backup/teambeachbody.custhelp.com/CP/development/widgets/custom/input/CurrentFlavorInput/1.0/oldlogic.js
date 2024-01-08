RightNow.namespace('Custom.Widgets.input.CurrentFlavorInput');
Custom.Widgets.input.CurrentFlavorInput = RightNow.Widgets.SelectionInput.extend({ 
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
			this.instanceID = instanceID;
			this.data = data;
			this._inputSelector = this.baseSelector + "_" + this.data.attrs.name.replace(/\./g, "\\.");
		    this.input = this.Y.one(this._inputSelector);
			var FieldName = data.js.name;
			this._FieldName = FieldName;
			
			 this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
			
			if(FieldName === "Incident.CustomFields.c.current_flavor")
			{
				 RightNow.Event.subscribe("evt_formFieldValidateRequest", this._onValidate, this);
                 RightNow.Event.subscribe("evt_newFlavSelected", this._onNewFlavSelected, this);
				 RightNow.Event.on("evt_currentflavourResponse", this.onCurrentFlavourResponse, this);
  
				 this.input.on("change", this.CheckFlavorValue, this);
				 
				 
				
			}
			else if(FieldName === "Incident.CustomFields.c.reason_for_change")
			{
				this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
				 this.input.on("change", this.CheckReasonForChange, this);
			}
			
			else if(FieldName === "Incident.CustomFields.c.ordermodtype")
			{
				this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
				 this.input.on("change", this.Checkordermodtype, this);
			}
			else if(FieldName === "Incident.CustomFields.c.flavor1")
			{
				 RightNow.Event.on("evt_flavourResponse", this.onFlavourResponse, this);
				RightNow.Event.subscribe("evt_getCountryFields", this.setMenu, this);
				this._inputField = document.getElementById("rn_"+this.instanceID+"_"+FieldName);
				 this.input.on("change", this._newFlavourSelected, this);
				 
				 
			}
			
			var ClassName  = FieldName.replace(/\./g,'_');
			//alert(ClassName);
			this.Y.one(this._inputSelector).addClass(ClassName); // dynamically adding different class names
			//console.log(FieldName);
			
			
			
			
        },

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
          onValidate: function(type, args) 
		  {
				var eo = this.createEventObject(),
					errors = [];
				
					
				if(this._FieldName =="Incident.CustomFields.c.flavor1" || this._FieldName =="Incident.CustomFields.c.ordermodtype")
				{
		
				  eo.data = { 
						"name": "priv_note",
						"value": this._getPrivateNoteValue(),
						"required": false
					}; 
				
				}
					
		
				this.toggleErrorIndicator(false);
		
				if(!this.validate(errors)) {
					this.displayError(errors, args[0].data.error_location);
					RightNow.Event.fire("evt_formFieldValidationFailure", eo);
					return false;
				}
				
				RightNow.Event.fire("evt_formFieldValidationPass", eo);
				return eo;
         }
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
    methodName: function() {

    },
	
	/**
     * Event handler executed when form is being submitted
     *
     * @param type String Event name
     * @param args Object Event arguments
     */
   
    _getPrivateNoteValue: function()
    {
		
		       if(this._FieldName =="Incident.CustomFields.c.flavor1")
				{
					
				  return this._getTextForNewFlavor();
				}
				else if (this._FieldName =="Incident.CustomFields.c.ordermodtype")
				{
					return this._getValue();
					
				}
				
   
        
    },
	
   
	
	 _getValue: function()
    {
   
        return this._inputField.value;
    },
	
	   /**
    * Returns the String (text) of the element.
    * @return String/Boolean that is the field value
    */
    _getTextForNewFlavor: function()
    {
        if (this._inputField.selectedIndex > 0) {
            var value = "Shakeology Flavor Change." + "\n";
           value += "New Shakeology Flavor: " + this._inputField.options[this._inputField.selectedIndex].text + "\n";
            return value;
        }

        return "No Shakeology Flavor Change.";
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
	
	_newFlavourSelected: function(type,args)
	{
		var flavourSelected = this.input.get("value");
		RightNow.Event.fire("evt_newFlavourSelected", flavourSelected);
		
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
		RightNow.Event.fire("evt_OrderModePassValue", orderModeType);
	
	  
	  
	
	},
	 _getTextValue: function () 
	 {
        //select value
        return this._inputField.options[this._inputField.selectedIndex].text;
    },
	setMenu: function(type, args)
	{
		//alert("Njan Vannu");
		
		//console.log(args[0].data.country_id);
		if (args[0].data.country_id == 1)
		{
			this._beforeAjaxRequest;
			//alert("USA fl"); 
		//this.data.attrs.label_input = "Last 4 digits of social security number";	
		}
		else if (args[0].data.country_id==2)
		{
			//this._beforeAjaxRequest();
			//alert("Caneda fl");
			
		//this.data.attrs.label_input = "Last 4 digits of social insurance number";	
		}
		//console.log(this.data.attrs.label_input); 
		//return;
		

	},
	/*_beforeAjaxRequest: function () {
		alert("on or b4 ajax");
        var requestOptions = args[0];
		if (/cc\/ajaxRequest\/sendForm/.test(requestOptions.url)) { 
            requestOptions.url = "/cc/AjaxCustom/getMenu";
        }
    },*/
	
	
	 onFlavourResponse: function(type, args) {
	
	 		var response = args[0];
			var options = '',
            flavour = response.Flavour,
            i, length;

        this.input.set("innerHTML", "");
		var temp = [];
                this.Y.Object.each(args[0], function(val) {
                    temp.push(val);

                });
				 for (i = 0, length = temp.length; i < length; i++) {
					 if (i == 0)
					 {
					 	options += "<option selected = 'selected' value='" + temp[i].ID + "'>" + temp[i].LookupName +" </option>";  
					 }
					 else
					 	options += "<option value='" + temp[i].ID + "'>" + temp[i].LookupName + "</option>";              
            }
			console.log(options);
			 this.input.append(options);
            this.input.set('value', this. );

        this.currentState = '';
    },
	
	 onCurrentFlavourResponse: function(type, args) {

	 		var response = args[0];
			var options = '',
            flavour = response.Flavour,
            i, length;
			
        this.input.set("innerHTML", "");
		var temp = [];
                this.Y.Object.each(args[0], function(val) {
                    temp.push(val);
                });
				options += "<option selected = 'selected' value=''>" + "--" +" </option>";
				 for (i = 0, length = temp.length; i < length; i++) {
					 if (i == 0)
					 {
					 	options += "<option selected = 'selected' value='" + temp[i].ID + "'>" + temp[i].LookupName +" </option>";     
					 }
					 else
					 	options += "<option value='" + temp[i].ID + "'>" + temp[i].LookupName + "</option>";    
            }
			console.log(options);
			 this.input.append(options);
            this.input.set('value', this.currentState);
        this.currentState = '';
    }
	
	
	
	
});