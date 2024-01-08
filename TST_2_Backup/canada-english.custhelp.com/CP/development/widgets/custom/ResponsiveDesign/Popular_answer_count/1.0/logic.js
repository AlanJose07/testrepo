RightNow.namespace('Custom.Widgets.ResponsiveDesign.Popular_answer_count');
Custom.Widgets.ResponsiveDesign.Popular_answer_count = RightNow.Widgets.extend({ 
    /**
     * Widget constructor...
     */
    constructor: function() {
		
			if(document.getElementById("most_popular_answer"))
			{
					var id=this.baseSelector+"_0";
					this.ios=id;
					this.input = this.Y.one(id);
					this.input.on("click", this.most_popular_answer, this);	
			}

    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    },
	 most_popular_answer: function() {      
	 
		 var top_parent_info=document.getElementById("parent_category_id").value; 
		 var url='/app/answers/most_popular_answers/catid/'+this.data.js.parent_cat_id+'/catnme/'+this.data.js.parent_cat_name+'/ans_id/'+this.data.attrs.report_id+'/TLP/'+top_parent_info;
		 window.location.href = url;

    }
});