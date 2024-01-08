RightNow.namespace('Custom.Widgets.ResponsiveDesign.CategoryTile');
Custom.Widgets.ResponsiveDesign.CategoryTile = RightNow.Widgets.extend({ 
    /**
     * Widget constructor...
     */
    constructor: function() {

  	    
			/**
             * the more_link is the id of More Categories.
			 * If it is present then its click event is captured here and helps in the toggling of More Categories and Fewer Categories
             */
			//alert(RightNow.Interface.getMessage('ALT_LBL'));
			//#rn:msg:CUSTOM_MSG_MORE_CATEGORY#
		    if(document.getElementById("more_link"))
			{
	        var id=this.baseSelector+"_0";
			this.input = this.Y.one(id);
			this.input.on("click", this.hide_show_more_categories, this);	
			}

    },

    /**
     * Sample widget method.
     */
    hide_show_more_categories: function() {
		
		        
		var button_toggle="rn_"+this.instanceID+"_1";
		var more_categories = RightNow.Interface.getMessage('CUSTOM_MSG_MORE_CATEGORY');
		var less_categories = RightNow.Interface.getMessage('CUSTOM_MSG_FEWER_CATEGORY');
		
		if(document.getElementById("more_link_categories").style.display == "none")
		{
			    
				document.getElementById("more_link_categories").style.display = "block";
				document.getElementById('more_link').innerHTML = "<a href='javascript:void(0);' id="+button_toggle+">"+less_categories+"</a>";
				$('#parent_more').addClass(' parent_more_category');
				
		
		}
		else
		{
				document.getElementById("more_link_categories").style.display = "none";
				document.getElementById('more_link').innerHTML = "<a href='javascript:void(0);' id="+button_toggle+">"+more_categories+"</a>";
				$('#parent_more').removeClass(' parent_more_category');
		
		}  
		
		        var id_button_toggle=this.baseSelector+"_1";
			    this.input = this.Y.one(id_button_toggle);
			    this.input.on("click", this.hide_show_more_categories, this);

    }
});