RightNow.namespace('Custom.Widgets.chat.ChatSurveyLink');
Custom.Widgets.chat.ChatSurveyLink = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
			var chaturl = this.data.js.url;
			data = {surveyurl:chaturl};
			$('.chat-survey-link-new').click(function(event) {
			event.preventDefault();
			RightNow.Event.fire("loadsurvey", data);
			});
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});