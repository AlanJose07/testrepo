RightNow.namespace('Custom.Widgets.AdditionalServices.sessionTracker');
var main ;
var logTimer = "";
Custom.Widgets.AdditionalServices.sessionTracker = RightNow.Widgets.extend({     /**
     * Widget constructor.
     */
    constructor: function() {

        if(this.data.attrs.usertype == "AMCC_Agent")
        {
            main = this;
            let visited="1";   
            customAjaxCall(visited);
        }
    },
    /**
     * Sample widget method.
     */
    methodName: function() {
    },    /**
     * Makes an AJAX request for `default_ajax_endpoint`.
     */
    getDefault_ajax_endpoint: function(param) {
  
    },
    /**
     * Handles the AJAX response for `default_ajax_endpoint`.
     * @param {object} response JSON-parsed response from the server
     * @param {object} originalEventObj `eventObj` from #getDefault_ajax_endpoint
     */
    default_ajax_endpointCallback: function(response, originalEventObj) {
 
        
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

function customAjaxCall(visited)
{
    if(RightNow.Profile.contactID() === "" || RightNow.Profile.contactID() === null && main.data.js.pageurl ==="" || main.data.js.pageurl  ===   null){
        console.warn("Parameter Contain Null Value");
        return;
    }
    clearInterval(logTimer);
    let param = {
        contactID:RightNow.Profile.contactID(),
        pageURL:main.data.js.pageurl,
        pageVisited:visited
    };
    param = JSON.stringify(param);
    console.log("Parameter",param);
    RightNow.Ajax.makeRequest('/cc/SessionLogTime/CustomAgentSessionLog',{
                "parameters":param
            },
            {
                successHandler: function(response){
                    let visited="0";
                    logTimer = setInterval(customAjaxCall,300000,visited);
                },
                error:function (){
                    console.log("Unsuccess Request Error");
                },
                scope:          this,
                type: 			"POST",
                json:           true
            }
        );
}
