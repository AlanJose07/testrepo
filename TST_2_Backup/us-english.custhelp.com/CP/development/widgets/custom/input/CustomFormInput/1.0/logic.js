RightNow.namespace('Custom.Widgets.input.CustomFormInput');
Custom.Widgets.input.CustomFormInput = RightNow.Widgets.extend({     /**
     * Widget constructor.
     */
    constructor: function() {
        RightNow.Event.subscribe("evt_membertype_changed", this.validationReset, this);
    },
    validationReset:function(type,args){
        console.log(args);
        let inputFirstName = document.getElementsByName(`${this.data.attrs.name}`)[0];
		inputFirstName.classList.remove("rn_ErrorField");
		document.querySelector(`label[for="${inputFirstName.getAttribute("id")}"]`).classList.remove("rn_ErrorLabel");
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    },    /**
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