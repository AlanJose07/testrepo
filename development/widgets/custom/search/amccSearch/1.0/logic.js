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
		console.log("KetWord::->"+keyword);
		//alert(keyword);
		var path = window.location.pathname .split( '/' );
		path='/'+path[1]+'/'+path[2]+'/'+path[3];
		var url="https://"+window.location.hostname+path;
		RightNow.Ajax.makeRequest('/cc/AjaxCustom/getsnowdetails/', {keyword:keyword}, {
			successHandler: function(response) {
				console.log("AMCC Respose");
				// console.log(response.responseXML);
					console.log(response.responseText);
				console.log("End___");
				
				var res=response.responseText.split("/");
				console.table(res);
				//console.log(res);
				//return;
				var cur_url=window.location.href;
				var c=cur_url.includes(keyword);
				if(c==false)
					document.getElementById('page').innerHTML="";
				if(res.length==11)
				{
					if(res[4]==1)
//					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/n/'+res[2]+'/a/'+res[5];
					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/n/'+res[2]+'/a/'+res[5]+'/acstatus/'+res[6]+'/decomm/'+res[7]+'/owner/'+res[0]+'/aline/'+res[1]+'/tech/'+res[8]+'/serialNo/'+res[9]+'/videoCap/'+res[10];
					else
//					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/a/'+res[5];
					window.location.href =url+'/kw/'+keyword+'/tail/'+res[3]+'/a/'+res[5]+'/acstatus/'+res[6]+'/decomm/'+res[7]+'/owner/'+res[0]+'/aline/'+res[1]+'/tech/'+res[8]+'/serialNo/'+res[9]+'/videoCap/'+res[10];
				
				}
				else
				{
					if(document.getElementById('nose'))
						document.getElementById('nose').innerHTML="";
					if(document.getElementById('serial_No'))
						document.getElementById('serial_No').innerHTML="";
					if(document.getElementById('aircraft'))
						document.getElementById('aircraft').innerHTML="";
					if(document.getElementById('technology'))
						document.getElementById('technology').innerHTML="";
					if(document.getElementById('videoCap'))
						document.getElementById('videoCap').innerHTML="";
					if(document.getElementById('acstatus'))
						document.getElementById('acstatus').innerHTML="";
					if(document.getElementById('decomm'))
						document.getElementById('decomm').innerHTML="";
					var count=res.length-1;
					for (i = 1; i <= count; i++)
					{
						var aline = null;
						if(i==4){
							aline = res[i-4].replace(/ /g,"+");
							
							//document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'>'+res[i-1]+'</a>';			 
							document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'/acstatus/'+res[i+1]+'/decomm/'+res[i+2]+'/tech/'+res[i+3]+'/owner/'+aline+'/aline/'+res[i-3]+'/serialNo/'+res[i+4]+'/videoCap/'+res[i+5]+'>'+res[i-1]+'</a>'; 
							var a=i;
							
						}
						//else if(i==a+5)
						else if(i==a+10){
							aline = res[i-4].replace(/ /g,"+");	
							//document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'>'+res[i-1]+'</a>';
							document.getElementById('page').innerHTML +='<a class="details" href='+url+'/kw/'+keyword+'/tail/'+res[i-1]+'/a/'+res[i]+'/acstatus/'+res[i+1]+'/decomm/'+res[i+2]+'/tech/'+res[i+3]+'/owner/'+aline+'/aline/'+res[i-3]+'/serialNo/'+res[i+4]+'/videoCap/'+res[i+5]+'>'+res[i-1]+'</a>';
							a=i;
						}
					
						//else if(i%5===0)
						else if(i%10===0)
						{
							document.getElementById('page').innerHTML +=" "+res[i-1]+" ";
							document.getElementById('page').innerHTML+='<br>';
						}
						else
						{
							//document.getElementById('page').innerHTML +=res[i-1]+" ";
							document.getElementById('page').innerHTML +=" "+res[i-1]+" ";
							
						}
							
						
					}
					document.getElementById('nose').innerHTML="";
				}		
			}

		});
	},
	 
	methodName: function() {

	}
});
