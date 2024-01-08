RightNow.namespace('Custom.Widgets.input.TextInputSSN_CCF');
Custom.Widgets.input.TextInputSSN_CCF = RightNow.Widgets.TextInput.extend({ 
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
        },   
		
		
		
		
		_initializeMask: function()
    {
     this.input.on("keyup", this._compareInputToMask, this);
       this.input.on("blur", this._hideMaskMessage, this);
       this.input.on("focus", this._compareInputToMask, this);
        this.data.js.mask = this._createMaskArray(this.data.js.mask);
        //Set up mask overlay
        var overlay = this.Y.Node.create("<div class='rn_MaskOverlay'>");
        if(this.Y.Overlay) {
            this._maskNode = new this.Y.Overlay({
                bodyContent: overlay,
                visible: false,
                align: {
                    node: this.input,
                    points: [this.Y.WidgetPositionAlign.TL, this.Y.WidgetPositionAlign.BL]
                }
            });
            this._maskNode.render(this.baseSelector);
        }
        else {
            this._maskNode = overlay.addClass("rn_Hidden");
            this.input.insert(this._maskNode, "after");
        }

        if(this.data.attrs.always_show_mask) {
            //Write mask onto the page
            var maskMessageOnPage = this._getSimpleMaskString(),
                widgetContainer = this.Y.one(this.baseSelector);
            if(maskMessageOnPage && widgetContainer) {
				if(this.data.attrs.language==="Spanish")// Expected Input Label for Spanish version of Coach Cancellation Form (Last four digits of SSN)
				{
                	var messageNode = this.Y.Node.create("<div class='rn_Mask'>" +"Entrada Esperada: " + maskMessageOnPage + "</div>");
				}
				else if(this.data.attrs.language==="French")// Expected Input Label for French version of Coach Cancellation Form (Last four digits of SSN)
				{
					var messageNode = this.Y.Node.create("<div class='rn_Mask'>" +"Entrée Prévue: " + maskMessageOnPage + "</div>");
				}
				else// Expected Input Label for Coach Cancellation Form (Last four digits of SSN)
				{
					var messageNode = this.Y.Node.create("<div class='rn_Mask'>" +"Expected Input: " + maskMessageOnPage + "</div>");
				}
                if (widgetContainer.get("lastChild").hasClass("rn_HintText")) {
                    messageNode.addClass("rn_MaskBuffer");
                }
                this._maskNodeOnPage = messageNode;
                widgetContainer.append(messageNode);
            }
        }
    },
	
	
	
	
	 _showMaskMessage: function(error) {
        if(error === null) {
            this._hideMaskMessage();
        }
        else {
			
			
			
			
			
            if(!this._showMaskMessage._maskMessages) {
                //set a static variable containing error messages so it's lazily defined once across widget instances
				
				
				if(this.data.attrs.language==="Spanish")// Messages that needs to be displayed if language is Spanish
				{
					this._showMaskMessage._maskMessages = {
						"F" : RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL'),
						"U#" : "Por favor, escriba un número",
						"L#" : "Por favor, escriba un número",
						"M#" : "Por favor, escriba un número",
						"UA" : RightNow.Interface.getMessage('PLEASE_ENTER_UPPERCASE_LETTER_MSG'),
						"UL" : RightNow.Interface.getMessage('PLEASE_ENTER_AN_UPPERCASE_LETTER_MSG'),
						"UC" : RightNow.Interface.getMessage('PLS_ENTER_UPPERCASE_LETTER_SPECIAL_MSG'),
						"LA" : RightNow.Interface.getMessage('PLEASE_ENTER_LOWERCASE_LETTER_MSG'),
						"LL" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LOWERCASE_LETTER_MSG'),
						"LC" : RightNow.Interface.getMessage('PLS_ENTER_LOWERCASE_LETTER_SPECIAL_MSG'),
						"MA" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_OR_A_NUMBER_MSG'),
						"ML" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_MSG'),
						"MC" : RightNow.Interface.getMessage('PLEASE_ENTER_LETTER_SPECIAL_CHAR_MSG'),
						"LEN" : "La entrada es demasiado larga",
						"MISS" : "La entrada es demasiado corta"
					};
				}
				else if(this.data.attrs.language==="French")// Messages that needs to be displayed if language is French
				{
						this._showMaskMessage._maskMessages = {
						"F" : RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL'),
						"U#" : "S'il vous plaît entrer un numéro",
						"L#" : "S'il vous plaît entrer un numéro",
						"M#" : "S'il vous plaît entrer un numéro",
						"UA" : RightNow.Interface.getMessage('PLEASE_ENTER_UPPERCASE_LETTER_MSG'),
						"UL" : RightNow.Interface.getMessage('PLEASE_ENTER_AN_UPPERCASE_LETTER_MSG'),
						"UC" : RightNow.Interface.getMessage('PLS_ENTER_UPPERCASE_LETTER_SPECIAL_MSG'),
						"LA" : RightNow.Interface.getMessage('PLEASE_ENTER_LOWERCASE_LETTER_MSG'),
						"LL" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LOWERCASE_LETTER_MSG'),
						"LC" : RightNow.Interface.getMessage('PLS_ENTER_LOWERCASE_LETTER_SPECIAL_MSG'),
						"MA" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_OR_A_NUMBER_MSG'),
						"ML" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_MSG'),
						"MC" : RightNow.Interface.getMessage('PLEASE_ENTER_LETTER_SPECIAL_CHAR_MSG'),
						"LEN" : "L'entrée est trop longue",
						"MISS" : "L'entrée est trop court"
					};
				}
				else // Messages that needs to be displayed if language is not specified (English)
				{
					this._showMaskMessage._maskMessages = {
						"F" : RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL'),
						"U#" : RightNow.Interface.getMessage('PLEASE_TYPE_A_NUMBER_MSG'),
						"L#" : RightNow.Interface.getMessage('PLEASE_TYPE_A_NUMBER_MSG'),
						"M#" : RightNow.Interface.getMessage('PLEASE_TYPE_A_NUMBER_MSG'),
						"UA" : RightNow.Interface.getMessage('PLEASE_ENTER_UPPERCASE_LETTER_MSG'),
						"UL" : RightNow.Interface.getMessage('PLEASE_ENTER_AN_UPPERCASE_LETTER_MSG'),
						"UC" : RightNow.Interface.getMessage('PLS_ENTER_UPPERCASE_LETTER_SPECIAL_MSG'),
						"LA" : RightNow.Interface.getMessage('PLEASE_ENTER_LOWERCASE_LETTER_MSG'),
						"LL" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LOWERCASE_LETTER_MSG'),
						"LC" : RightNow.Interface.getMessage('PLS_ENTER_LOWERCASE_LETTER_SPECIAL_MSG'),
						"MA" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_OR_A_NUMBER_MSG'),
						"ML" : RightNow.Interface.getMessage('PLEASE_ENTER_A_LETTER_MSG'),
						"MC" : RightNow.Interface.getMessage('PLEASE_ENTER_LETTER_SPECIAL_CHAR_MSG'),
						"LEN" : RightNow.Interface.getMessage('THE_INPUT_IS_TOO_LONG_MSG'),
						"MISS" : RightNow.Interface.getMessage('THE_INPUT_IS_TOO_SHORT_MSG')
					};
				}
				
				
				
				
            }
			
			
		
            var message = "",
                sampleMaskString = this._getSimpleMaskString().split("");
            for(var i = 0, type; i < error.length; i++) {
                type = error[i][1];
                //F means format char should have followed
                if(type.charAt(0) === "F") {
					if(this.data.attrs.language==="Spanish")//Label to be displayed when language is Spanish
					{
                    message += "<b>" + "Personaje" + " " + (error[i][0] + 1) + "</b> " + RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL') + type.charAt(1) + " ' <br>";
					}
					else if(this.data.attrs.language==="French")//Label to be displayed when language is French
					{
						message += "<b>" + "Personnage" + " " + (error[i][0] + 1) + "</b> " + RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL') + type.charAt(1) + " ' <br>";
					}
					else//Label to be displayed when language is not specified (English)
					{
						message += "<b>" + "Character" + " " + (error[i][0] + 1) + "</b> " + RightNow.Interface.getMessage('WAITING_FOR_CHARACTER_LBL') + type.charAt(1) + " ' <br>";
					}
                    sampleMaskString[(error[i][0])] = "<span style='color:#E80000;'>" + sampleMaskString[(error[i][0])] + "</span>";
                }
                else {
                    if(type !== "MISS") {
						if(this.data.attrs.language==="Spanish")//Label to be displayed when language is Spanish
					{
                        message += "<b>" + "Personaje" + " " + (error[i][0] + 1) + "</b> " + this._showMaskMessage._maskMessages[type] + "<br>";
					}
						else if(this.data.attrs.language==="French")//Label to be displayed when language is French
					{
					message += "<b>" + "Personnage" + " " + (error[i][0] + 1) + "</b> " + this._showMaskMessage._maskMessages[type] + "<br>";
					}
					else//Label to be displayed when language is not specified (English)
					{
						message += "<b>" + "Character" + " " + (error[i][0] + 1) + "</b> " + this._showMaskMessage._maskMessages[type] + "<br>";
					}
						
                        if(type !== "LEN") {
                            sampleMaskString[(error[i][0])] = "<span style='color:#E80000;'>" + sampleMaskString[(error[i][0])] + "</span>";
                        }
                        else {
                            break;
                        }
                    }
                }
            }
            sampleMaskString = sampleMaskString.join("");
			if(this.data.attrs.language==="Spanish")//Label to be displayed when language is Spanish
			{
           	    this._setMaskMessage("Entrada Esperada: " + sampleMaskString + "<br>" + message);
			}
			else if(this.data.attrs.language==="French")//Label to be displayed when language is French
			{
				this._setMaskMessage("Entrée Prévue: " + sampleMaskString + "<br>" + message);
			}
			else//Label to be displayed when language is not specified (English)
			{
				this._setMaskMessage("Expected Input: " + sampleMaskString + "<br>" + message);
			}
            this._showMask();
        }
    },
	 _displayError: function(errors, errorLocation) {
        var commonErrorDiv = this.Y.one("#" + errorLocation),
            verifyField;

        if(commonErrorDiv) {
            for(var i = 0, errorString = "", message, id = this.input.get("id"); i < errors.length; i++) {
				
                message = errors[i];
				if(message == "%s didn't match expected input")
				{
				//alert(message);
				if(this.data.attrs.language==="Spanish")//Error message to be displayed when Input doesn't match the expected input pattern (Language = Spanish)
				{
					message = "%s No se han encontrado aportación prevista";
				}
				else if(this.data.attrs.language==="French")//Error message to be displayed when Input doesn't match the expected input pattern (Language = French)
				{
					message = "%s Il n'y a pas d'entrée prévue";
				}
				else//Error message to be displayed when Input doesn't match the expected input pattern (Language is not specified)
				{
						message = "%s didn't match expected input";
				}
				}
                if (typeof message === "object" && message !== null && message.id && message.message) {
                    id = verifyField = message.id;
                    message = message.message;
                }
                else {
                    message = (message.indexOf("%s") > -1) ? RightNow.Text.sprintf(message, this.data.attrs.label_input) : this.data.attrs.label_input + " " + message;
                }
                errorString += "<div data-field=\"" + this._fieldName + "\"><b><a href='javascript:void(0);' onclick='document.getElementById(\"" + id +
                    "\").focus(); return false;'>" + message + "</a></b></div> ";
            }
            commonErrorDiv.append(errorString);
        }

        if (!verifyField || errors.length > 1) {
            this.toggleErrorIndicator(true);
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
    methodName: function() {

    }
});