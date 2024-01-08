RightNow.namespace('Custom.Widgets.ResponsiveDesign.ExtendedChatQueueWaitTime');
Custom.Widgets.ResponsiveDesign.ExtendedChatQueueWaitTime = RightNow.Widgets.ChatQueueWaitTime.extend({ 
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
		$('body').on('click', '.rn_ChatQueuePosition a', function() {
			$(".rn_ChatEngagementStatus").hide();
    		RightNow.Event.fire("evt_chatHangupRequest",
                new RightNow.Event.EventObject(this, {data: {isCancelled: true, cancelingUrl: ''}}));
});
	/*	var span = document.getElementById('rn_ExtendedChatQueueWaitTime_10_QueuePosition');	
span.onclick = function() {
	
alert("hello");
RightNow.Event.fire("evt_chatHangupRequest",
                new RightNow.Event.EventObject(this, {data: {isCancelled: true, cancelingUrl: ''}}));
	

	
}*/
    }
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});