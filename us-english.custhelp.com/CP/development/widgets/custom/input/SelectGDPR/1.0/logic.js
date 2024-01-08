RightNow.namespace('Custom.Widgets.input.SelectGDPR');
Custom.Widgets.input.SelectGDPR = RightNow.Widgets.SelectionInput.extend({
	/**
	 * Place all properties that intend to
	 * override those of the same name in
	 * the parent inside `overrides`.TST 2
	 */
	overrides: {
		/**
		 * Overrides RightNow.Widgets.SelectionInput#constructor.
		 */
		constructor: function (data, instanceID) {
			// Call into parent's constructor
			this.parent();
			this.instanceID = instanceID;
			this.data = data;
			var fieldName = data.js.name;
			this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);

			if (fieldName == "Incident.CustomFields.c.member_type_new") {
				//RightNow.Event.subscribe("evt_country_changed", this.ResetMemberType, this);
				RightNow.Event.subscribe("evt_country_changed", this.ResetMemberType, this);
				this.input.on("change", this.member_type_changed, this);
			} else if (fieldName == "Incident.CustomFields.c.gdpr_us_states") {
				RightNow.Event.subscribe("evt_country_changed", this.ResetMemberType, this);
				this.input.on("change", this.state_type_changed, this);
				this.input.on("change", this.member_type_changed, this);

			} else if (fieldName == "Incident.CustomFields.c.dsrm_right_type") {
				RightNow.Event.subscribe("evt_membertype_changed", this.fetch_mem_id, this);
				RightNow.Event.subscribe("evt_membertype_changed", this.display_right_data, this);

				//RightNow.Event.subscribe("evt_country_changed", this.setCOuntryID, this);
				this.input.on("change", this.right_type_changed, this);
			} else if (fieldName == "Incident.CustomFields.c.dsrm_object_data") {
				RightNow.Event.subscribe("evt_membertype_changed", this.fetch_mem_id, this);
				RightNow.Event.subscribe("evt_righttype_changed", this.display_objectdata, this);
				//added by sriram for data object data starts

				RightNow.Event.subscribe("evt_country_changed", this.getCountryId, this);
				RightNow.Event.subscribe("evt_objection_changed", this.display_objection_data, this);
				//added by sriram for data object data ends

				this.input.on("change", this.object_my_data_changed, this);
			} else if (fieldName == "Contact.Address.Country") {
				var menuvalue = document.getElementById("rn_" + this.instanceID + "_" + "Contact.Address.Country");
				if (menuvalue.value == 1) {
					var labels = document.getElementById("rn_SelectGDPR_10_Label");
					//label_input="Select State of Residence";
					labels.innerHTML = "Select State of Residence" + "<span class='rn_Required'> *</span>";
					document.getElementById("CountryFields").style.display = "none";
					document.getElementById("StateFields").style.display = "block";

				} else if (menuvalue.value == 2 || menuvalue.value == 70) {
					document.getElementById("CountryFields").style.display = "block";
					document.getElementById("StateFields").style.display = "none";

				}
				else {
					document.getElementById("CountryFields").style.display = "none";
					document.getElementById("StateFields").style.display = "none";

				}
				this.input.on("change", this.Country_changed, this);
			}

			/*else if(fieldName == "Contact.Address.StateOrProvince" ) {
				var menuvalue=document.getElementById("rn_" + this.instanceID + "_" + "Contact.Address.StateOrProvince");
				if(menuvalue.value)
					document.getElementById("StateFields").style.display="block";
				else
					document.getElementById("StateFields").style.display="none";
				this.input.on("change", this.State_changed, this);
			}*/

		}

		/**
		 * Overridable methods from SelectionInput:
		 *
		 * Call `this.parent()` inside of function bodies
		 * (with expected parameters) to call the parent
		 * method being overridden.
		 */
		// swapLabel: function(container, requiredness, label, template)
		// constraintChange: function(evt, constraint)
		// onValidate: function(type, args)
		// displayError: function(errors, errorLocation)
		// toggleErrorIndicator: function(showOrHide)
		// blurValidate: function()
		// countryChanged: function()
		// successHandler: function(response)
		// onProvinceResponse: function(type, args)
		// onStatusChanged: function()
	},

	/**
	 * Sample widget method.
	 */
	methodName: function () {

	},
	setCOuntryID: function (type, args) {

		this.countryID = args[0].data.countryid;
		if ((this.mem_id == 389 || this.mem_id == 388 || this.mem_id == 1725) && (this.countryID == 70)) {
			//alert("adding");

			//code to add right of deletion
			var x = this._inputField
			var c = document.createElement("option");
			c.text = "Right of Deletion";
			c.value = 1506;
			x.options.add(c, 4);


		}
		else {
			//code to remove right of deletion
			if (this.countryID == 1 || this.countryID == 2) {
				//alert("testing removing")
				this._inputField.options.remove(4);
			}

			/*if(this.mem_id==389){
			this._inputField.options[1].setAttribute("title","Customer Right of Access/Portability");
			this._inputField.options[2].setAttribute("title","Customer Right of Correction");
			this._inputField.options[3].setAttribute("title","Customer Right of Objection/Restriction");
			}
			else if(this.mem_id==388){
				this._inputField.options[1].setAttribute("title","Coach Right of Access/Portability");
				this._inputField.options[2].setAttribute("title","Coach Right of Correction");
				this._inputField.options[3].setAttribute("title","Coach Right of Objection/Restriction");
			}*/
		}



	},
	getCountryId: function (type, args) {
		this.country_id = args[0].data.countryid;

	},
	ResetMemberType: function (type, args) {

		this.country_id = args[0].data.countryid;
		this._inputField.value = "";

		if ((this.country_id == 2) || (this.country_id == 70)) {
			document.getElementById("disclaimer_checkbox").style.display = "none";
			document.getElementById("StateFields").style.display = "none";
			document.getElementById("CountryFields").style.display = "block";
			document.getElementById("totalFields").style.display = "none";
			document.getElementById("right_type_data").style.display = "none";
			document.getElementById("my_object_data").style.display = "none";
			//document.getElementById("update_object_data").style.display="none";
			document.getElementById("delete_object_data").style.display = "none";
			document.getElementById("delete_object_data_pc").style.display = "none";

		} else if ((this.country_id == 1)) {
			document.getElementById("CountryFields").style.display = "none";
			document.getElementById("StateFields").style.display = "block";
			document.getElementById("totalFields").style.display = "none";
			document.getElementById("right_type_data").style.display = "none";
			document.getElementById("my_object_data").style.display = "none";
			//document.getElementById("update_object_data").style.display="none";
			document.getElementById("delete_object_data").style.display = "none";
			document.getElementById("delete_object_data_pc").style.display = "none";
			//document.getElementById("disclaimer_checkbox").style.display="block";

		}

		else {
			document.getElementById("CountryFields").style.display = "none";
			document.getElementById("totalFields").style.display = "none";
			document.getElementById("StateFields").style.display = "none";
			document.getElementById("disclaimer_checkbox").style.display = "none";
		}
	},

	Country_changed: function (type, args) {
		var country_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);

		var eventObj = new RightNow.Event.EventObject(this, { data: { countryid: country_id } });
		RightNow.Event.fire("evt_country_changed", eventObj);

		document.getElementById("update_object_data").style.display = "none";
		document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
		document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";

		if (country_id == 1) {
			document.getElementById("StateFields").style.display = "block";
			var labels = document.getElementById("rn_SelectGDPR_10_Label");
			labels.innerHTML = "Select State of Residence" + "<span class='rn_Required'> *</span>";
			//	labels.innerHTML = this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
		} else {
			document.getElementById("StateFields").style.display = "none";
			document.getElementById("terms_conditions_auth").checked = false;
			document.getElementById("authFields").style.display = "none";
		}

		if (document.getElementById("terms_conditions_auth").checked == "false") {
			document.getElementById("checkbox_comment").style.display = "none";
		}
	},

	fetch_mem_id: function (type, args) {

		this.mem_id = args[0].data.membertype;
		document.getElementById("update_object_data").style.display = "none";
		//document.getElementById("other_object_data").style.display="none";
		document.getElementById("delete_object_data").style.display = "none";
		document.getElementById("my_object_data").style.display = "none";
		document.getElementById("delete_object_data_pc").style.display = "none";
		this._inputField.value = "";


	},


	object_my_data_changed: function () {
		//console.log(this.mem_id);
		var object_data_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;


		if (this.mem_id == 389 || this.mem_id == 388 || this.mem_id == 1725) {
			if (object_data_id == 1526) {
				//document.getElementById("other_object_data").style.display="block";
				var eventObj = new RightNow.Event.EventObject(this, { data: { other_type_data: "1" } });
				RightNow.Event.fire("evt_othertype_changed", eventObj);

			} else {

				//document.getElementById("other_object_data").style.display="none";
				var eventObj = new RightNow.Event.EventObject(this, { data: { other_type_data: "2" } });
				RightNow.Event.fire("evt_othertype_changed", eventObj);

			}
		} else {
			//document.getElementById("other_object_data").style.display="none";
			var eventObj = new RightNow.Event.EventObject(this, { data: { other_type_data: "2" } });
			RightNow.Event.fire("evt_othertype_changed", eventObj);

		}
	},

	display_objectdata: function (type, args) {

		//this.rightTypeId= args[0].data.rightType;
		//alert(args[0].data.rightType);
		var right_type_id = args[0].data.rightType;
		this._inputField.value = "";
		//document.getElementById("other_object_data").style.display="none";
		//code to display tool tip starts





		if (this.mem_id == 389 || this.mem_id == 1725) {
			this._inputField.options[1].setAttribute("title", "With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.");
			this._inputField.options[2].setAttribute("title", "This selection will hide your contact information from your assigned Coach.");

		}
		else if (this.mem_id == 388) {
			this._inputField.options[1].setAttribute("title", "With this selection, you may choose to opt out of marketing emails Beachbody or Team Beachbody may send to you.  You will still receive account related communications.");
			this._inputField.options[2].setAttribute("title", "This selection will hide your contact information within the Coach Online Office from all Coaches, including your sponsor and personally sponsored Coaches.");


		}
		if (this.mem_id == 389 || this.mem_id == 388 || this.mem_id == 1725) {
			if (right_type_id == 1521) {
				document.getElementById("my_object_data").style.display = "block";

				var labelnew1 = document.getElementById("rn_" + this.instanceID + "_" + "Label");
				console.log(labelnew1);
				labelnew1.innerHTML = this.data.attrs.label_input + "<span class='rn_Required'> *</span>";
				this.data.attrs.required = true;

			} else {
				this.data.attrs.required = false;
				document.getElementById("my_object_data").style.display = "none";

			}

		} else {

			document.getElementById("my_object_data").style.display = "none";
		}

	},

	display_objection_data: function (type, args) {
		var objection_id = args[0].data.customer_objection_data;
		var membId = args[0].data.mem_id;
		//alert("right_type_id"+objection_id);
		//alert("memid"+membId);
		//alert("country ID"+this.country_id);
		if (objection_id == 1521 && (membId == 388 || membId == 389 || membId == 1725) && (this.country_id == 1 || this.country_id == 2)) {

			this._inputField.options.remove(3);
		} else {

			var otherField = this._inputField
			var optionCreate = document.createElement("option");
			optionCreate.text = "Other";
			optionCreate.value = 1526;
			this._inputField.options.remove(3);
			otherField.options.add(optionCreate, 3);

		}

	},
	display_right_data: function (type, args) {
		//	var right_id = args[0].data.rightType;
		//	var membId = args[0].data.mem_id;

		var state_choosen = document.getElementById("rn_SelectGDPR_10_Incident.CustomFields.c.gdpr_us_states").value;
		var country_choosen = document.getElementById("rn_SelectGDPR_9_Contact.Address.Country").value;
		//	alert(country_choosen);
		//	alert (state_choosen);
		//	alert("right_type_id"+right_id);
		//	alert("memid"+membId);
		//alert("country ID"+this.country_id);

		var otherField6 = this._inputField
		var optionCreate6 = document.createElement("option");
		optionCreate6.text = "Right to Know/Access  – Categories of Personal Information/Specific Pieces of Information";
		optionCreate6.value = 1505;
		this._inputField.options.remove(1);
		otherField6.options.add(optionCreate6, 1);

		var otherField4 = this._inputField
		var optionCreate4 = document.createElement("option");
		optionCreate4.text = "Data Portability Request/Copy of My Personal Information";
		optionCreate4.value = 1962;
		this._inputField.options.remove(2);
		otherField4.options.add(optionCreate4, 2);


		var otherField3 = this._inputField
		var optionCreate3 = document.createElement("option");
		optionCreate3.text = "Right of Correction";
		optionCreate3.value = 1507;
		this._inputField.options.remove(3);
		otherField3.options.add(optionCreate3, 3);

		var otherField5 = this._inputField
		var optionCreate5 = document.createElement("option");
		optionCreate5.text = "Right to Opt-Out of Sharing/Opt-Out of Targeted Advertising";
		optionCreate5.value = 1963;
		this._inputField.options.remove(5);
		otherField5.options.add(optionCreate5, 5);


		var otherField2 = this._inputField
		var optionCreate2 = document.createElement("option");
		optionCreate2.text = "Right of Objection/Restriction";
		optionCreate2.value = 1521;
		this._inputField.options.remove(6);
		otherField2.options.add(optionCreate2, 6);

		var otherField1 = this._inputField
		var optionCreate1 = document.createElement("option");
		optionCreate1.text = "Right of Deletion";
		optionCreate1.value = 1506;
		this._inputField.options.remove(7);
		otherField1.options.add(optionCreate1, 7);

		if (country_choosen == 1 && state_choosen == 1965) {
			//	alert("1");
			//$("#rn_SelectGDPR_18_Incident.CustomFields.c.dsrm_right_type option[value='1521']").remove(); 
			//$("#rn_SelectGDPR_18_Incident.CustomFields.c.dsrm_right_type option[value='1961']").remove(); 

			this._inputField.options.remove(6);
			this._inputField.options.remove(4);

		}

		else if (country_choosen == 1 && state_choosen == 1966) {
			//	alert("2");

			this._inputField.options.remove(5);
			this._inputField.options.remove(4);

		} else if (country_choosen == 1 && state_choosen == 1964) {
			//	alert("3");

			this._inputField.options.remove(6);

			var otherField = this._inputField
			var optionCreate = document.createElement("option");
			optionCreate.text = "Right to Opt-Out of Sale";
			optionCreate.value = 1961;
			this._inputField.options.remove(4);
			otherField.options.add(optionCreate, 4);

		} else if (country_choosen == 70) {
			//	alert("4");

			this._inputField.options.remove(5);
			this._inputField.options.remove(4);

		} else if (country_choosen == 2) {
			//	alert("4");

			this._inputField.options.remove(5);
			this._inputField.options.remove(4);
		} else {
			//	alert("5");
		}


	},
	right_type_changed: function () {
		var right_type_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;
		console.log(this.mem_id);

		//sriram code starts
		//console.log(this.mem_id);
		//	alert(right_type_id);

		if (right_type_id == 1963 || right_type_id == 1961) {
			document.getElementById("opt_out_info").style.display = "block";
		} else {
			document.getElementById("opt_out_info").style.display = "none";
		}

		if (this.mem_id == 388 || (this.mem_id == 1725 && right_type_id == 1506)) {

			if (right_type_id == 1506) {

				if (this.mem_id == 388) {
					document.getElementById("delete_object_data").style.display = "block";
					document.getElementById("delete_object_data_pc").style.display = "none";
					document.getElementById('customer_fields').style.display = "block";
				} else {
					document.getElementById("delete_object_data").style.display = "none";
					document.getElementById("delete_object_data_pc").style.display = "block";
				}
				document.getElementById("totalFields").style.display = "none";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";
				document.getElementById("disclaimer_box").style.display = "none";

			} else if (right_type_id == 1961 || right_type_id == 1962 || right_type_id == 1963) {

				if (this.mem_id == 388 || this.mem_id == 389 || this.mem_id == 1725) {
					document.getElementById("totalFields").style.display = "block";
					document.getElementById('customer_fields').style.display = "block";
				} else {
					document.getElementById("totalFields").style.display = "none";
					document.getElementById('customer_fields').style.display = "none";
				}

			} else if (right_type_id == 1505 || right_type_id == 1507 || right_type_id == 1521) {

				if (right_type_id == 1521) {
					//alert("test1");
					document.getElementById("my_object_data").style.display = "block";
					//added by sriram for preventing other on dsrm object data code starts

					var eventObj2 = new RightNow.Event.EventObject(this, { data: { customer_objection_data: right_type_id, mem_id: this.mem_id } });
					//alert("print");
					//console.log(eventObj2);
					RightNow.Event.fire("evt_objection_changed", eventObj2);
					//added by sriram for preventing other on dsrm object data code ends
				} else {
					document.getElementById("my_object_data").style.display = "none";
				}
				document.getElementById("delete_object_data").style.display = "none";
				document.getElementById("delete_object_data_pc").style.display = "none";
				document.getElementById("totalFields").style.display = "block";
				document.getElementById('coach_fields').style.display = "block";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";
				document.getElementById("disclaimer_box").style.display = "none";
				document.getElementById('customer_fields').style.display = "block";



			} else {
				document.getElementById("totalFields").style.display = "none";
				document.getElementById("disclaimer_box").style.display = "none";
				document.getElementById("delete_object_data").style.display = "none";
				document.getElementById("delete_object_data_pc").style.display = "none";
			}
		}
		else if (this.mem_id == 389 || this.mem_id == 1725) {
			document.getElementById("delete_object_data_pc").style.display = "none";
			//for customer delete
			if (right_type_id == 1507) {

				document.getElementById("update_object_data").style.display = "block";
			} else {
				document.getElementById("update_object_data").style.display = "none";
			}
			if (right_type_id == 1506) {
				document.getElementById("disclaimer_box").style.display = "block";
				var eventObj1 = new RightNow.Event.EventObject(this, { data: { customer_delete_data: "ok" } });
				RightNow.Event.fire("evt_customerdelete_changed", eventObj1);


			} else {
				document.getElementById("disclaimer_box").style.display = "none";

			}
			//test
			if (right_type_id == 1521) {
				//alert("test");
				document.getElementById("my_object_data").style.display = "block";
				//added by sriram for preventing other on dsrm object data code starts
				var eventObj2 = new RightNow.Event.EventObject(this, { data: { customer_objection_data: right_type_id, mem_id: this.mem_id } });
				console.log(eventObj2);
				RightNow.Event.fire("evt_objection_changed", eventObj2);
				//added by sriram for preventing other on dsrm object data code ends
			} else {
				document.getElementById("my_object_data").style.display = "none";
			}
			//added for customer/delete

			if (right_type_id != 1505 && right_type_id != 1507 && right_type_id != 1521 && right_type_id != 1506 && right_type_id != 1961 && right_type_id != 1962 && right_type_id != 1963) {

				document.getElementById("totalFields").style.display = "none";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";


			} else {

				document.getElementById("totalFields").style.display = "block";
				document.getElementById('customer_fields').style.display = "block";
				document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
				document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";

			}


		} else {
			document.getElementById("delete_object_data").style.display = "none";
			document.getElementById("delete_object_data_pc").style.display = "none";
			document.getElementById("totalFields").style.display = "none";
			document.getElementById("disclaimer_box").style.display = "none";

		}
		//sriram code ends

		var eventObj = new RightNow.Event.EventObject(this, { data: { rightType: right_type_id } });
		RightNow.Event.fire("evt_righttype_changed", eventObj);

	},
	member_type_changed: function () {
		document.getElementById("rn_ErrorLocation_gdpr").innerHTML = "";
		var mem_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		var country_choosen = document.getElementById("rn_SelectGDPR_9_Contact.Address.Country").value;
		var state_choosen = document.getElementById("rn_SelectGDPR_10_Incident.CustomFields.c.gdpr_us_states").value;

		document.getElementById("terms_conditions").checked = false;
		document.getElementById("terms_conditions1").checked = false;

		if ((mem_id == 389 || mem_id == 1725 || mem_id == 388) && country_choosen == 1 && state_choosen == 1964) {

			document.getElementById("disclaimer_checkbox").style.display = "block";
			if (document.getElementById("terms_conditions_auth").checked != "true") {
				document.getElementById("checkbox_comment").style.display = "none";
			}

		} else {
			document.getElementById("disclaimer_checkbox").style.display = "none";

		}
		if (document.getElementById('coach_fields')) {
			document.getElementById('coach_fields').style.display = "none";
		}
		if (document.getElementById('customer_fields')) {
			document.getElementById('customer_fields').style.display = "none";
		}
		if (mem_id == 388) {
			if (document.getElementById('coach_fields')) {
				document.getElementById('coach_fields').style.display = "block";
			}



			document.getElementById('right_type_data').style.display = "block";
			document.getElementById('totalFields').style.display = "none";
			document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
			document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";
			document.getElementById("disclaimer_box").style.display = "none";

		}
		else if (mem_id == 389 || mem_id == 1725) {
			/*if(document.getElementById('customer_fields'))
			{
				document.getElementById('customer_fields').style.display = "block";
			}	*/

			document.getElementById('right_type_data').style.display = "block";
			document.getElementById('totalFields').style.display = "none";
			document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
			document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";
		}
		else {
			document.getElementById('right_type_data').style.display = "none";
			document.getElementById('totalFields').style.display = "none";
			document.getElementById('rn_ErrorLocation_gdpr').innerHTML = "";
			document.getElementById("rn_ErrorLocation_gdpr").style.display = "none";

		}
		var eventObj = new RightNow.Event.EventObject(this, { data: { membertype: mem_id } });
		RightNow.Event.fire("evt_membertype_changed", eventObj);

	},

	state_type_changed: function () {
		var state_id = parseInt(this._inputField.options[this._inputField.selectedIndex].value);
		var country_choosen = document.getElementById("rn_SelectGDPR_9_Contact.Address.Country").value;
		document.getElementById("disclaimer_checkbox").style.display = "none";

		if (state_id == 1964 && country_choosen == 1) {
			//	document.getElementById("disclaimer_checkbox").style.display="block";
			document.getElementById("CountryFields").style.display = "block";

		} else if (country_choosen == 2 || country_choosen == 70) {
			//	document.getElementById("disclaimer_checkbox").style.display="none";
			document.getElementById("CountryFields").style.display = "block";

		} else if (state_id == 1965 || state_id == 1966) {
			document.getElementById("CountryFields").style.display = "block";
			document.getElementById("authFields").style.display = "none";
			document.getElementById("terms_conditions_auth").checked = false;

			//	document.getElementById("disclaimer_checkbox").style.display="none";

		} else {
			document.getElementById("CountryFields").style.display = "none";
			document.getElementById("disclaimer_checkbox").style.display = "none";

		}

		if (document.getElementById("terms_conditions_auth").checked == "false") {
			document.getElementById("checkbox_comment").style.display = "none";
		}

		var eventObj = new RightNow.Event.EventObject(this, { data: { statetype: state_id } });
		RightNow.Event.fire("evt_statetype_changed", eventObj);
		document.getElementById("rn_SelectGDPR_11_Incident.CustomFields.c.member_type_new").value = "";

	}

});