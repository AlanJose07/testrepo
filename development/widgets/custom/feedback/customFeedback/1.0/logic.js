RightNow.namespace('Custom.Widgets.feedback.customFeedback');
Custom.Widgets.feedback.customFeedback = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
	this._dialog = this._keyListener = this._thanksLabel = null;
	var Event = this.Y.Event;
	var noButton = this.Y.one(this.baseSelector + "_RatingNoButton");
	Event.attach("click", this._onClick, noButton, this, 1);
	RightNow.Event.subscribe("evt_reportResults", this._setvisiblity, this);
	
	
    },

    /**
     * Sample widget method.
     */
	_geturlParam: function(key){
		var url=String(window.location);   
		var exploded_url= url.split("/");
		var index=exploded_url.indexOf(key);
		return this.top_parent = exploded_url[index+1].split('/');
	},		
    _onClick: function(event, rating) {
	//alert(this._geturlParam('kw'));
       this._showDialog();
    },
	_showDialog: function() {
        // get a new f_tok value each time the dialog is opened
        RightNow.Event.fire("evt_formTokenRequest",
            new RightNow.Event.EventObject(this, {data:{formToken:this.data.js.f_tok}}));

        // If the dialog doesn't exist, create it.  (Happens on first click).
        if (!this._dialog) {
            this.Y.augment(this, RightNow.RequiredLabel);
            var buttons = [ { text: this.data.attrs.label_send_button, handler: {fn: this._onSubmit, scope: this}, isDefault: true},
                            { text: this.data.attrs.label_cancel_button, handler: {fn: this._onCancel, scope: this}, isDefault: false}],
                templateData = {domPrefix: this.baseDomID,
                    labelDialogDescription: this.data.attrs.label_dialog_description,
                    labelEmailAddress: this.data.attrs.label_email_address,
                    labelCommentBox: this.data.attrs.label_comment_box,
                    isProfile: this.data.js.isProfile,
                    userEmail: this.data.js.email
                },
                dialogForm = this.Y.Node.create(new EJS({text: this.getStatic().templates.feedbackForm}).render(templateData));
            this._dialog = RightNow.UI.Dialog.actionDialog(this.data.attrs.label_dialog_title, dialogForm, {"buttons" : buttons, "dialogDescription" : this.baseDomID + "_DialogDescription", "width" : this.data.attrs.dialog_width || ''});
            // Set up keylistener for <enter> to run onSubmit()
            this._keyListener = RightNow.UI.Dialog.addDialogEnterKeyListener(this._dialog, this._onSubmit, this);
            RightNow.UI.show(dialogForm);
            this.Y.one('#' + this._dialog.id).addClass('rn_AnswerFeedbackDialog');
        }

        this._emailField = this._emailField || this.Y.one(this.baseSelector + "_EmailInput");
        this._errorDisplay = this._errorDisplay || this.Y.one(this.baseSelector + "_ErrorMessage");
        this._feedbackField = this._feedbackField || this.Y.one(this.baseSelector + "_FeedbackTextarea");

        if(this._errorDisplay) {
            this._errorDisplay.set("innerHTML", "").removeClass('rn_MessageBox rn_ErrorMessage');
        }

        this._dialog.show();

        // Enable controls, focus the first input element
        var focusElement;
        if(this._emailField && this._emailField.get("value") === '')
            focusElement = this._emailField;
        else
            focusElement = this._feedbackField;

        focusElement.focus();
        RightNow.UI.Dialog.enableDialogControls(this._dialog, this._keyListener);
    },
	_onSubmit: function(type, args) {
        var target = (args && args[1]) ? (args[1].target || args[1].srcElement) : null;

        //Don't submit if they are using the enter key on certain elements
        if(type === "keyPressed" && target) {
            var tag = target.get('tagName'),
                innerHTML = target.get('innerHTML');
            if(tag === 'A' || tag === 'TEXTAREA' || innerHTML === this.data.attrs.label_send_button || innerHTML === this.data.attrs.label_cancel_button) {
                return;
            }
        }
        if (!this._validateDialogData()) {
            return;
        }
        // Disable submit and cancel dialog buttons
        RightNow.UI.Dialog.disableDialogControls(this._dialog, this._keyListener);
        this._incidentCreateFlag = true;  //Keep track that we're creating an incident.
        this._submitFeedback();
    },
	_onCancel: function() {
        RightNow.UI.Dialog.disableDialogControls(this._dialog, this._keyListener);
        this._closeDialog(true);
    },
	_validateDialogData: function() {
        this._errorDisplay.set("innerHTML", "").removeClass('rn_MessageBox rn_ErrorMessage');

        var returnValue = true;
        if (this._emailField) {
            this._emailField.set("value", this.Y.Lang.trim(this._emailField.get("value")));
            if (this._emailField.get("value") === "") {
                this._addErrorMessage(RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_IS_REQUIRED_MSG"), this.data.attrs.label_email_address), this._emailField.get("id"));
                returnValue = false;
            }
            else if (!RightNow.Text.isValidEmailAddress(this._emailField.get("value"))) {
                this._addErrorMessage(this.data.attrs.label_email_address + ' ' + RightNow.Interface.getMessage("FIELD_IS_NOT_A_VALID_EMAIL_ADDRESS_MSG"), this._emailField.get("id"));
                returnValue = false;
            }
        }
        // Examine feedback text.
        this._feedbackField.set("value", this.Y.Lang.trim(this._feedbackField.get("value")));
        if (this._feedbackField.get("value") === "") {
            this._addErrorMessage(RightNow.Text.sprintf(RightNow.Interface.getMessage("PCT_S_IS_REQUIRED_MSG"), this.data.attrs.label_comment_box), this._feedbackField.get("id"));
            returnValue = false;
        }
        return returnValue;
    },
	_addErrorMessage: function(message, focusElement) {
        if(this._errorDisplay) {
            this._errorDisplay.addClass('rn_MessageBox rn_ErrorMessage');
            //add link to message so that it can receive focus for accessibility reasons
            var newMessage = focusElement ? '<a href="javascript:void(0);" onclick="document.getElementById(\'' + focusElement + '\').focus(); return false;">' + message + '</a>' : message,
                oldMessage = this._errorDisplay.get("innerHTML");
            if (oldMessage !== "") {
                newMessage = oldMessage + '<br>' + newMessage;
            }

            this._errorDisplay.set("innerHTML", newMessage);
            this._errorDisplay.one("h2") ? this._errorDisplay.one("h2").setHTML(RightNow.Interface.getMessage("ERRORS_LBL")) : this._errorDisplay.prepend("<h2>" + RightNow.Interface.getMessage("ERROR_LBL") + "</h2>");
            this._errorDisplay.one("h2").setAttribute('role', 'alert');
            if(focusElement) {
                this._errorDisplay.one('a').focus();
            }
        }
    },
	_closeDialog: function(cancelled) {
        if(!cancelled) {
            //Feedback submitted: clear existing data if dialog is reopened
            this._feedbackField.set("value", "");
        }
        // Get rid of any existing error message, so it's gone if the user opens the dialog again.
        if(this._errorDisplay) {
            this._errorDisplay.set("innerHTML", "").removeClass('rn_MessageBox rn_ErrorMessage');
        }

        if (this._dialog) {
            this._dialog.hide();
        }
    },
	_submitFeedback: function() {
		var keywor = this._geturlParam('kw');
        var eventObject = new RightNow.Event.EventObject(this, {data: {
                key: keywor[0],
                message: this._feedbackField.get('value'),
                f_tok: this.data.js.f_tok
        }});
        
        RightNow.Ajax.makeRequest(this.data.attrs.submit_feedback_ajax, eventObject.data, {successHandler: this._onResponseReceived, scope: this, data: eventObject, json: true});
        
    },
	_onResponseReceived: function(response, originalEventObj) {
console.log(response);
                if(response) {
                    this._closeDialog();
					RightNow.UI.Dialog.messageDialog("Feedback Successfully Submitted", {icon : "TIP"});
                    /* RightNow.UI.displayBanner(this.data.attrs.label_feedback_submitted, {
                        focusElement: this._thanksLabel,
                        baseClass: "rn_ThanksLabel"
                    }); */
					
                }
                else {
                    var message = "Sorry. Something Went Wrong!!";
                    this._addErrorMessage(message, null);
                    RightNow.UI.Dialog.enableDialogControls(this._dialog, this._keyListener);
                }
               // this._closeDialog();
            
        
    },
	_setvisiblity: function(type, args)
	{
		if(args[0] > 0)
		{
			document.getElementById('noresults').style.display = 'none';
		}else {
			document.getElementById('noresults').style.display = 'block';
		}
		
	}
});