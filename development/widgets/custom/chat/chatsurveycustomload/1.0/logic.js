RightNow.namespace('Custom.Widgets.chat.chatsurveycustomload');
Custom.Widgets.chat.chatsurveycustomload = RightNow.Widgets.extend({     /**
     * Widget constructor.
     */
    constructor: function() {
		  RightNow.Event.subscribe("loadsurvey", this._onResponseReceived, this);
		 
    },
    /**
     * Sample widget method.
     */
    _onResponseReceived: function(type,args) {
		console.log(args[0].surveyurl);
		//alert('received');
		$('#page_content').show();
		$('.chat-survey-container').hide();
		$('.loader').show();
		$('#page_content').append('<IFRAME id="myId" scrolling="no" width="100%" height="" />');
		$('iframe#myId').attr('src', args[0].surveyurl);
		$('iframe#myId').load(function() {
			var addwidth = 120;
			if(screen.width < 655 && screen.width > 370)
			{
				//addwidth = 1560 - this.contentWindow.document.body.offsetHeight;
				addwidth = 160;
			}
			if(screen.width <= 370)
			{
				//addwidth = 1700 - this.contentWindow.document.body.offsetHeight;
				addwidth = 180;
			}
			//alert(this.contentWindow.document.body.offsetHeight);
			//callback(this);
			//alert(this.contentWindow.document.body.offsetHeight + 'px');
			this.style.height = this.contentWindow.document.body.offsetHeight+addwidth + 'px';
			$('#page_content').show();
			$('.loader').hide();
		});
    }
});