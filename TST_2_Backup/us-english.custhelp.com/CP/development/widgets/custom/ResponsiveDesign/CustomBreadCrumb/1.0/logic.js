RightNow.namespace('Custom.Widgets.ResponsiveDesign.CustomBreadCrumb');
Custom.Widgets.ResponsiveDesign.CustomBreadCrumb = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function() {
		//alert("inn--"+this.data.js.category_id_first+"---"+this.data.js.category_id_second+"---"+this.data.js.category_id_third);
		/*console.log(this.data);
		try
		{
			var url_string = String(window.location.href);
			var exp_url = url_string.split('/');
			var pos = exp_url.indexOf('catid');
			var first = this.data.js.category_id_first;
			var second = this.data.js.category_id_second;
			var third = this.data.js.category_id_third;
			var fourth = this.data.js.category_id_fourth;
			var fifth = this.data.js.category_id_fifth;
			var sixth = this.data.js.category_id_sixth;
			var c =0;
			if(pos != -1)
			{
				c = exp_url[pos+1];
			}
			if(first)
			{
				if(second)
				{
					if(third)
					{
						if(fourth)
						{
							if(fifth)
							{
								if(sixth)
								{
									
								}
								else
								{
									sixth = c;	
								}
							}
							else
							{
								fifth = c;	
							}
						}
						else
						{
							fourth = c;	
						}
					}
					else
					{
						third = c;
					}
				}
				else
				{
					second = c	
				}
			}
			else
			{
				first = c;
			}
			document.getElementById('hidden_cat').value = this.data.js.category_id_first||this.data.js.category_id_second||this.data.js.category_id_third||this.data.js.category_id_fourth||this.data.js.category_id_fifth||this.data.js.category_id_sixth;
		}
		catch(err)
		{}*/
    },

    /**
     * Sample widget method.
     */
    methodName: function() {

    }
});