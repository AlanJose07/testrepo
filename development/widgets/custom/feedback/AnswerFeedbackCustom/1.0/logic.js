RightNow.namespace('Custom.Widgets.feedback.AnswerFeedbackCustom');
Custom.Widgets.feedback.AnswerFeedbackCustom = RightNow.Widgets.AnswerFeedback.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.AnswerFeedback#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
        },
		
		_onCancel: function()
		{
			RightNow.UI.Dialog.disableDialogControls(this._dialog, this._keyListener);
		//	----------------------------------------------------
			RightNow.Ajax.makeRequest('/ci/ajaxCustom/cancelButton', {a_id:this.data.js.answerID}, {
		   successHandler:function(response){
			   },
		   scope: this,
		   json: true
		   });
		//------------------------------------------	
          this._closeDialog(true);
			
		}

        /**
         * Overridable methods from AnswerFeedback:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _onClick: function(event, rating)
        // _showDialog: function()
        // _onSubmit: function(type, args)
        // _onCancel: function()
        // _validateDialogData: function()
        // _closeDialog: function(cancelled)
        // _submitFeedback: function()
        // _onResponseReceived: function(response, originalEventObj)
        // _submitAnswerRating: function()
        // _replaceRatingElementsWithMessage: function()
        // _onRatingResponseReceived: function(response, originalEventObj)
        // _addErrorMessage: function(message, focusElement)
        // _onCellOver: function(event, chosenRating)
        // _updateCellClass: function(minBound, maxBound, removeOrAddClass)
        // _onCellOut: function(event, args)
        // _onFormTokenUpdate: function(type, args)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});