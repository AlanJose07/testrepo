RightNow.namespace('Custom.Widgets.ResponsiveDesign.ChannelDisplayPreChatSurvey');
Custom.Widgets.ResponsiveDesign.ChannelDisplayPreChatSurvey = RightNow.Widgets.extend({ 
    /**
     * Widget constructor.
     */
    constructor: function(data, instanceID) {
		
		  /******************************* Primary[top level] category name and id code start, Self service form details*****************************************/
            
			this.data = data;
			var url=String(window.location);   
            var exploded_url= url.split("/");
			var index=exploded_url.indexOf("TLP");
			//this.top_parent= exploded_url[index+1].replace("%20"," ").split('-'); 
			this.top_parent= exploded_url[index+1].split('.'); 
			
			var catid = exploded_url.indexOf("catid");
			this.categoryid= exploded_url[catid+1].split('/'); 
			/******************************* Primary[top level] category name and id code end, Self service form details*****************************************/
			
		  /* console.log(this.data.js.bblive);
			RightNow.Ajax.makeRequest('/cc/bbresponsivecontroller/bblivecategory', {text:this.categoryid[0]}, {
                    successHandler: function(response) {
								
								console.log(response);
								if(response ==2)
								{
								this.top_parent[0] = '1706';
								
								}
								this.display_fields_for_all_categories();
								 
							},
							scope: this,
							json: true,
							async: false,
							type: "POST"
                	});*/
			
		  if(this.data.js.bblive == 2)
		  this.top_parent[0] = '1706';
		  this.display_fields_for_all_categories();
			// window.addEventListener("load", this.methodName());
    

    },

    /**
     * Sample widget method.
     */
    methodName: function() {
		
    },
	
	
	
	display_fields_for_all_categories: function(type,i)
    { 
	
	if(this.data.attrs.channel == 1)
		{
			
			var checked_channel =1532;
			var channel = new RightNow.Event.EventObject(this, {data:checked_channel});
			
			var displayNone =["remove-callus-email"];
			this._displayNone(displayNone);
			
			
			RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language (i think we can remove this.)
			
			
			
			RightNow.Event.fire("chat_fields_required",channel);   
			RightNow.Event.fire("chat_fields_not_required",channel);
			// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
			// the first code comment and the second code created..
			RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
			//explained above
			
			RightNow.Event.fire("reset",channel);
			RightNow.Event.fire("file_attachement_field_not_required",channel);
		}
		
		if(this.data.attrs.channel == 2)  // Chat
		{ 
		
		
		var checked_channel =1529;
		var channel = new RightNow.Event.EventObject(this, {data:checked_channel}); 
        if((this.top_parent[0]!=='1704') && (this.top_parent[0]!=='1706'))// if condition-- Not My coach business(not the special categories) and not bblive instructor 

		{
			         
		    if(checked_channel=='1529')//chat with an agent
				{
					 
						var displayBlock =["regular-chat-hours"];
						var displayNone =["diamond-chat-hours"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
						
						RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
				
				}// chat with an agent
				
		
        }// end of if condition-- Not My coach business
	  
      else if(this.top_parent[0]=='1704')  // else condition-- My coach business
	  
      {

		
		 if(checked_channel=='1529')//chat with an agent
			{
			
				var displayBlock =["regular-chat-hours"];
				var displayNone =["diamond-chat-hours"];
				this._displayBlock(displayBlock);
				this._displayNone(displayNone);
				
		        RightNow.Event.fire("show_regular_chathours_details",channel);  // this will be subscribed to Custom.Widgets.ResponsiveDesign.Language
				RightNow.Event.fire("chat_fields_required_special_categories",channel);
				RightNow.Event.fire("chat_fields_not_required_special_categories",channel);
				RightNow.Event.fire("remove_required_special_categories",channel);
				RightNow.Event.fire("fire_to_lifetimerank_from_chat_special_categories");
		
		
			}// end of chat with an agent
		

   	  }// end of else condition-- My coach business
   
   
   	  else //BBlive instructor condition
   		{
	  		
			 if(checked_channel=='1529')//chat with an agent
				{
					 //  alert("here");
					   
				
						RightNow.Event.fire("chat_fields_required",channel);   
						RightNow.Event.fire("chat_fields_not_required",channel);
						// As per the client requirement life time rank is adding in the categories other than view my coach business. To achieve this functionality
				       // the first code comment and the second code created..
						RightNow.Event.fire("fire_to_lifetimerank_from_chat_categories");
						//explained above
						RightNow.Event.fire("fire_to_bblivechathour");//fire to the bblive chathour widget under ResponsiveDesign
					
						var displayBlock =["bblive-chat-hours","bblive-chat-status"];
						var displayNone =["diamond-chat-hours","regular-chat-hours"];
						this._displayBlock(displayBlock);
						this._displayNone(displayNone);
				
				
				}// chat with an agent
				
   	    }//BBlive instructor condition
	}
     
},//end of display_fields_for_all_categories
	_displayNone: function(displayNone)
	{
		
		
		for (var i=0;i<displayNone.length;i++)
		{
			if(document.getElementById(displayNone[i]))
			{	
				document.getElementById(displayNone[i]).style.display = "none";
			}
		}	
	},
	
	_displayBlock: function(displayBlock)
	{
		
		for (var i=0;i<displayBlock.length;i++)
		{
			if(document.getElementById(displayBlock[i]))
			{
				document.getElementById(displayBlock[i]).style.display = "block";
			}
		}
		
	}
});




