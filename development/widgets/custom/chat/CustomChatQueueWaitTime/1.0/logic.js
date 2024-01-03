RightNow.namespace('Custom.Widgets.chat.CustomChatQueueWaitTime');
Custom.Widgets.chat.CustomChatQueueWaitTime = RightNow.Widgets.ChatQueueWaitTime.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.ChatQueueWaitTime#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			$('.rn_Status').hide();
			$('.rn_StatusPrefix').hide();
        },
			 _initialize: function()
    {
        var uiUtils = RightNow.Chat.UI.Util;
        this._queuePositionMsg = uiUtils.doPositionAndWaitTimeVariableSubstitution(this.data.attrs.label_queue_position, this.instanceID + "_QueuePosition", RightNow.Interface.getConfig("ESTIMATED_WAIT_TIME_SAMPLES", "RNL"));
		
        this._estimatedWaitTimeMsg = uiUtils.doPositionAndWaitTimeVariableSubstitution(this.data.attrs.label_estimated_wait_time, this.instanceID + "_EstimatedWaitTime", RightNow.Interface.getConfig("ESTIMATED_WAIT_TIME_SAMPLES", "RNL"));
        this._averageWaitTimeMsg = uiUtils.doPositionAndWaitTimeVariableSubstitution(this.data.attrs.label_average_wait_time, this.instanceID + "_AverageWaitTime", RightNow.Interface.getConfig("ESTIMATED_WAIT_TIME_SAMPLES", "RNL"));

        this._queuePositionElement.setAttribute("aria-live", "polite").setAttribute("aria-atomic", "true");
        this._estimatedWaitTimeElement.setAttribute("aria-live", "polite").setAttribute("aria-atomic", "true");
        this._averageWaitTimeElement.setAttribute("aria-live", "polite").setAttribute("aria-atomic", "true");
        if(uiUtils.hasLeaveScreenIssues())
        {
            RightNow.UI.show(this._leaveScreenWarningElement);
        }
    },
		
		_onChatQueuePositionNotificationResponse: function(type, args){
        this._updateQueuePosition(args[0].data.position);
		
        this._updateEstimatedWaitTime(args[0].data.expectedWaitSeconds);
        this._updateAverageWaitTime(args[0].data.averageWaitSeconds);
    },
		 _onChatStateChangeResponse: function(type, args)
    {
		if(args[0].data.currentState !== RightNow.Chat.Model.ChatState.SEARCHING)
		{
			$('.rn_Status').show();
			$('.rn_StatusPrefix').show();
		}
		
        //show or hide the widget
        if(args[0].data.currentState === RightNow.Chat.Model.ChatState.SEARCHING ||
           args[0].data.currentState === RightNow.Chat.Model.ChatState.REQUEUED)
        {
            this._estimatedWaitTimeDisplayed = false;

            //display queue postion element
            if(this._displayQueuePosition)
            {
                this._queuePositionElement.set('innerHTML', this.data.attrs.label_queue_position_not_available);
                RightNow.UI.show(this._queuePositionElement);
            }

            //display estimated wait time element
            if(this._displayEstimatedWaitTime)
            {
				
                this._estimatedWaitTimeElement.set('innerHTML', this.data.attrs.label_estimated_wait_time_not_available);
                RightNow.UI.show(this._estimatedWaitTimeElement);
            }

            //display average wait time element
            if(this._displayAverageWaitTime)
            {
                this._averageWaitTimeElement.set('innerHTML', this.data.attrs.label_average_wait_time_not_available);
                RightNow.UI.show(this._averageWaitTimeElement);
            }

            //finally display the container
            RightNow.UI.show(this._queueWaitTimeContainer);
        }
        else if(args[0].data.currentState === RightNow.Chat.Model.ChatState.RECONNECTING)
        {
            return;
        }
        else
        {
            //just hide the container
            RightNow.UI.hide(this._queueWaitTimeContainer);
        }
    },



        /**
         * Overridable methods from ChatQueueWaitTime:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _initialize: function()
        // _onChatStateChangeResponse: function(type, args)
        // _onChatQueuePositionNotificationResponse: function(type, args)
        // _updateQueuePosition: function(position)
        // _updateQueuePositionMessage: function(position)
        // _updateQueuePositionValue: function(position)
        // _updateEstimatedWaitTime: function(estimatedWaitSeconds)
        // _updateEstimatedWaitTimeMessage: function(estimatedWaitSeconds)
        // _updateEstimatedWaitTimeValue: function(estimatedWaitSeconds)
        // _updateAverageWaitTime: function(averageWaitSeconds)
        // _updateAverageWaitTimeMessage: function(averageWaitSeconds)
        // _updateAverageWaitTimeValue: function(averageWaitSeconds)
        // _reconnectUpdateResponse: function(type, args)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});