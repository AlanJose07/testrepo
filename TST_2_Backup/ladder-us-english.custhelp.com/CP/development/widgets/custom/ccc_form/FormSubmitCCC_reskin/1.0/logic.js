RightNow.namespace('Custom.Widgets.ccc_form.FormSubmitCCC_reskin');
Custom.Widgets.ccc_form.FormSubmitCCC_reskin = RightNow.Widgets.FormSubmit.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FormSubmit#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			RightNow.Event.subscribe("on_before_ajax_request", this._beforeAjaxRequest, this);
			RightNow.Event.subscribe("evt_languagechanged", this._set_language_attribute, this);
			RightNow.Event.subscribe("submit_eng", this._set_language_attribute, this);
			
        },
			/**
     * Handles when user clicks the submit button.
     * @param {Object=} evt Click event or null if called programmatically
     */
    _onButtonClick: function(evt) {
		//alert(1);
        if (evt && evt.halt) {
            evt.halt();
        }
        if (this._requestInProgress) return false;

        this._toggleClickListener(false);
        //Reset form errors
        this._errorMessageDiv.addClass("rn_Hidden").set("innerHTML", "");

        //since the form is submitted by script, deliberately tell IE to do auto completion of the form data
        if (this.Y.UA.ie && window.external && "AutoCompleteSaveForm" in window.external) {
            window.external.AutoCompleteSaveForm(document.getElementById(this._parentForm));
        }
	//	alert(2);
        this._fireSubmitRequest();
		if(document.getElementById("rn_ErrorLocation_ccc").innerHTML=="")
		{
			//alert("nui");
			this._errorMessageDiv.addClass("rn_Hidden");	
		}
		//alert(3);
    }

        /**
         * Overridable methods from FormSubmit:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onButtonClick: function(evt)
        // _fireSubmitRequest: function()
        // _onFormValidated: function()
        // _onFormValidationFail: function()
        // _formSubmitResponse: function(type, args)
        // _onFormUpdated: function()
        // _onErrorResponse: function()
        // _displayErrorDialog: function(message)
        // _onFormTokenUpdate: function(type, args)
        // _enableFormExpirationWatch: function()
        // _toggleLoadingIndicators: function(turnOn)
        // _toggleClickListener: function(enable)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	_set_language_attribute:function(type,args)
	{
		var lang_id = args[0].data;
		
		var url =this.data.attrs.on_success_url;
		//console.log(url);
		var res = url.split("/");
		var flag=0;
		var lang_identifier=null;
		//console.log(res);
		for(var i=0;i<res.length;i++)
		{
			if(res[i]=="lang")
			{	
			
				if(lang_id==752)
				{
					
					/*res[i+1]="2";*/
					flag=1;
					lang_identifier="2";
					//break;
				}
				else if(lang_id==753)
				{
					//alert("spa");
					/*res[i+1]="3";*/
					flag=1;
					lang_identifier="3";
					//break;
				}
				else 
				{
					//alert("eng");
					/*res[i+1]="1";*/
					flag=1;
					lang_identifier="1";
					//break;
					
				}
				
			}
			/*else
			{
				
				flag=0;	
			}*/
		}
		var new_url="";
		if(flag==1)
		{
			/*for(var i=0;i<res.length;i++)
			{
				if(res[i]!="")
				{
					new_url+="/"+res[i];
				}
			}*/
			var lang_pos = url.indexOf("lang");
            new_url = url.substring(0, lang_pos);
			new_url+="lang/"+lang_identifier;
			
			this.data.attrs.on_success_url=new_url;
		}
		else
		{
			   
				if(lang_id==752)//French
				{
					this.data.attrs.on_success_url=this.data.attrs.on_success_url + "/lang/2";
				}
				else if(lang_id==753)//Spanish
				{
					this.data.attrs.on_success_url=this.data.attrs.on_success_url + "/lang/3";
				}
				else //English
				{
					this.data.attrs.on_success_url=this.data.attrs.on_success_url + "/lang/1";
				}
		}
		//alert(this.data.attrs.on_success_url);
		
	},
		
    /**
     * Renders the `view.ejs` JavaScript template.
     */
    renderView: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },
	
	_beforeAjaxRequest: function (type, args) {
		
        var requestOptions = args[0];
		
		if (/ci\/ajaxRequest\/sendForm/.test(requestOptions.url)) { 
				requestOptions.url = "/cc/AjaxOrder/sendorderform_customer_coach";
        }
		
    }
	
});