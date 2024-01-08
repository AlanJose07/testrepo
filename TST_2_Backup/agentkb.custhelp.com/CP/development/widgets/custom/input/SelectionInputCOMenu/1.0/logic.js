RightNow.namespace('Custom.Widgets.input.SelectionInputCOMenu');
Custom.Widgets.input.SelectionInputCOMenu = RightNow.Field.extend({ 
    overrides: {
        constructor: function(){
            if (this.data.js.readOnly) return;

            this.parent();

            var attrs = this.data.attrs;
            
            
            
            

			

            this.input = (this.data.js.type === "Boolean" && !attrs.display_as_checkbox)
                ? this.Y.all(this._inputSelector + "_1, " + this._inputSelector + "_0")
                : this.Y.one(this._inputSelector);

            if(!this.input) return;

            if(attrs.hint && !attrs.hide_hint && !attrs.always_show_hint) {
                this._initializeHint();
            }

            if(attrs.initial_focus && this.input) {
                if(this.data.js.type === "Boolean" && this.input[0] && this.input[0].focus)
                    this.input[0].focus();
                else if(this.input.focus)
                    this.input.focus();
            }

            if (attrs.validate_on_blur && attrs.required) {
                this.Y.Event.attach('blur', this.blurValidate, this.input instanceof this.Y.NodeList ? this.input.item(1) : this.input, this);
            }

            /*this.input.on('change', function() {
                this.fire('change', this);
            }, this);*/
			
			this.input.on('change',this.fireChange,this);
            //this.on("constraintChange", this.constraintChange, this);

            //specific events for specific fields:
            var fieldName = this.data.js.name;
			this._fieldName = fieldName;
			this.globalfieldname=this._fieldName;
			if(this._fieldName == "cf_injury_type"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
				RightNow.Event.subscribe("removeNoteField", this._removeNoteField,this);
				RightNow.Event.subscribe("reset_menu_values", this._reset_menu_fields,this);
				this.input.on("change", this.otherValueText, this);
			}
			if(this._fieldName == "cf_injury_part"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
				RightNow.Event.subscribe("removeNoteField", this._removeNoteField,this);
				RightNow.Event.subscribe("reset_menu_values", this._reset_menu_fields,this);
				this.input.on("change", this.otherValueText_injury_part, this);
			}
			if(this._fieldName == "cf_bike_parts"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
				RightNow.Event.subscribe("removeNoteField", this._removeNoteField,this);
				RightNow.Event.subscribe("reset_menu_values", this._reset_menu_fields,this);
				this.input.on("change", this.otherValueText_bike_parts_other, this);
			}
			if(this._fieldName == "cf_requested_qca"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
			}
			if(this._fieldName == "cf_medical_attention"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
				RightNow.Event.subscribe("Required", this._fields_required_menu, this);
				RightNow.Event.subscribe("notRequired", this._fields_not_required_menu, this);
				this.input.on("change", this.markPcfUrgent, this);
			}
			if(this.globalfieldname== "cf_sought_medical_attention"){ 
				RightNow.Event.subscribe("show_fields", this._displayBlock, this);
				RightNow.Event.subscribe("hide_fields", this._displayNone, this);
				this.input.on("change", this.markmedicalAttentionRequired, this);
			}
			if(this._fieldName == "cf_plastic_texture" || this._fieldName == "cf_plastic_color" || this._fieldName == "cf_plastic_size" || this._fieldName == "cf_unknown_filth_color" || this._fieldName == "cf_unknown_filth_appearance" || this._fieldName == "cf_insect_box_or_prod" || this._fieldName == "cf_pest_size" || this._fieldName == "cf_product_damage")
			{
			
			this.data.attrs.required = false;
				this.input.set('value','');
			
			
				RightNow.Event.subscribe("evt_PCchosen", this._setRequired, this);
			}
            this.parentForm().on("submit", this.onValidate, this);
        }
    },
    markPcfUrgent: function() {
		   var checkMenu = document.getElementById("rn_" + this.instanceID + "_" + "cf_medical_attention");
		  	 var formFieldDiv= document.getElementById("form_routing");
			 var chiledId=formFieldDiv.firstElementChild.id;
		   var formFieldId=document.getElementById(chiledId + "_" + "Incident"+"."+"CustomFields"+"."+"c"+"."+"form_routing");
		   if(checkMenu.value=="3" || checkMenu.value=="4" ||checkMenu.value=="5"){		    
				formFieldId.value="1955";
		  }
		  else
		  {	  
			   formFieldId.value="";
		  }
	
	 },
    markmedicalAttentionRequired: function() {
		   var yesValue = document.getElementById("rn_" + this.instanceID + "_" + "cf_sought_medical_attention");
		   if(yesValue.value=="1"){		    
				  RightNow.Event.fire("Required",this);
		  }
		  else
		  {	  
				RightNow.Event.fire("notRequired",this);
		  }
		  
	 },
    otherValueText: function() {
			 console.log("otehr text value");
			 var menuValue = document.getElementById("rn_" + this.instanceID + "_" + "cf_injury_type");
			 var othertext= document.getElementById("other_text");
			 var chiledId=othertext.firstElementChild.id;
			 this._inputField=document.getElementById(chiledId + "_" + "Complaint"+"."+"cf_injury_type_other");
			
			  if(menuValue.value=="11"){	
				  document.getElementById("other_text").style.display = "block";
				  RightNow.Event.fire("Required_other_option",this);
			  }		
			  else
			  {
					document.getElementById("other_text").style.display = "none";
					RightNow.Event.fire("notRequired_other_option",this);
			  }
	 },
	     otherValueText_injury_part: function() {
			 console.log("otherValueText_injury_part");
			 var menuValue = document.getElementById("rn_" + this.instanceID + "_" + "cf_injury_part");
			 var othertext= document.getElementById("other_text_injury");
			 var chiledId=othertext.firstElementChild.id;
			 this._inputField=document.getElementById(chiledId + "_" + "Complaint"+"."+"cf_body_parts_other");
			
			  if(menuValue.value=="16"){	
				  document.getElementById("other_text_injury").style.display = "block";
				  RightNow.Event.fire("Required_other_option_injury",this);
			  }		
			  else
			  {
					document.getElementById("other_text_injury").style.display = "none";
					RightNow.Event.fire("notRequired_other_option_injury",this);
			  }
	 },
	     otherValueText_bike_parts_other: function() {
			 console.log("otherValueText_bike_parts_other");
			 var menuValue = document.getElementById("rn_" + this.instanceID + "_" + "cf_bike_parts");
			 var othertext= document.getElementById("other_text_bike");
			 var chiledId=othertext.firstElementChild.id;
			 this._inputField=document.getElementById(chiledId + "_" + "Complaint"+"."+"cf_bike_parts_other");
			
			  if(menuValue.value=="10"){	
				  document.getElementById("other_text_bike").style.display = "block";
				  RightNow.Event.fire("Required_other_option_bike",this);
			  }		
			  else
			  {
					document.getElementById("other_text_bike").style.display = "none";
					RightNow.Event.fire("notRequired_other_option_bike",this);
			  }
	 },
	_fields_required: function(type,args)
	{ 
			this.data.attrs.required=true;
			 var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	},
	_fields_not_required: function(type,args)
	{
		    this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= this.data.attrs.label_input;
	},
		_naChanged:function(type, args){
        
        this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
		this._checkbox = document.getElementById("rn_" + this.instanceID + "_nacheck");
	    var Label = document.getElementById("rn_" + this.instanceID + "_Label");
        if (this._checkbox.checked){
            this.data.attrs.required = false;
            this._inputField.value = "";
            this._inputField.disabled = true;
            this._inputField.style.opacity = .6;
            Label.innerHTML = Label.innerHTML.replace('<span class="rn_Required">*</span>',' ');
        }else{
            this.data.attrs.required = true;
            this._inputField.disabled = false;
            this._inputField.style.opacity = 1;
            Label.innerHTML = Label.innerHTML.concat('<span class="rn_Required">*</span>');
        }	
		
    },
	_resetcheckbox:function(){
      this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
		this._checkbox = document.getElementById("rn_" + this.instanceID + "_nacheck");
	    var Label = document.getElementById("rn_" + this.instanceID + "_Label");
       if (this._checkbox.checked){
		   this.data.attrs.required = true;
            this._inputField.disabled = false;
            this._inputField.style.opacity = 1;
            Label.innerHTML = Label.innerHTML.concat('<span class="rn_Required">*</span>');
          
      }
      
    },
		_setNoteText_injury_type: function(type,args)
	{
		   var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		   var injury_type_note = document.getElementById("injury_type");
		   var newlabel = document.createElement("Label");
			newlabel.setAttribute("class", "note_injury_type");
			newlabel.setAttribute("id", "note_injury_type");
			newlabel.innerHTML = "NOTE: Agents to NOT read the drop down list below. Just select the best answer based on the customer description of the injury.";
			newlabel.style.fontWeight = "bold";
			newlabel.style.color = "red";
			label.appendChild(newlabel);
	},
		_set_checkbox: function(type,args)
	{ 
			                var nacheck_exsist= document.getElementById("rn_" + this.instanceID + "_" + "nacheck");
							if(nacheck_exsist)
							this._resetcheckbox(this);
					        if(this.data.attrs.showna && (!nacheck_exsist))
							{	
							var newdiv = document.getElementById("rn_" + this.instanceID + "_" + "Label");
							newdiv.style.cssFloat = "left";
							var anotherDiv = document.createElement('div');
							anotherDiv.classList.add('nacheck');
							anotherDiv.style.fontWeight="bold";
							anotherDiv.innerHTML="<input type='checkbox' id='rn_" + this.instanceID + "_" + "nacheck' " + "name='N/A' value='N/A'>N/A</input>";
							newdiv.after(anotherDiv);
							this._field = this.Y.one("#rn_" + this.instanceID + "_nacheck");
							this._field.on("change",this._naChanged,this); 
							} 
	},
		_setNoteText_injury_part: function(type,args)
	{
		   var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		   var injury_type_note = document.getElementById("injury_part");
		   var newlabel = document.createElement("Label");
			newlabel.setAttribute("class", "note_injury_part");
			newlabel.setAttribute("id", "note_injury_part");
			newlabel.innerHTML = "NOTE: Agents to NOT read the drop down list below. Just select the best answer based on the customer description of the injury.";
			newlabel.style.fontWeight = "bold";
			newlabel.style.color = "red";
			label.appendChild(newlabel);
	},
		_setNoteText_bike_parts: function(type,args)
	{
		   var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		   var injury_type_note = document.getElementById("bike_parts");
		   var newlabel = document.createElement("Label");
			newlabel.setAttribute("class", "note_bike_parts");
			newlabel.setAttribute("id", "note_bike_parts");
			newlabel.innerHTML = "NOTE: Agents do NOT read the drop down list below. Just select the best answer based on the customer description.";
			newlabel.style.fontWeight = "bold";
			newlabel.style.color = "red";
			label.appendChild(newlabel);
	},
	_setNoteText_medical_attention: function(type,args)
	{
		 var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		   var injury_type_note = document.getElementById("medical_attention");
		   var newlabel = document.createElement("Label");
			newlabel.setAttribute("class", "note_medical_attention");
			newlabel.setAttribute("id", "note_medical_attention");
			newlabel.innerHTML = "NOTE: Agents do NOT read the drop down list below. Just select the best answer based on the customer description.";
			newlabel.style.fontWeight = "bold";
			newlabel.style.color = "red";
			label.appendChild(newlabel);
	},
		_setNoteText_qca: function(type,args)
	{
		 var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
		   var injury_type_note = document.getElementById("qca");
		   var newlabel = document.createElement("Label");
			newlabel.setAttribute("class", "note_qca");
			newlabel.setAttribute("id", "note_qca");
			newlabel.innerHTML = "NOTE: Agents select “Yes” if customer was not directly transferred to the QCA phone line.";
			newlabel.style.fontWeight = "bold";
			newlabel.style.color = "red";
			label.appendChild(newlabel);
	},
	_fields_not_required_menu: function(type,args)
	{
		    this.data.attrs.required=false;
		    var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			label.innerHTML= this.data.attrs.label_input;
			 this._setNoteText_medical_attention();
	},
		_fields_required_menu: function(type,args)
	{ 
			this.data.attrs.required=true;
			 var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
			this._setNoteText_medical_attention();
	},
	_reset_menu_fields: function(type,args)
	{  
	
			var injurytype = document.getElementById("rn_" + this.instanceID + "_" + "cf_injury_type");
			if(injurytype)
			injurytype.value="";
			var injurypart = document.getElementById("rn_" + this.instanceID + "_" + "cf_injury_part");
			if(injurypart)
			injurypart.value="";
			var bikepart = document.getElementById("rn_" + this.instanceID + "_" + "cf_bike_parts");
			if(bikepart)
			bikepart.value="";
			
	},
	_removeNoteField:function() {
		var element1 = document.getElementById("note_injury_type");
		var element2 = document.getElementById("note_injury_part");
		var element3 = document.getElementById("note_bike_parts");
		var element4 = document.getElementById("note_medical_attention");
		var element5 = document.getElementById("note_qca");
		if(element1)
		 element1.remove();
	 	if(element2)
		 element2.remove();
	    if(element3)
		 element3.remove();
		 if(element4)
		 element4.remove();
	     if(element5)
		 element5.remove();
		
	},
		_displayNone: function(type,args)
	{
		if(this.globalfieldname=="cf_injury_type")
		{

			 document.getElementById("injury_type").style.display = "none";
			  this._fields_not_required();
		}
			if(this.globalfieldname=="cf_injury_part")
		{
			 document.getElementById("injury_part").style.display = "none";
			 this._fields_not_required();
		}
		if(this.globalfieldname=="cf_bike_parts")
		{
			 document.getElementById("bike_parts").style.display = "none";
			 this._fields_not_required();
		}
		if(this.globalfieldname=="cf_requested_qca")
		{
			 document.getElementById("qca").style.display = "none";
			 this._fields_not_required();
		}
		if(this.globalfieldname=="cf_medical_attention")
		{
			 document.getElementById("medical_attention").style.display = "none";
			 this._fields_not_required();
		}
		if(this.globalfieldname== "cf_sought_medical_attention"){ 
			 document.getElementById("sought_medical_attention").style.display = "none";
			 this._fields_not_required();
		}

	},
	_displayBlock: function(type,args)
	{
		if(this.globalfieldname=="cf_injury_type")
		{
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputField.style.width  ="100%";
			 document.getElementById("injury_type").style.display = "block";
			 this._setNoteText_injury_type();
			 this._fields_not_required();
			 //this._set_checkbox();
		}
		if(this.globalfieldname=="cf_injury_part")
		{
			 this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			 this._inputField.style.width  ="100%";
			 document.getElementById("injury_part").style.display = "block";
			 this._setNoteText_injury_part();
			 this._fields_not_required();
			 //this._set_checkbox();
		}
		if(this.globalfieldname=="cf_bike_parts")
		{
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputField.style.width  ="100%";
			 document.getElementById("bike_parts").style.display = "block";
			  this._setNoteText_bike_parts();
			 this._fields_not_required();
			 //this._set_checkbox();
		}
		if(this.globalfieldname== "cf_requested_qca"){ 
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputField.style.width  ="100%";
			 document.getElementById("qca").style.display = "block";
			 this._setNoteText_qca();
			 this._fields_not_required();
			// this._set_checkbox();
		}
			if(this.globalfieldname== "cf_medical_attention"){ 
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputField.style.width  ="100%";
			 document.getElementById("medical_attention").style.display = "block";
			 this._setNoteText_medical_attention();
			 this._fields_not_required();
			 //this._set_checkbox();
		}
			if(this.globalfieldname== "cf_sought_medical_attention"){ 
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			this._inputField.style.width  ="100%";
			 document.getElementById("sought_medical_attention").style.display = "block";
			 this._fields_not_required();
			// this._set_checkbox()
		}

	},
	
     /**
     * Used by Dynamic Forms to switch between a required and a non-required label
     * @param  {Object} container    The DOM node containing the label
     * @param  {Boolean} requiredness True or false
     * @param  {String} label        The label text to be inserted
     * @param  {String} template     The template text
     */
    swapLabel: function(container, requiredness, label, template) {
        var templateObject = {
            label: label,
            instanceID: this.instanceID,
            fieldName: this._fieldName,
            required: requiredness,
            requiredMarkLabel: RightNow.Interface.getMessage("FIELD_REQUIRED_MARK_LBL"),
            requiredLabel: RightNow.Interface.getMessage("REQUIRED_LBL"),
            hint: this.data.attrs.hint
        };

        container.setHTML('');
        container.append(new EJS({text: template}).render(templateObject));
    },

    /**
     * Triggered whenever a constraint is changed.
     * @param  {String} evt        The event name
     * @param  {Object} constraint A list of constraints being changed
     */
    constraintChange: function(evt, constraint) {
        constraint = constraint[0];
        if(constraint.required === this.data.attrs.required) return;

        //If the requiredness changed and the form has already validated, clear the messages and highlights
        this.toggleErrorIndicator(false);
        if(this.data.attrs.required && this.lastErrorLocation) {
            this.Y.one('#' + this.lastErrorLocation).all("[data-field='" + this._fieldName + "']").remove();
        }

        //Replace any old labels with new labels
        if(this.data.attrs.label_input) {
            if(this.data.js.type === 'Boolean' && !this.data.attrs.display_as_checkbox) {
                this.swapLabel(this.Y.one(this.baseSelector + '_Label'), constraint.required, this.data.attrs.label_input, this.getStatic().templates.legend);
            }
            else {
                this.swapLabel(this.Y.one(this.baseSelector + '_LabelContainer'), constraint.required, this.data.attrs.label_input, this.getStatic().templates.label);
            }
        }

        this.data.attrs.required = constraint.required;
    },

    /**
     * Event handler executed when form is being submitted.
     * @param {String} type Event name
     * @param {Array} args Event arguments
     */
    onValidate: function(type, args) {
        var eo = this.createEventObject(),
            errors = [];

        this.toggleErrorIndicator(false);

        if(!this.validate(errors)) {
            this.lastErrorLocation = args[0].data.error_location;
            this.displayError(errors, this.lastErrorLocation);
            RightNow.Event.fire("evt_formFieldValidationFailure", eo);
            return false;
        }

        RightNow.Event.fire("evt_formFieldValidationPass", eo);
        return eo;
    },

    /**
     * Adds error messages to the common error element and adds
     * error indicators to the widget field and label.
     * @param {Array} errors Error messages
     * @param {String} errorLocation ID of the common error element
     */
    displayError: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation);
        if(commonErrorDiv) {
            for(var id = ((this.input instanceof this.Y.NodeList) ? this.input.item(0).get("id") : this.input.get("id")),
                    i = 0, message; i < errors.length; i++) {
                message = errors[i];
                message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
                commonErrorDiv.append("<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                                "\").focus(); return false;'>" + message + "</a></b></div>");
            }
        }
        this.toggleErrorIndicator(true);
    },

    /**
     * Adds / removes the error indicators on the
     * field and label.
     * @param {Boolean} showOrHide T to add, F to remove
     */
    toggleErrorIndicator: function(showOrHide) {
        var method = ((showOrHide) ? "addClass" : "removeClass");
        this.input[method]("rn_ErrorField");
        this.Y.one(this.baseSelector + "_Label")[method]("rn_ErrorLabel");
    },

    /**
     * Validates the field's requiredness state.
     * Asserts that attrs.required is true.
     */
    blurValidate: function() {
        this.toggleErrorIndicator(!this.getValue());
    },

    /**
     * Event handler executed when country dropdown is changed.
     * Should only be called for the 'contacts.country_id' select field.
     */
    countryChanged: function() {
        var value = this.input.get("value"),
            fireResponse = function(response, eventObject) {
                RightNow.Event.fire("evt_provinceResponse", response, eventObject);
            };
        if(value) {
            var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
            if (RightNow.Event.fire("evt_provinceRequest", eventObject)) {
                this._provinces = this._provinces || {};
                if (this._provinces[value]) {
                    return fireResponse(this._provinces[value], eventObject);
                }
                RightNow.Ajax.makeRequest("/ci/ajaxRequestMin/getCountryValues", eventObject.data, {
                    successHandler: function(response) {
                        this._provinces[value] = response;
                        fireResponse(response, eventObject);
                    },
                    scope: this,
                    json: true,
                    type: "GETPOST"
                });
            }
        }
        else {
            fireResponse({ProvincesLength: 0, Provinces: {}});
        }
    },

    /**
     * Event handler executed when province/state data is returned from the server.
     * Should only be subscribed to by the 'contacts.prov_id' field.
     * @param type String Event name
     * @param args Object Event arguments
     */
    onProvinceResponse: function(type, args) {
        var response = args[0],
            options = '',
            provinces = response.Provinces,
            i, length;
        this.input.set("innerHTML", "");
        if (provinces) {
            if (!this.Y.Lang.isArray(provinces)) {
                // TK - remove when PHP toJSON converts array-like objects into arrays
                var temp = [];
                this.Y.Object.each(provinces, function(val) {
                    temp.push(val);
                });
                provinces = temp;
            }

            if (!provinces[0] || (provinces[0].Name !== "--" && !this.data.hideEmptyOption)) {
                provinces.unshift({Name: "--", ID: ""});
            }
            for (i = 0, length = provinces.length; i < length; i++) {
                options += "<option value='" + provinces[i].ID + "'>" + provinces[i].Name + "</option>";
            }
            this.input.append(options);
            this.input.set('value', this.currentState);
        }
        //Any subsequent province requests should go back to the initial value '--'
        this.currentState = '';
    },
	/*
	
	*/
	_setRequired: function(type,args) {
		if(args[0].data.prod.search("Foreign Material") > 0)
		{
			
			if((args[0].data.prod.search("Plastic") > 0)&&(this._fieldName == "cf_plastic_texture" || this._fieldName == "cf_plastic_color" || this._fieldName == "cf_plastic_size"))
			{
				
				this.data.attrs.required = true;
			}
			
			else if((args[0].data.prod.search("Unknown Filth") > 0)&&(this._fieldName == "cf_unknown_filth_color" || this._fieldName == "cf_unknown_filth_appearance"))
			{
				
				this.data.attrs.required = true;
			}
			else if((args[0].data.prod.search("Pests/Infestation") > 0)&&(this._fieldName == "cf_insect_box_or_prod" || this._fieldName == "cf_pest_size" || this._fieldName == "cf_product_damage"))
			{
				
				this.data.attrs.required = true;
			}
			else
			{
				
				this.data.attrs.required = false;
				this.input.set('value','');
			}
		}
		else
		{
			
			this.data.attrs.required = false;
			this.input.set('value','');
		}
			
	},
	/*
	fire on change
	*/
	fireChange: function(){
		 //var eventObject = new RightNow.Event.EventObject(this, {data: {country_id: value}});
         RightNow.Event.fire("change", this);
	}
});