RightNow.namespace('Custom.Widgets.input.samanth.CustomSelectionInput');
Custom.Widgets.input.samanth.CustomSelectionInput = RightNow.Widgets.SelectionInput.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SelectionInput#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
            if (this.data.attrs.name == "Incident.CustomFields.c.type") {
            	this.input = this.Y.one(this._inputSelector);
            	console.log(this._inputSelector);
            	this.input.on("change",this.sendSelectedText,this);
            }
        },
        sendSelectedText: function() {
        	if (this.input.get("value") == 1319 || this.input.get("value") == 1318) {
        		document.getElementById("articles").style.display = "block";
        	} else {
        		document.getElementById("articles").style.display = "none";
        	}
        	var eventObject = new RightNow.Event.EventObject(this, {data: {selectedText: this.input.get("value")}});
        	RightNow.Event.fire("selectedType",eventObject);
        }

        /**
         * Overridable methods from SelectionInput:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // onValidate: function(type, args)
        // displayError: function(errors, errorLocation)
        // toggleErrorIndicator: function(showOrHide)
        // blurValidate: function()
        // countryChanged: function()
        // successHandler: function(response)
        // onProvinceResponse: function(type, args)
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },

    /**
     * Renders the `view.ejs` JavaScript template.
     */
    renderView: function() {
        // JS view:
        var content = new EJS({text: this.getStatic().templates.view}).render({
            // Variables to pass to the view
            // display: this.data.attrs.display
        });
    }
});