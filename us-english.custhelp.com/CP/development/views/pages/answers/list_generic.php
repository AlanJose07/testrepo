<style>
	#num_comment li {
		    list-style-type: none;
    margin-bottom: 30px;
    background: none;
    padding: 0;
	}
	#num_comment li .rn_Element1{
		width: 100%;
		font-weight:bold;
		color:#000;
	}
	#num_comment li .rn_Element4{
		display:block;
		width:100%;
	}
	#num_comment li .rn_Element3{
		display:block;
		text-decoration:underline;
		color:#337ab7;
		width:100%;
	}
</style>    <!--testing  -->
<rn:meta title="#rn:msg:FIND_ANS_HDG#" template="standard_ccf.php" clickstream="answer_list" />
	   <rn:widget path="searchsource/SourceProductCategorySearchFilter" filter_type = "categories" source_id ="KFSearch" static_filter="c=#rn:php:$catid#"/>         
