RightNow.namespace('Custom.Widgets.forms.Intlcheck');
Custom.Widgets.forms.Intlcheck = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
        
		this._field = this.Y.one("#intlcheck");
		this._field.on("change",this._intlChecked,this);
    },

    /**
     * Sample widget method.
     */
	 
	 
	_intlChecked: function(type, args)
    {
        var eo = new RightNow.Event.EventObject();
        eo.data = {"checked" : document.getElementById("intlcheck").checked};
        RightNow.Event.fire("evt_intlChecked", eo);
    },
	
    methodName: function() {

    }
});