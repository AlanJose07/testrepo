RightNow.namespace('Custom.Widgets.input.CustomFileAttachmentUpload');
Custom.Widgets.input.CustomFileAttachmentUpload = RightNow.Widgets.extend({ 
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
     * Renders the `attachmentItem.ejs` JavaScript template.
     */
    renderAttachmentItem: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.attachmentItem}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `error.ejs` JavaScript template.
     */
    renderError: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.error}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    },

    /**
     * Renders the `maxMessage.ejs` JavaScript template.
     */
    renderMaxMessage: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.maxMessage}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});