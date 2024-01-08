RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomFileAttachmentUpload');
Custom.Widgets.ResponsiveDesign.CustomFileAttachmentUpload = RightNow.Widgets.FileAttachmentUpload.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.FileAttachmentUpload#constructor.
         */
        constructor: function(data, instanceID) {
            // Call into parent's constructor
            this.parent();
			
			this.instanceID = instanceID;
			this.data = data;
			console.log(this.data);
			var fieldName = data.js.name;
			RightNow.Event.subscribe("file_attachement_field_required", this._file_attachement_field_required, this);
			RightNow.Event.subscribe("reset1", this._reset1, this);
			RightNow.Event.subscribe("file_attachement_field_not_required", this._file_attachement_field_not_required, this);
        },
		
		_displayError: function(errorMessage, errorLocation) {
        var errorMessage = "Joindre des documents est requis"
        var commonErrorDiv = this.Y.one("#" + errorLocation);
        if(commonErrorDiv) {
            commonErrorDiv.append(new EJS({text: this.getStatic().templates.error}).render({
                errorLink: (this.data.attrs.label_error.indexOf("%s") > -1) ? RightNow.Text.sprintf(this.attrs.label_error, this.data.attrs.label_input) : errorMessage,
                id: this.input.get('id'),
                fieldName: this._fieldName
            }));
        }
        this.toggleErrorIndicator(true);
    }

        /**
         * Overridable methods from FileAttachmentUpload:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // getValue: function()
        // swapLabel: function(container, minAttachments, label, template)
        // updateMinAttachments: function(evt, constraint)
        // _onKeyPress: function(event)
        // _onFileAdded: function(e)
        // _validateFileExtension: function(fileName)
        // _setStatusMessage: function(message, screenReaderClass, errorClass, role, tabIndex)
        // _sendUploadRequest: function()
        // _processServerError: function(response)
        // _processAttachmentThreshold: function(count)
        // _fileUploadReturn: function(response, originalEventObject)
        // _getFileFromInput: function()
        // _renderNewAttachmentItem: function(filename, count)
        // _normalizeFilename: function (filename, originalFileName)
        // _renameDuplicateFilename: function (filename)
        // _loadThumbnail: function(file, reader, callback)
        // _fileUploadFailure: function(response)
        // getAttachmentErrorInfo: function(attachmentInfo)
        // resetInput: function()
        // recreateInput: function()
        // removeClick: function(event, index)
        // _onValidateUpdate: function(type, args)
        // toggleErrorIndicator: function(showOrHide)
        // _setLoading: function(turnOn, statusMessage)
        // _displayError: function(errorMessage, errorLocation)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	_reset1: function(type,args)
	{
		
		var errorWidget = document.getElementById("rn_" + this.instanceID + '_FileInput');
		errorWidget.classList.remove("rn_ErrorField");
		document.getElementById("rn_errorlocation_chat").innerHTML = "";
		document.getElementById("rn_errorlocation_chat").classList.remove("rn_MessageBox");	
	},
	_file_attachement_field_required: function(type,args)
	{
		 this.data.attrs.min_required_attachments="1";
		 var label = document.getElementById("rn_" + this.instanceID + "_Label");
		 console.log(label);
		 label.innerHTML= this.data.attrs.label_input+"<span class='rn_Required'> *</span>";
		 
	},
	_file_attachement_field_not_required: function(type,args)
	{
		 this.data.attrs.min_required_attachments="0";
		
		 
	}
});