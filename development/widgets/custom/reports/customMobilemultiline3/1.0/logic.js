RightNow.namespace('Custom.Widgets.reports.customMobilemultiline3');
Custom.Widgets.reports.customMobilemultiline3 = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		for(var i=0;i<this.data.js.cntresult;i++)
			{
				this.wh_ = this.Y.one('#' +"qst_"+i);
				this.wh_.on('click', this._ShowHide,this);
			}

    },
	 /**
     * Function to show/hide the answer details on clicking the question
     */
    _ShowHide:  function(type,args){
		 var btnid=type._currentTarget.id;
		 var lno = btnid.substr(btnid.lastIndexOf('qst_') + 4);
		 var a_id=this.Y.one('#' +'get_ans_'+lno).get('value');
		
     		
	   if(this.Y.one('#' +'ans_'+lno).getStyle('display')=="none")
	   {
	   		this.Y.one('#' +'ans_'+lno).setStyle('display','block');
			RightNow.Ajax.makeRequest('/cc/ajaxCustom/set_answer_view/', {a_id:a_id}, {
			successHandler: function(response)
			{
				
			}
         });
	   }
	   else
	   {
		   	this.Y.one('#' +'ans_'+lno).setStyle('display','none');
	   }
	  
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});