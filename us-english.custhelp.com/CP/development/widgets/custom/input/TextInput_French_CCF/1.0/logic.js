RightNow.namespace('Custom.Widgets.input.TextInput_French_CCF');
Custom.Widgets.input.TextInput_French_CCF = RightNow.Widgets.TextInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.TextInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			
		//alert(this._fieldName);
        },
		
		
     /**
     * Event handler executed when form is being submitted
     *
     * @param type String Event name
     * @param args Object Event arguments
     */
		
		onValidate: function(type, args){
			
		if(this._fieldName === "Incident.CustomFields.c.coachcustomernumber")
		{
		
        var eventObject = this.createEventObject(),
            errors = [];

        this.toggleErrorIndicator(false);	
		}

		/*
		*Checks if the Document is signed and all the Terms and Conditions are agreed
		*If not, then the fucntion for displaying error is called
		*/
		
	
		
		

		
		//var emptyString_white="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACqAcIDAREAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/igAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKACgAoAKAP/9k=";
	
	//empty string generated in Internet Explorer when a new user session begins
		
	//var empty_string_ie = "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAAAAAAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCACqAcIDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD+/iiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigAooooAKKKKACiiigD/2Q==";
		
		
		
		
		
		/*if((document.getElementById("base64_encoded_string").value===''))
		{
		 //   alert("empty string");	
			this.flag_image=0;
		}
		else
		{
			//alert("not an empty string");	
			var canvas = document.getElementById('canvas');
			ctx = canvas.getContext('2d');
			ctx.fillStyle = '#FFFFFF';
			ctx.fillRect(0, 0, canvas.width, canvas.height);
		
			var c2 = document.getElementById("canvas");
			var ctx2 = c2.getContext("2d");
			var img = document.getElementById("SignatureImage");
			//console.log(img);
			ctx2.drawImage(img, 0, 0);
			
			
			
			var imageData = ctx2.getImageData(0, 0, canvas.width, canvas.height);
			var flag_img=0;
			this.flag_image=flag_img;
			// examine every pixel, 
			// change any old rgb to the new-rgb
			for (var i=0;i<imageData.data.length;i+=1)
			{//254,253,160
			// is this pixel the old rgb?
			if(imageData.data[i]==0){
				flag_img++;
				this.flag_image=flag_img;
				break;
			}
			}
			// put the altered data back on the canvas  
			ctx2.putImageData(imageData,0,0);
		
		}*/
		
		
	
	
		
		
		var term1 = document.getElementById("term1").checked;
		
		var term2 = document.getElementById("term2").checked;
		var term3 = document.getElementById("term3").checked;	
		var term4 = document.getElementById("term4").checked;
		var term5 = document.getElementById("term5").checked;
		var term6 = document.getElementById("term6").checked;
		if(term1 == true && term2 == true && term3 == true && term4 == true && term5 == true && term6==true)
		{
			var flag = 1;
			
		}
		else
		{
			var flag = 0;
			
		}
		var SignatureTextValue = document.getElementById("html-content-holder").value;

		if((document.getElementById("html-content-holder").value==='')|| (SignatureTextValue.substring(0,3)!=="/s/") ||(SignatureTextValue.length <= 3))
		{
			this.toggleErrorIndicatorSignature(true);
			
		}else{
		
			this.toggleErrorIndicatorSignature(false);

		}
		if(flag == 0)
		{
			
		this.toggleErrorIndicatorTermsOfCancellation(false);	
		}
		
		
			

        if(!this.validate(errors) || (this.data.attrs.require_validation && !this._validateVerifyField(errors)) || !this._compareInputToMask(true)) {
            this.lastErrorLocation = args[0].data.error_location;
		
		var SignatureTextValue = document.getElementById("html-content-holder").value;
		
		if((document.getElementById("html-content-holder").value==='') || (SignatureTextValue.substring(0,3)!=="/s/") ||(SignatureTextValue.length <= 3))
		{
			this._displayErrorSignature(errors, this.lastErrorLocation);
			
		}
		
		if(flag == 0)
		{
		
			this._displayErrorTermsOfCancellation(errors, this.lastErrorLocation);
	
		}
		
            this._displayError(errors, this.lastErrorLocation);
			
            RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
            return false;
        }
	var SignatureTextValue = document.getElementById("html-content-holder").value;


if((document.getElementById("html-content-holder").value==='') || (SignatureTextValue.substring(0,3)!=="/s/") ||(SignatureTextValue.length <= 3))
		{
		 this.lastErrorLocation = args[0].data.error_location;
		 errors.length = 1;
		 this._displayErrorSignature(errors, this.lastErrorLocation);
		if(flag == 0)
		{
			
		this._displayErrorTermsOfCancellation(errors, this.lastErrorLocation);	
		}
			
         RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
         return false;
			
		}
		else if(flag == 0)
		{
		 this.lastErrorLocation = args[0].data.error_location;
		 errors.length = 1;
		 this._displayErrorTermsOfCancellation(errors, this.lastErrorLocation);
		
		
		
		
			
            RightNow.Event.fire("evt_formFieldValidateFailure", eventObject);
            return false;	
		}
		
		else
		{
			
			 document.getElementById("signtext").className = "bySigning";
        RightNow.Event.fire("evt_formFieldValidatePass", eventObject);
        return eventObject;
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
	
	/*
	*Displays error if the Document is not signed
	*/
	
	_displayErrorSignature: function(errors, errorLocation) {
		
		/*var canvas = document.getElementById('canvas');
		ctx = canvas.getContext('2d');
		ctx.fillStyle = '#FEFDA0';
    	ctx.fillRect(0, 0, canvas.width, canvas.height);*/
		
        var commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;

        if(commonErrorDiv) {
            for(var i = 0, errorString = "", message, id = "html-content-holder"; i <errors.length; i++) {
                message = errors[i];
				
				//var message = "S'il vous plaît signer le document";
				var message = "S'il vous plaÃ®t signer le document";
				var message = decodeURIComponent(message);

              
                errorString += "<div data-field=\"" + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
            }
            commonErrorDiv.append(errorString);
        }

        if (!verifyField || errors.length > 1) {
            this.toggleErrorIndicatorSignature(true);
        }
    },
	
	
	/**
     * Adds / removes the error indicators of Signature
     * @param {Boolean} showOrHide T to add, F to remove
     */
	
	toggleErrorIndicatorSignature: function(showOrHide, fieldToHighlight, labelToHighlight) {
		
        var method = ((showOrHide) ? "addClass" : "removeClass");
		
        if (fieldToHighlight && labelToHighlight) {
			
            fieldToHighlight[method]("rn_ErrorField");
            labelToHighlight[method]("rn_ErrorLabel");
        }
        else {
			
			YUI().use('node', function(Y) {
									
										 Y.one('#html-content-holder')[method]("rn_ErrorField");
										});
			YUI().use('node', function(Y) {
									
		Y.one('#signature')[method]("rn_ErrorLabel");
									});
        }
    },
	
	
	/**
     * Adds / removes the error indicators of Terms of Cancellation
     * @param {Boolean} showOrHide T to add, F to remove
     */
	
	toggleErrorIndicatorTermsOfCancellation: function(showOrHide, fieldToHighlight, labelToHighlight) {
		
        var method = ((showOrHide) ? "addClass" : "removeClass");
		
        if (fieldToHighlight && labelToHighlight) {
			
            fieldToHighlight[method]("rn_ErrorField");
            labelToHighlight[method]("rn_ErrorLabel");
        }
        else {
		
			YUI().use('node', function(Y) {
									
										 Y.one('#terms_of_cancellation')[method]("rn_ErrorField");
										});
			
			YUI().use('node', function(Y) {
									
		Y.one('#terms_of_cancellation')[method]("rn_ErrorLabel");
									});
        }
    },
	
	/*
	*Displays error message if Terms of Cacellation is not agreed
	*/
	
		_displayErrorTermsOfCancellation: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;

        if(commonErrorDiv) {
            for(var i = 0, errorString = "", message, id = "terms_of_cancellation"; i < errors.length; i++) {
                message = errors[i];
				
				//var message = "Afin de soumettre le formulaire s'il vous plaît vérifier toutes les conditions d' annulation";
				var message = "Afin de soumettre le formulaire s'il vous plaÃ®t vÃ©rifier toutes les conditions d' annulation";
              	var message = decodeURIComponent(message);

              
                errorString += "<div data-field=\"" + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
            }
            commonErrorDiv.append(errorString);
        }

        if (!verifyField || errors.length > 1) {
            this.toggleErrorIndicatorTermsOfCancellation(true);
        }
    },

    /**
     * Sample widget method.
     */
	 
	
    methodName: function() {

    }
});