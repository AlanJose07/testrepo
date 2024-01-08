RightNow.namespace('Custom.Widgets.lob.test');
Custom.Widgets.lob.test = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

    /**
     * Renders the `answerResult.ejs` JavaScript template.
     */
    renderAnswerResult: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.answerResult}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `buttonResponse.ejs` JavaScript template.
     */
    renderButtonResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.buttonResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `imageResponse.ejs` JavaScript template.
     */
    renderImageResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.imageResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `linkResponse.ejs` JavaScript template.
     */
    renderLinkResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.linkResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `menuResponse.ejs` JavaScript template.
     */
    renderMenuResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.menuResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `question.ejs` JavaScript template.
     */
    renderQuestion: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.question}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `radioResponse.ejs` JavaScript template.
     */
    renderRadioResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.radioResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `textResponse.ejs` JavaScript template.
     */
    renderTextResponse: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.textResponse}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `textResult.ejs` JavaScript template.
     */
    renderTextResult: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.textResult}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});