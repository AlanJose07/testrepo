RightNow.namespace('Custom.Widgets.search.amccSearch');
Custom.Widgets.search.amccSearch = RightNow.Widgets.SearchButton.extend({ 
    /**
     * Place all properties that intend to
     * override those of the same name in
     * the parent inside `overrides`.
     */
    overrides: {
        /**
         * Overrides RightNow.Widgets.SearchButton#constructor.
         */
        constructor: function() {
            // Call into parent's constructor
            this.parent();
			
			RightNow.Event.subscribe("evt_setValueKeyword", this._tailSearch, this);
			
			
        },
		
		

        /**
         * Overridable methods from SearchButton:
         *
         * Call `this.parent()` inside of function bodies
         * (with expected parameters) to call the parent
         * method being overridden.
         */
        // _startSearch: function(evt)
        // _enableClickListener: function()
        // _disableClickListener: function()
    },

    /**
     * Sample widget method.
     */
	 _tailSearch:function(type,args)
	 {
		
		 document.getElementById('info').style.display="none";
		var keyword = args[0].data.keyword;
		//alert(keyword);
		var path = window.location.pathname .split( '/' );
		path='/'+path[1]+'/'+path[2]+'/'+path[3];
		var url="https://"+window.location.hostname+path;
		RightNow.Ajax.makeRequest('/cc/AjaxCustom/getsnowdetails/', {keyword:keyword}, {
				successHandler: function(response) {
					
				
				var res=response.responseText.split("/");
//				console.log(res);
				
				var cur_url=window.location.href;
				var c=cur_url.includes(keyword);
				if(c==false)
					document.getElementById('page').innerHTML="";
				
				if(res.length==8)
				{
					
					if(res[4]==1)
					
//					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/n/'+res[2]+'/a/'+res[5];
					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/n/'+res[2]+'/a/'+res[5]+'/acstatus/'+res[6]+'/decomm/'+res[7];

					else
//					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/a/'+res[5];
					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/a/'+res[5]+'/acstatus/'+res[6]+'/decomm/'+res[7];
				  
				}
				else
				{

					
				document.getElementById('nose').innerHTML="";
				document.getElementById('aircraft').innerHTML="";
//				document.getElementById('acstatus').innerHTML="";
//				document.getElementById('decomm').innerHTML="";
				
				var count=res.length-1;
				console.log(res)
				console.log(count)
//				var count=res.length-3;
				for (i = 1; i <= count; i++)
				{
					
					if(i==4)
					{
						
//					 document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'>'+res[i-1]+'</a>';			 
					 document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'/acstatus/'+res[i+1]+'/decomm/'+res[i+2]+'>'+res[i-1]+'</a>';
					 
					var a=i;
					}
//					else if(i==a+5)
					else if(i==a+7)
					{
						
//					 document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'>'+res[i-1]+'</a>';
					 document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'/acstatus/'+res[i+1]+'/decomm/'+res[i+2]+'>'+res[i-1]+'</a>';
					a=i;
					}
				
//					else if(i%5===0)
					else if(i%7===0)
					{
						document.getElementById('page').innerHTML+='<br>';
					}
					else
					{
//						document.getElementById('page').innerHTML +=res[i-1]+" ";
						document.getElementById('page').innerHTML +=" "+res[i-1]+" ";
					}
            		
				
				}
				}		
				}

			});
	 },
	 
    methodName: function() {

    }
});
