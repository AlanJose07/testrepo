RightNow.namespace('Custom.Widgets.ResponsiveDesign.ChannelDisplayAnswer');
Custom.Widgets.ResponsiveDesign.ChannelDisplayAnswer = RightNow.Widgets.extend({ 
    /**
     * Widget constructor...
     */
    constructor: function() {
		
		this.answer_count = this.data.js.answer_details_count;
		
		for(var i=0;i<this.answer_count;i++)
		{
			var id="#open-answer-tag_"+i;//this.baseSelector+"_"+i; //changed the element for which click was registered to.. so that the expand/collapse symbol on the left is also clickable
			this.input = this.Y.one(id);
			this.input.on("click", this.showHideAnswer, this, i);
		}
		
		
    },

    /**
     * Sample widget method.
     */
	showHideAnswer: function(type, i) {
		
		if(i==0)
		{
			//$('#open-answer-tag').addClass('open-tag');
			
			if(document.getElementById("solution_"+i).style.display == "block")
			{
				
			   document.getElementById("solution_"+i).style.display = "none";
			   $('#open-answer-tag_'+i).removeClass('open-tag');
			   $('#open-answer-tag_'+i).addClass('close-tag');
			}
			else
			{
				
			   document.getElementById("solution_"+i).style.display = "block";
			   $('#open-answer-tag_'+i).addClass('open-tag');
			   $('#open-answer-tag_'+i).removeClass('close-tag');
			  
			}
			
			for(var p=i+1;p<this.answer_count;p++)
			{
				
			   document.getElementById("solution_"+p).style.display = "none";
			    $('#open-answer-tag_'+p).addClass('close-tag');
				$('#open-answer-tag_'+p).removeClass('open-tag');
			}
			
		}
		else
		{
			
			if(document.getElementById("solution_"+i).style.display == "block")
			{
			   document.getElementById("solution_"+i).style.display = "none";
			   $('#open-answer-tag_'+i).removeClass('open-tag');
			   $('#open-answer-tag_'+i).addClass('close-tag');
			}
			else
			{
			   document.getElementById("solution_"+i).style.display = "block";
			   $('#open-answer-tag_'+i).addClass('open-tag');
			   $('#open-answer-tag_'+i).removeClass('close-tag');
			}
			
			for(var j=i-1;j>=0;j--)
			{
			   document.getElementById("solution_"+j).style.display = "none";
			   $('#open-answer-tag_'+j).removeClass('open-tag');   
			   $('#open-answer-tag_'+j).addClass('close-tag');
			}
			
			for(var k=i+1;k<this.answer_count;k++)
			{
			   document.getElementById("solution_"+k).style.display = "none";
			   $('#open-answer-tag_'+j).removeClass('open-tag');   
			   $('#open-answer-tag_'+j).addClass('close-tag');
			}
		}
		
	}
});