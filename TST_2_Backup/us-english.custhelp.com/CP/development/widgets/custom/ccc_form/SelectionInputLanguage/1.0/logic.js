RightNow.namespace('Custom.Widgets.ccc_form.SelectionInputLanguage');
Custom.Widgets.ccc_form.SelectionInputLanguage = RightNow.Widgets.SelectionInput.extend({ 
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
	this.lanname=data.js.name;
	this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
	window.membertypeid = 0;
	
	if(fieldName == "Incident.CustomFields.c.member_type_eng") //Member Type English oe French or Spanish
	{
		
	    //this.data.attrs.required=false;
		this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
		this.input.on("change", this.memberType_Changed, this); 
	
	}
	
        }
     
    }, 
	memberType_Changed: function() {
		
	
	this._inputField = document.getElementById("rn_" + this.instanceID + "_" + this.data.js.name);
	
		this.Value = this._inputField.options[this._inputField.selectedIndex].text;
		 //**Code for getting id of the selected text of dropdown**//
  		var length = this.input._node.length;
		//alert("enter memb change");
		
		//document.getElementById("rn_ErrorLocation").innerHTML="";//reset error location--could not find this id in main page commented by vimal
		document.getElementById("rn_ErrorLocation_ccc").innerHTML="";//reset error location
		
		
		//this.Y.one("#rn_ErrorLocation").addClass("rn_Hidden");//.set("innerHTML", "");--could not find this id in main page by vimal
		this.Y.one("#rn_ErrorLocation_ccc").addClass("rn_Hidden");//.set("innerHTML", "");


 		for(var i=0;i<length;i++)
 		{
  			var text=this.input._node[i].label;
  				if(this.Value == text)
  				{
 					 var id = this.input._node[i].value; 
   
  				}
		 }
		 
				membertypeid = id;
		 		var eo = new RightNow.Event.EventObject(this, {data:  id});
		   		RightNow.Event.fire("evt_memberType_Changed", eo);
 				
				if(id == 771){ // YES
					//var displayNone = [];
					var displayBlock =["yes_no_main_div","eng_last_head"];
					//this._displayNone(displayNone);
					this._displayBlock(displayBlock);	
				}else if(id == 770){
					var displayNone = ["yes_no_main_div"];
					var displayBlock =["eng_last_head"];
					this._displayNone(displayNone);
					this._displayBlock(displayBlock);
				}else{
					var displayNone = ["yes_no_main_div","eng_last_head"];
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
			
	}
	        
});