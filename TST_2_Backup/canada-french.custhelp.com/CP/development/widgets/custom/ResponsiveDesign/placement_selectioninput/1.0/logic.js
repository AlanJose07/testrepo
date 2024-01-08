RightNow.namespace('Custom.Widgets.ResponsiveDesign.placement_selectioninput');
Custom.Widgets.ResponsiveDesign.placement_selectioninput = RightNow.Widgets.SelectionInput.extend({     /**
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
			this.data = data;
   			this.instanceID = instanceID;
			var fieldName = data.js.name;
			this.fieldName = this.data.js.name;
			this._inputField = document.getElementById("rn_"+this.instanceID+"_"+this.fieldName);
			
			if(fieldName=='Incident.CustomFields.c.ps_coach_new_position'){
				RightNow.Event.subscribe("requestdetails_placement",this._fields_required, this);
				RightNow.Event.subscribe("requestdetails_placement_notrequired",this._fields_not_required, this);
				this.input.on("change", this.coach_position_changed,this);
		    }
		    if(fieldName=='Incident.CustomFields.c.multiple_cbcs'){
			  RightNow.Event.subscribe("advanced_placement",this._fields_required_label, this);
			  RightNow.Event.subscribe("non_advanced_placement",this._fields_not_required, this);
			  RightNow.Event.subscribe("clearfieldvalue",this._clearfieldvalue, this);
			  this.input.on("change", this.multiple_cbcs_changed,this);
		    }
			if(fieldName=='Incident.CustomFields.c.change_sponsor_cbc_id'){
				RightNow.Event.subscribe("non_advanced_placement",this._fields_not_required, this);
				RightNow.Event.subscribe("clearfieldvalue",this._clearfieldvalue, this);
				RightNow.Event.subscribe("multiple_cbcs_yes",this._fields_required_label, this);
				RightNow.Event.subscribe("multiple_cbcs_no",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_new_coach_placed_specifically",this._clearfieldvalue, this);
				this.input.on("change", this.change_sponsor_cbc_id_changed,this);
				 
				
			}
			if(fieldName=='Incident.CustomFields.c.new_coach_placed_specifically'){
				RightNow.Event.subscribe("non_advanced_placement",this._fields_not_required, this);
				RightNow.Event.subscribe("clearfieldvalue",this._clearfieldvalue, this);
				RightNow.Event.subscribe("multiple_cbcs_no",this._fields_required_label, this);
				RightNow.Event.subscribe("multiple_cbcs_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_change_sponsor_cbc_id",this._clearfieldvalue, this);
				RightNow.Event.subscribe("change_sponsor_cbc_no",this._fields_required_label, this);
				RightNow.Event.subscribe("change_sponsor_cbc_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_new_coach_placed_specifically2",this._clearfieldvalue, this);
				RightNow.Event.subscribe("value_ccc_transfer_coachorder",this._fields_required_label, this);
				RightNow.Event.subscribe("no_value_ccc_transfer_coachorder",this._fields_not_required, this);
				RightNow.Event.subscribe("value_ccc_transfer_coachorder",this.hide_ccc_transfer_coachorder, this);
				RightNow.Event.subscribe("no_value_ccc_transfer_coachorder",this.hide_ccc_transfer_coachorder, this);
				RightNow.Event.subscribe("not_required_fields",this._fields_not_required, this);
				this.input.on("change", this.new_coach_placed_specifically_changed,this);
			}
			if(fieldName=='Incident.CustomFields.c.leg_placement'){
				RightNow.Event.subscribe("non_advanced_placement",this._fields_not_required, this);
				RightNow.Event.subscribe("clearfieldvalue",this._clearfieldvalue, this);
				RightNow.Event.subscribe("multiple_cbcs_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("multiple_cbcs_no",this._fields_not_required, this);
				RightNow.Event.subscribe("new_coach_placed_specifically_no",this._fields_label1_required, this);
				RightNow.Event.subscribe("new_coach_placed_specifically_yes",this._fields_label2_required, this);
				RightNow.Event.subscribe("new_coach_placed_specifically_reset",this._fields_not_required, this);
				RightNow.Event.subscribe("change_sponsor_cbc_yes",this._fields_not_required, this);
				RightNow.Event.subscribe("clear_leg_placement",this._clearfieldvalue, this);
				RightNow.Event.subscribe("not_required_fields",this._fields_not_required, this);
				
				
				
				
			}
			
        },
		
		toggleErrorIndicator: function(showOrHide) {
			if(this.data.js.name=='Incident.CustomFields.c.ps_coach_new_position' || this.data.js.name=='Incident.CustomFields.c.leg_placement'){
				var method = ((showOrHide) ? "addClass" : "removeClass");
				this.input[method]("rn_ErrorField");
				console.log(this.Y.one(this.baseSelector + "_LabelContainer"));
				this.Y.one(this.baseSelector + "_LabelContainer")[method]("rn_ErrorLabel");
			}else{
				var method = ((showOrHide) ? "addClass" : "removeClass");
				this.input[method]("rn_ErrorField");
				console.log(this.Y.one(this.baseSelector + "_LabelContainer"));
				this.Y.one(this.baseSelector + "_Label")[method]("rn_ErrorLabel");
			}
    	},
		/**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */        // swapLabel: function(container, requiredness, label, template)        // constraintChange: function(evt, constraint)        // onValidate: function(type, args)        // displayError: function(errors, errorLocation)        // toggleErrorIndicator: function(showOrHide)        // blurValidate: function()        // countryChanged: function()        // successHandler: function(response)        // onProvinceResponse: function(type, args)        // onStatusChanged: function()
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    },
	_fields_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_fields_label1_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
			this.data.attrs.label_input = "Veuillez sélectionner le nouveau placement de votre partner PP";
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_fields_label2_required: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
			this.data.attrs.label_input = "Branche gauche ou droite de l’identifiant de placement du partner?";
		    var label = document.getElementById("rn_" + this.instanceID + "_LabelContainer");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	_fields_not_required: function(type,args)
	{
		    this.data.attrs.required=false;
		    //var label = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			//label.innerHTML= this.data.attrs.label_input;
	},
	_fields_required_label: function(type,args)
	{ 
	        
			this.data.attrs.required=true;
		    var label = document.getElementById("rn_" + this.instanceID + "_Label");
			label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
	
	},
	hide_ccc_transfer_coachorder: function(type,args)
	{ 
		console.log(args);
		console.log(args[0].data);
		if(args[0].data){
			document.getElementById("new_coach_placed_specifically").style.display = "block";
		}else{
			document.getElementById("new_coach_placed_specifically").style.display = "none";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("leg_placement").style.display = "none";
			RightNow.Event.fire("clear_leg_placement","");
			RightNow.Event.fire("clear_ccc_transfer_coach_id","");
			//RightNow.Event.fire("clear_new_coach_placed_specifically","");
			RightNow.Event.fire("clear_new_coach_placed_specifically2","");
		}
	},
	coach_position_changed: function(type, args)
	{
			var id = new RightNow.Event.EventObject(this, {data:this._inputField.value});
			var coach_position_id = this._inputField.value;
			console.log(coach_position_id);
			if(coach_position_id == 1765){// --TBC-- Advanced Placement
				RightNow.Event.fire("advanced_placement",id);
				document.getElementById("multiple_cbcs").style.display = "block";
			}
			else{
				RightNow.Event.fire("non_advanced_placement",id);
				RightNow.Event.fire("clearfieldvalue",id);
				RightNow.Event.fire("ps_coach_preferred_customer_no",id);
				document.getElementById("multiple_cbcs").style.display = "none";
				document.getElementById("change_sponsor_cbc_id").style.display = "none";
				document.getElementById("new_coach_placed_specifically").style.display = "none";
				document.getElementById("ccc_transfer_coach_id").style.display = "none";
				document.getElementById("leg_placement").style.display = "none";
				document.getElementById("ccc_transfer_coachorder").style.display = "none";
			}
	},
	multiple_cbcs_changed: function(type, args)
	{
		var multiple_cbcs_value = document.querySelector('input[name="Incident\\.CustomFields\\.c\\.multiple_cbcs"]:checked').value;
		if(multiple_cbcs_value == 1){
			console.log("if"+multiple_cbcs_value);	
			RightNow.Event.fire("multiple_cbcs_yes",multiple_cbcs_value);
			RightNow.Event.fire("clear_new_coach_placed_specifically",multiple_cbcs_value);
			RightNow.Event.fire("clear_new_coach_placed_specifically2",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",multiple_cbcs_value);
			RightNow.Event.fire("clear_leg_placement",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coachorder",multiple_cbcs_value);
			document.getElementById("change_sponsor_cbc_id").style.display = "block";
			document.getElementById("new_coach_placed_specifically").style.display = "none";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("leg_placement").style.display = "none";
			document.getElementById("ccc_transfer_coachorder").style.display = "none";
		}else if(multiple_cbcs_value ==0){
			console.log("else"+multiple_cbcs_value);
			RightNow.Event.fire("multiple_cbcs_no",multiple_cbcs_value);
			RightNow.Event.fire("clear_change_sponsor_cbc_id",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",multiple_cbcs_value);
			RightNow.Event.fire("clear_leg_placement",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coachorder",multiple_cbcs_value);
			RightNow.Event.fire("ps_coach_preferred_customer_clear",multiple_cbcs_value);
			RightNow.Event.fire("ps_coach_preferred_customer_no",multiple_cbcs_value);
			document.getElementById("new_coach_placed_specifically").style.display = "block";
			document.getElementById("change_sponsor_cbc_id").style.display = "none";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("leg_placement").style.display = "none";
			document.getElementById("ccc_transfer_coachorder").style.display = "none";
		}else{
			RightNow.Event.fire("multiple_cbcs_reset",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",multiple_cbcs_value);
			RightNow.Event.fire("clear_leg_placement",multiple_cbcs_value);
			RightNow.Event.fire("clear_ccc_transfer_coachorder",multiple_cbcs_value);
			document.getElementById("new_coach_placed_specifically").style.display = "none";
			document.getElementById("change_sponsor_cbc_id").style.display = "none";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("leg_placement").style.display = "none";
			document.getElementById("ccc_transfer_coachorder").style.display = "none";
		}
	},
	change_sponsor_cbc_id_changed: function(type, args)
	{
		var change_sponsor_cbc_value = document.querySelector('input[name="Incident\\.CustomFields\\.c\\.change_sponsor_cbc_id"]:checked').value;
		if(change_sponsor_cbc_value == 1){
			RightNow.Event.fire("change_sponsor_cbc_yes",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_new_coach_placed_specifically2",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_leg_placement",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",change_sponsor_cbc_value);
			RightNow.Event.fire("ps_coach_preferred_customer_yes",change_sponsor_cbc_value);
			document.getElementById("ccc_transfer_coachorder").style.display = "block";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("new_coach_placed_specifically").style.display = "none";
			document.getElementById("leg_placement").style.display = "none";
		}else if(change_sponsor_cbc_value == 0){
			document.getElementById("ccc_transfer_coachorder").style.display = "none";
			RightNow.Event.fire("change_sponsor_cbc_no",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_ccc_transfer_coachorder",change_sponsor_cbc_value);
			 RightNow.Event.fire("ps_coach_preferred_customer_no",change_sponsor_cbc_value);
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("new_coach_placed_specifically").style.display = "block";
			
		}else{
			RightNow.Event.fire("change_sponsor_cbc_reset",change_sponsor_cbc_value);
			RightNow.Event.fire("clear_ccc_transfer_coachorder",change_sponsor_cbc_value);
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
			document.getElementById("new_coach_placed_specifically").style.display = "none";
			document.getElementById("ccc_transfer_coachorder").style.display = "none";
		}
	},
	new_coach_placed_specifically_changed: function(type, args)
	{
		var new_coach_placed_specifically_value = document.querySelector('input[name="Incident\\.CustomFields\\.c\\.new_coach_placed_specifically"]:checked').value;
		if(new_coach_placed_specifically_value == 1){
			RightNow.Event.fire("new_coach_placed_specifically_yes",new_coach_placed_specifically_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",new_coach_placed_specifically_value);
			document.getElementById("leg_placement").style.display = "block";
			document.getElementById("ccc_transfer_coach_id").style.display = "block";
		}else if(new_coach_placed_specifically_value == 0){
			RightNow.Event.fire("new_coach_placed_specifically_no",new_coach_placed_specifically_value);
			RightNow.Event.fire("clear_ccc_transfer_coach_id",new_coach_placed_specifically_value);
			document.getElementById("leg_placement").style.display = "block";
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
		}else{
			RightNow.Event.fire("new_coach_placed_specifically_reset",new_coach_placed_specifically_value);
			document.getElementById("ccc_transfer_coach_id").style.display = "none";
		}
	},
																								  
	_clearfieldvalue: function(type,args)
	{
		if(this.fieldName=='Incident.CustomFields.c.multiple_cbcs'){
			if ($('input[name="Incident\\.CustomFields\\.c\\.multiple_cbcs"]:checked').length > 0) {
				document.querySelector('input[name="Incident\\.CustomFields\\.c\\.multiple_cbcs"]:checked').checked = false;
			}
		}
		if(this.fieldName=='Incident.CustomFields.c.new_coach_placed_specifically'){
			if ($('input[name="Incident\\.CustomFields\\.c\\.new_coach_placed_specifically"]:checked').length > 0) {
				document.querySelector('input[name="Incident\\.CustomFields\\.c\\.new_coach_placed_specifically"]:checked').checked = false;
			}
		}
		if(this.fieldName=='Incident.CustomFields.c.change_sponsor_cbc_id'){
			if ($('input[name="Incident\\.CustomFields\\.c\\.change_sponsor_cbc_id"]:checked').length > 0) {
				document.querySelector('input[name="Incident\\.CustomFields\\.c\\.change_sponsor_cbc_id"]:checked').checked = false;
			}
		}
		if(this.fieldName=='Incident.CustomFields.c.leg_placement'){
			this.input.set('value','');
		}
	}
});