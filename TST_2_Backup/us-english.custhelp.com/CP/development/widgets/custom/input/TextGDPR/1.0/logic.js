RightNow.namespace('Custom.Widgets.input.TextGDPR');
Custom.Widgets.input.TextGDPR = RightNow.Widgets.TextInput.extend({
	/**EN
	 * Place all properties that intend to
	 * override those of the same name in
	 * the parent inside `overrides`.
	 */
	overrides: {
		/**
		 * Overrides RightNow.Widgets.TextInput#constructor.
		 */
		constructor: function (data, instanceID) {
			// Call into parent's constructor
			this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
			RightNow.Event.subscribe("evt_membertype_changed", this.validationReset, this);
			if (fieldName == "Incident.CustomFields.c.coachcustomernumber" || fieldName == "Incident.CustomFields.c.last_four_ssn") {
				RightNow.Event.subscribe("evt_membertype_changed", this.coach_make_required, this);
			}
			else if (fieldName == "Incident.CustomFields.c.search_first_name" || fieldName == "Incident.CustomFields.c.search_last_name" || fieldName == "Incident.CustomFields.c.search_email") {
				RightNow.Event.subscribe("evt_statetype_changed", this.auth_make_required, this);
				RightNow.Event.subscribe("evt_authcheckbox", this.auth_make_required, this);
			} else if (fieldName == "Incident.CustomFields.c.billing_zip_postal_code") {
				RightNow.Event.subscribe("evt_membertype_changed", this.customer_make_required, this);
			} else if (fieldName == "Incident.CustomFields.c.gdpr_text") {
				RightNow.Event.subscribe("evt_membertype_changed", this.set_mem_id, this);
				RightNow.Event.subscribe("evt_country_changed", this.set_country_id, this);
				RightNow.Event.subscribe("evt_righttype_changed", this.display_gdprtext, this);
				//sriram
				RightNow.Event.subscribe("evt_othertype_changed", this.otherTypeChanged, this);
				//sriram
			}

		}

		/**
		 * Overridable methods from TextInput:
		 *
		 * Call `this.parent()` inside of function bodies
		 * (with expected parameters) to call the parent
		 * method being overridden.
		 */
		// swapLabel: function(container, requiredness, label, template)
		// constraintChange: function(evt, constraint)
		// getVerificationValue: function()
		// onValidate: function(type, args)
		// _displayError: function(errors, errorLocation)
		// toggleErrorIndicator: function(showOrHide, fieldToHighlight, labelToHighlight)
		// _toggleFormSubmittingFlag: function(event)
		// _blurValidate: function(event, validateVerifyField)
		// _validateVerifyField: function(errors)
		// _checkExistingAccount: function()
		// _massageValueForModificationCheck: function(value)
		// _onAccountExistsResponse: function(response, originalEventObject)
		// onProvinceChange: function(type, args)
		// _initializeMask: function()
		// _createMaskArray: function(mask)
		// _getSimpleMaskString: function()
		// _compareInputToMask: function(submitting)
		// _showMaskMessage: function(error)
		// _setMaskMessage: function(message)
		// _showMask: function()
		// _hideMaskMessage: function()
		// _onValidateFailure: function()
	},

	/**
	 * Sample widget method.
	 */
	methodName: function () {

	},

	//sriram
	otherTypeChanged: function (type, args) {

		var other_type_data = args[0].data.other_type_data;

		//alert(y);
		if (other_type_data == "1") {
			//document.getElementById("other_object_data").style.display="block";
			document.getElementById("update_object_data").style.display = "block";



			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			document.getElementById("rn_" + this.instanceID + "_" + "Label").style.display = "none";

			this.data.attrs.label_input = "Description of what you would like to opt out of";

			this.data.attrs.required = true;
			document.getElementById("desc1").style.display = "block";
			document.getElementById("desc").style.display = "none";
			document.getElementById("desc_uk").style.display = "none";




		}
		else {
			//document.getElementById("other_object_data").style.display="none";
			document.getElementById("update_object_data").style.display = "none";

			this.input.set('value', '');
			this.data.attrs.required = false;

			this.data.attrs.label_input = "";
			document.getElementById("desc1").style.display = "block";

		}

	},
	//sriram

	set_mem_id: function (type, args) {
		var mem_id = args[0].data.membertype;
		this.mem_id = mem_id;
	},

	set_country_id: function (type, args) {
		//console.log(args);
		var country_id = args[0].data.countryid;
		this.country_id = country_id;
		//alert(this.country_id);
	},

	display_gdprtext: function (type, args) {
		//console.log(this.mem_id);
		//console.log(args);
		var right_type_id = args[0].data.rightType;
		if (this.mem_id == 389 || this.mem_id == 388 || this.mem_id == 1725) {
			if (right_type_id == 1507) {
				document.getElementById("update_object_data").style.display = "block";
				//document.getElementById("other_object_data").style.display="none";
				if (this.country_id == 70) {
					document.getElementById("desc_uk").style.display = "block";
					document.getElementById("desc").style.display = "none";
				}
				else {
					document.getElementById("desc").style.display = "block";
					document.getElementById("desc_uk").style.display = "none";
				}
				document.getElementById("desc1").style.display = "none";
				var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
				this.data.attrs.required = true;
				this.data.attrs.label_input = "Description of what you would like to correct";




			} else {
				document.getElementById("update_object_data").style.display = "none";
				//added by sriram--starts
				this.input.set('value', '');
				this.data.attrs.required = false;
				this.data.attrs.label_input = "";
				document.getElementById("desc").style.display = "none";
				document.getElementById("desc_uk").style.display = "none";

				//added by sriram--ends



			}
		} else {
			document.getElementById("update_object_data").style.display = "none";
			//added by sriram--starts
			this.input.set('value', '');
			this.data.attrs.required = false;
			this.data.attrs.label_input = "";
			document.getElementById("desc").style.display = "none";
			document.getElementById("desc_uk").style.display = "none";

			//added by sriram--ends

		}
	},
	coach_make_required: function (type, args) {

		var mem_id = args[0].data.membertype;
		if (mem_id == 388) {
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML = this.data.attrs.label_input + "<span class='rn_Required'> *</span>";
			this.data.attrs.required = true;
		}

		else {
			this.input.set('value', '');

			this.data.attrs.required = false;
		}
	},
	auth_make_required: function (type, args) {
		var chckbx = args[0].data.isChecked;
		//var state_id=args[0].data.statetype;
		var state_id = document.getElementById("rn_SelectGDPR_10_Incident.CustomFields.c.gdpr_us_states").value;
		//alert(state_id);
		//alert(chckbx);
		if (state_id == 1964 && chckbx == true) {
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML = this.data.attrs.label_input + "<span class='rn_Required'> *</span>";
			this.data.attrs.required = true;
		}

		else {
			this.input.set('value', '');

			this.data.attrs.required = false;
		}
	},
	validationReset: function (type, args) {
		console.log(args);
		let inputFirstName = document.getElementsByName(`${this.data.attrs.name}`)[0];
		inputFirstName.classList.remove("rn_ErrorField");
		document.querySelector(`label[for="${inputFirstName.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");
	},
	customer_make_required: function (type, args) {
		var mem_id = args[0].data.membertype;
		if (mem_id == 389 || mem_id == 388 || mem_id == 1725) {
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML = this.data.attrs.label_input + "<span class='rn_Required'> *</span>";
			this.data.attrs.required = true;
		}

		else {
			this.input.set('value', '');

			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML = this.data.attrs.label_input;

			this.data.attrs.required = false;
		}

		// let inputFirstName = document.getElementsByName("Contact.Name.First")[0];
		// inputFirstName.classList.remove("rn_ErrorField");
		// document.querySelector(`label[for="${inputFirstName.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");

		// let inputLastName = document.getElementsByName("Contact.Name.Last")[0];
		// inputLastName.classList.remove("rn_ErrorField");
		// document.querySelector(`label[for="${inputLastName.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");

		// let inputEmail = document.getElementsByName("Contact.Emails.PRIMARY.Address")[0];
		// inputEmail.classList.remove("rn_ErrorField");
		// document.querySelector(`label[for="${inputEmail.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");

		// let inputZipCode = document.getElementsByName("Incident.CustomFields.c.billing_zip_postal_code")[0];
		// inputZipCode.classList.remove("rn_ErrorField");
		// document.querySelector(`label[for="${inputZipCode.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");
	}
});
// document.querySelector('label[for="rn_TextInput_20_Contact.Name.First"]').classList.remove("rn_ErrorLabel")