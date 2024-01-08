RightNow.namespace('Custom.Widgets.customercoachchange.SelectionInputLanguage');
Custom.Widgets.customercoachchange.SelectionInputLanguage = RightNow.Widgets.SelectionInput.extend({ 
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
	var fieldName = data.js.name;
	this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
	window.life=0;
	if(fieldName == "Incident.CustomFields.c.ccc_language") //Language Dropdown
	{
		this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
		this.input.on("change", this.language_Changed, this);
		//RightNow.Event.subscribe("evt_clear_on_back_button", this.clearOnBackButton, this);
	}
	
	if(fieldName == "Incident.CustomFields.c.member_type"||fieldName == "Incident.CustomFields.c.member_type_fre"||fieldName == "Incident.CustomFields.c.member_type_spa") //Member Type English oe French or Spanish
	{
		
		this.data.attrs.required=false;
		this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
		this.input.on("change", this.memberType_Changed, this);
		RightNow.Event.subscribe("evt_languagechanged", this._set_required_attribute, this);
	
	}
	
	if(fieldName == "Incident.CustomFields.c.ccc_transfer_vc_eng"||fieldName == "Incident.CustomFields.c.ccc_transfer_vc_fre"||fieldName == "Incident.CustomFields.c.ccc_transfer_vc_spa"||fieldName == "Incident.CustomFields.c.ccc_transfer_vc_cust_eng"||fieldName == "Incident.CustomFields.c.ccc_transfer_vc_cust_fre"||fieldName == "Incident.CustomFields.c.ccc_transfer_vc_cust_spa") //Transfer Volume and Commission English or French or Spanish
	{	//alert("vc_engggggggggggggggg");
		this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name); 
		this.input.on("change", this.vc_Changed, this);
		RightNow.Event.subscribe("evt_languagechanged", this._resetAttrs, this);
		//alert("evt_languagechange");
		RightNow.Event.subscribe("evt_memberType_Changed",this._resetAttrs, this);
		//alert("evt_memberType_Changedthis._resetAttrs");
		RightNow.Event.subscribe("evt_memberType_Changed",this._tvcRequired, this);
		//alert("evt_memberType_Changedthis._tvcRequired");
		
		
	}
	
        }
     
    },

     language_Changed: function() 
	{
		this.Value = this._inputField.options[this._inputField.selectedIndex].text;
		 //**Code for getting id of the selected text of dropdown**//
  		var length = this.input._node.length;
		//alert("enter lang change");
		document.getElementById("rn_ErrorLocation").innerHTML="";//reset error location
		document.getElementById("email_alert").innerHTML="";
        this.Y.one("#rn_ErrorLocation").addClass("rn_Hidden");//.set("innerHTML", "");
		//alert("reset er");
		  //Reset form errors
 		for(var i=0;i<length;i++)
 		{
  			var text=this.input._node[i].label;
  				if(this.Value == text)
  				{
 					 var id = this.input._node[i].value; 
  				}
		 }
 			var eo = new RightNow.Event.EventObject(this, {data:  id});
		    RightNow.Event.fire("evt_languagechanged", eo);
			if(id==744)//language equals english
				{
					var displayNone = ["Language_Header_French","Language_Header_Spanish","coach_or_customer_french",										"coach_or_customer_spanish","Coach_Header_French","Coach_Header_Spanish","ssn","full_name","coach_customer_id","email","telephone","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","tvc_eng","tvc_fre","tvc_spa","transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_eng","tvc_cust_fre","tvc_cust_spa","your_order_no","cust_eng_last_head","cust_fre_last_head","cust_spa_last_head","order_details","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa"];
					var displayBlock =["Language_Header_English", "coach_or_customer_english","main_heading_english",];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					
				}
			else if(id==745)//language equals french
				{
					var displayNone = ["main_heading_english","Language_Header_English","coach_or_customer_english","coach_or_customer_spanish","Coach_Header_English","Coach_Header_Spanish","Language_Header_Spanish","ssn","full_name","coach_customer_id","email","telephone","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_eng","tvc_cust_fre","tvc_cust_spa","your_order_no","cust_eng_last_head","cust_fre_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa"];
					var displayBlock =["Language_Header_French","coach_or_customer_french"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
				}
			else if(id==746)//language equals spanish
				{
					var displayNone = ["main_heading_english","Language_Header_English","coach_or_customer_english","coach_or_customer_spanish","Language_Header_French","coach_or_customer_french","Coach_Header_English","Coach_Header_French","full_name","coach_customer_id","email","telephone","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_eng","tvc_cust_fre","tvc_cust_spa","your_order_no","cust_eng_last_head","cust_fre_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa","ssn"];
					var displayBlock =["Language_Header_Spanish","coach_or_customer_spanish"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
				}	
			else
				{
					
					var displayNone = ["Language_Header_Spanish","Language_Header_English","coach_or_customer_english","coach_or_customer_spanish","Language_Header_French","coach_or_customer_french","Coach_Header_English","Coach_Header_Spanish","Coach_Header_French","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","ssn","full_name","coach_customer_id","email","telephone","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","zip","cust_coach_info","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","tvc_cust_eng","tvc_cust_fre","tvc_cust_spa","your_order_no","cust_eng_last_head","cust_fre_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa"];
					var displayBlock =["main_heading_english"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
				}
    },
	memberType_Changed: function() {
		this.Value = this._inputField.options[this._inputField.selectedIndex].text;
		 //**Code for getting id of the selected text of dropdown**//
  		var length = this.input._node.length;
		//alert("enter memb change");
		document.getElementById("rn_ErrorLocation").innerHTML="";//reset error location
		this.Y.one("#rn_ErrorLocation").addClass("rn_Hidden");//.set("innerHTML", "");
		
		//alert("reset esssssr");
		console.log("rn_" + this.data.info.name );//+ "_" + this.data.js.name);

 		for(var i=0;i<length;i++)
 		{
  			var text=this.input._node[i].label;
  				if(this.Value == text)
  				{
 					 var id = this.input._node[i].value; 
   
  				}
		 }
		 		var eo = new RightNow.Event.EventObject(this, {data:  id});
		   		RightNow.Event.fire("evt_memberType_Changed", eo);
 			
			if(id==50)//Member Type = Coach English
				{	var displayNone = ["Coach_Header_English","coach_spa_sub_head1","coach_fre_sub_head1","coach_fre_sub_head2","coach_spa_sub_head2","coach_fre_sub_head3","coach_spa_sub_head3","tvc_fre","tvc_spa","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_fre","tvc_cust_spa","cust_fre_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa","tvc_cust_eng"];
					var displayBlock =["Coach_Header_English","full_name","coach_customer_id","email","ssn","telephone","coach_eng_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","customer_details","coach_eng_sub_head3","order_details","tvc_eng","your_order_no","cust_eng_last_head"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="coach_english";
	
				}
			else if(id==49)//Member Type = Customer English
				{
					var displayNone = ["Coach_Header_English","telephone","coach_eng_sub_head1","coach_spa_sub_head1","coach_fre_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","ssn","cust_fre_sub_head1","cust_spa_sub_head1","tvc_cust_fre","tvc_cust_spa","your_order_no","cust_fre_last_head","cust_spa_last_head","email_add_coach_fre","email_add_coach_spa","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes"];
					var displayBlock =["full_name","coach_customer_id","email","zip","cust_eng_sub_head1","cust_coach_info","tvc_cust_eng","cust_eng_last_head","email_add_coach_eng"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="customer_english";
				
				}	
			else if(id==755)//Member Type = Coach French
				{
					var displayNone = ["Coach_Header_English","ssn","coach_eng_sub_head1","coach_spa_sub_head1","coach_eng_sub_head2","coach_spa_sub_head2","coach_eng_sub_head3","coach_spa_sub_head3","tvc_eng","tvc_spa","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_fre","tvc_cust_spa","cust_eng_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes","tvc_cust_eng"];
					var displayBlock =["full_name","coach_customer_id","email","telephone","coach_fre_sub_head1","cust_fullname","cust_id","coach_fre_sub_head2","customer_details","coach_fre_sub_head3","order_details","tvc_fre","your_order_no","cust_fre_last_head"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="coach_french";
				
				}	
				
			else if(id==756)//Member Type = Customer French
				{
					var displayNone = ["Coach_Header_English","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","customer_details","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","ssn","cust_eng_sub_head1","cust_spa_sub_head1","tvc_cust_spa","your_order_no","cust_eng_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_spa","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes","tvc_cust_eng"];
					var displayBlock =["full_name","coach_customer_id","email","telephone","zip","cust_fre_sub_head1","cust_coach_info","tvc_cust_fre","cust_fre_last_head","email_add_coach_fre"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="customer_french";
				
				}	
			else if(id==757)//Member Type = Coach Spanish
				{
					var displayNone = ["Coach_Header_English","coach_eng_sub_head1","coach_fre_sub_head1","coach_eng_sub_head2","coach_fre_sub_head2","coach_eng_sub_head3","coach_fre_sub_head3","tvc_eng","tvc_fre","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_fre","tvc_cust_spa","cust_eng_last_head","cust_fre_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes","tvc_cust_eng"];
					var displayBlock =["full_name","coach_customer_id","email","ssn","telephone","coach_spa_sub_head1","cust_fullname","cust_id","coach_spa_sub_head2","customer_details","coach_spa_sub_head3","order_details","tvc_spa","your_order_no","cust_spa_last_head"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="coach_spanish";
				
				}	
			else if(id==758)//Member Type = Customer Spanish
				{
					var displayNone = ["Coach_Header_English","customer_english","ssn","telephone","coach_spa_sub_head1","coach_eng_sub_head1","coach_fre_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","ssn","cust_eng_sub_head1","cust_fre_sub_head1","tvc_cust_fre","customer_details","your_order_no","cust_eng_last_head","cust_fre_last_head","zip","email_add_coach_eng","email_add_coach_fre","transfer_vc_coach_eng_yes","tvc_cust_eng"];
					var displayBlock =["full_name","coach_customer_id","email","cust_spa_sub_head1","cust_coach_info","tvc_cust_spa","cust_spa_last_head","email_add_coach_spa"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
					window.member="customer_spanish";
				
				}	
				
				
				
				else
				{
					var displayNone = ["full_name","coach_customer_id","email","ssn","telephone","coach_eng_sub_head1","coach_fre_sub_head1","coach_spa_sub_head1","cust_fullname","cust_id","coach_eng_sub_head2","coach_fre_sub_head2","coach_spa_sub_head2","coach_eng_sub_head3","coach_fre_sub_head3","coach_spa_sub_head3","order_details","tvc_eng","tvc_fre","tvc_spa","zip","cust_eng_sub_head1","cust_fre_sub_head1","cust_spa_sub_head1","cust_coach_info","tvc_cust_eng","tvc_cust_fre","tvc_cust_spa","customer_details","your_order_no","cust_eng_last_head","cust_fre_last_head","cust_spa_last_head","email_add_coach_eng","email_add_coach_fre","email_add_coach_spa","transfer_vc_coach_eng_yes"];
					this._displayNone(displayNone);
					//alert("noneee");
					window.member="null";
					
				}
								
    },
	vc_Changed: function() {//Transfer Volume and Commission of customer order
		this.Value = this._inputField.options[this._inputField.selectedIndex].text;
		 //**Code for getting id of the selected text of dropdown**//
  		var length = this.input._node.length;

 		for(var i=0;i<length;i++)
 		{
  			var text=this.input._node[i].label;
  				if(this.Value == text)
  				{
 					 var id = this.input._node[i].value; 
   
  				}
		 }
 			/*var eo = new RightNow.Event.EventObject(this, {data:  id});
		    RightNow.Event.fire("evt_vc_Changed", eo);*/
			if(id==749)//VC Eng Yes
				{//alert("Eng Yes ");
					//alert("coach_english");
						var displayBlock =["transfer_vc_coach_eng_yes"];
						var displayNone = ["transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
				
				}
					else if(window.member==="customer_english")
					{//alert("customer_english");
						var displayBlock =["transfer_vc_customer_eng_yes","your_order_no"];
						var displayNone = ["transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_coach_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
					}
					else 
					{
						alert("null");
					}
									
				}
			else if(id==750)//VC  Eng No
				{
					var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
					this._displayNone(displayNone);
				}
			else if(id==751)//VC Fre Yes
				{	
					if(window.member==="coach_french")//
					{
						var displayBlock =["transfer_vc_coach_fre_yes"];
						var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
					}
			
					else if(window.member==="customer_french")
					{
						var displayBlock =["transfer_vc_customer_fre_yes","your_order_no"];
						var displayNone = ["transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_spa_yes"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
					}
				}
			else if(id==752)//VC Fre No
				{
					var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
					this._displayNone(displayNone);
				}
			else if(id==753)//VC Spa Yes
				{	
					if(window.member==="coach_spanish")//
					{
						var displayBlock =["transfer_vc_coach_spa_yes"];
						var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
					}
			
					else if(window.member==="customer_spanish")
					{
						var displayBlock =["transfer_vc_customer_spa_yes","your_order_no"];
						var displayNone = ["transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_coach_eng_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes"];
						this._displayNone(displayNone);
						this._displayBlock(displayBlock);
					}
				}
			else if(id==754)//VC Spa No
				{
					var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
					this._displayNone(displayNone);
				}
							
			else 
				{
					var displayNone = ["transfer_vc_coach_eng_yes","transfer_vc_coach_fre_yes","transfer_vc_coach_spa_yes","transfer_vc_customer_eng_yes","transfer_vc_customer_fre_yes","transfer_vc_customer_spa_yes","your_order_no"];
					this._displayNone(displayNone);
				}
				
				
				
				
    },
	_displayNone: function(displayNone)
	{
		/*console.log(displayNone);*/
		for (var i=0;i<displayNone.length;i++)
		{
			if(document.getElementById(displayNone[i]))
			{	
				document.getElementById(displayNone[i]).style.display = "none";
			}
		}	
	},
	_set_required_attribute: function(type, args)
	{
		var lang_id = args[0].data;
		var req_eng="is required";
		var req_fre="est requis";
		var req_spa="es requerido";
		if(this.data.js.name == "Incident.CustomFields.c.member_type")
		{
		
			if(lang_id == 744)//English
			{
				this._makeRequired("Are you a Customer or a Coach?",true,req_eng);
				
			}
			else
			{
				this.input.set('value','');
				this.data.attrs.required=false;
			}
		}
		else if(this.data.js.name == "Incident.CustomFields.c.member_type_fre")
		{
			if(lang_id == 745)//French
			{	
				this._makeRequired("Êtes-vous un client ou un coach?",true,req_fre);
			}
			else
			{
				this.input.set('value','');
				this.data.attrs.required=false;
			}	
		}
		else if(this.data.js.name == "Incident.CustomFields.c.member_type_spa")
		{
			if(lang_id == 746)//Spanish
			{
				this._makeRequired("¿Eres un cliente o un coach?",true,req_spa);
				
			}
			else
			{
				this.input.set('value','');
				this.data.attrs.required=false;
			}	
		}
	
	},
	_displayBlock: function(displayBlock)
	{
		/*console.log(displayBlock);*/
		for (var i=0;i<displayBlock.length;i++)
		{
			if(document.getElementById(displayBlock[i]))
			{
				document.getElementById(displayBlock[i]).style.display = "block";
			}
		}
	},
	_makeRequired: function(label,required,labelrequired)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label+"<span class='rn_Required'> *</span>";
			this.data.attrs.label_input=label;
			this.data.attrs.required=required;
			this.data.attrs.label_required=labelrequired;
	},
	_makeFalse: function(label,required)
	{
			var labelnew = document.getElementById("rn_" + this.instanceID + "_" + "Label");
			labelnew.innerHTML= label;
			this.data.attrs.required=required;
	},
	_resetAttrs: function()
	{		
			this.input.set('value','');
			this.data.attrs.required=false;
			document.getElementById("transfer_vc_coach_eng_yes").style.display = "none";
			
	},
	_tvcRequired: function(type,args)
		{	
		
			var mem_id = args[0].data;
			var req_eng="is required";
			var req_fre="est requis";
			var req_spa="es requerido";	
			
				if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_eng")
				{	//alert("vc eng123");
					
					if(mem_id==50)//Member Type = Coach English
					{	//alert("Customer English");
						this._makeFalse("Transfer Volume and Commission of the customer order",false);
					}
					else
					{
						this._resetAttrs();
						
					}	
				}
				
				else if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_fre")
				{
					
					 if(mem_id==755)//Member Type = Coach French
					{	
						this._makeFalse("Transférez le volume et la commission de la commande du client",false);
					}
					else
					{
						this._resetAttrs();
						
					}	
				}
				 else if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_spa")
				{
					
					 if(mem_id==757)//Member Type = Coach Spanish
					{	
						this._makeFalse("Transferir el volumen y la comisión del pedido del cliente",false);
					}
					
					else
					{
						this._resetAttrs();
						
					}	
				}
				else if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_cust_eng")
				{	//alert("vc eng123");
					if(mem_id==49)//Member Type = Customer English
					{	//alert("Customer English");
						this._makeRequired("Would you like to transfer the credit of your recent order to your new Coach?",true,req_eng);
					}
					
					else
					{
						this._resetAttrs();
						
					}	
				}
				else if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_cust_fre")
				{
					if(mem_id==756)//Member Type = Customer French
					{	
						this._makeRequired("Voudriez-vous transférer le crédit de votre commande récente à votre nouveau coach?",true,req_fre);
					}
					
					else
					{
						this._resetAttrs();
						
					}	
				}
				 else if(this.data.js.name == "Incident.CustomFields.c.ccc_transfer_vc_cust_spa")
				{
					if(mem_id==758)//Member Type = Customer Spanish
					{	
						this._makeRequired("Transferir el volumen y la comisión del pedido del cliente",true,req_spa);
					
					}
					
					else
					{
						this._resetAttrs();
						
					}	
				}
			}
});