<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------The below script is very important. In order to get the the top level category id and its name, an hideen field is set in the bbresponsive template. Initialy will assign the value through the URL that is the URL of the primary categories. This URL parameter is called TLP, which will set in the hidden field then assigned to the variable top_parent_info. This parameter is the used as the value of TLP parameter in the URL other than the URL of primary categories.
**Primary categories==categories of home page and the contact us page.
NOTE:- Here primary categories will not refer to the categories of sublevel pages of home and contactus.  ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<script>
var top_parent_info=document.getElementById("parent_category_id").value;    
console.log(top_parent_info);
</script>



<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                        The above script is described at the top   . ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->


    
	

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The below function is for the home, its sub pages and the page navigate to the answer detail ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<? function home_display_category_details($item){?>


<? /*$ca_lookup=stripcslashes(str_replace("-"," ",str_replace("_","/",trim($item["category_name"])))); CC-4412(Hyphen Deffect)*/ ?>   
<? $ca_lookup=stripcslashes(trim($item["category_name_with_hyphen"])); ?>

<? if($item["answer_report"]=="0"):?>

		
<? if($item['visible_on_page_id']=="1"):?>  

 
<a onclick="document.location='/app/gethelp/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/<?= $item["category_id"]?>.<?= $item["category_name"]?>';click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);">
<li><?= $ca_lookup ?></li>
</a>


   
<? else:?><!-- else condition when visible on page id is not equal to 1-->


<a onclick="document.location='/app/gethelp/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/'+top_parent_info;click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);">
<li><?= $ca_lookup ?></li>
</a>
   

<? endif;?><!-- if condition when visible_on_page_id==1-->

		
<? endif;?><!-- End of if condition when answer_report==0-->

			
<? if($item["answer_report"]!="0") :?>           

<? if(($item['url_recommended'] == 1 && !empty($item['URL'])) || ($item['url_recommended'] == 3 && !empty($item['URL']))):?> <!-- if condition for URL not empty--> 

<a href="<? echo $item['URL']; ?>" onclick="click_tracking('Direct URL - Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" target="_blank" ><li><?= $ca_lookup ?></li></a>

<? else: ?>	 <!-- else condition for URL not empty--> 			
		
<? if($item['visible_on_page_id']=="1"):?>


<a onclick="document.location='/app/answers/detail/a_id/<?= $item["answer_report"]?>/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/'+top_parent_info;click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);"><li><?= $ca_lookup ?></li></a>


<? else:?><!-- else condition when visible_on_page_id not equal to 1-->


<a onclick="document.location='/app/answers/detail/a_id/<?= $item["answer_report"]?>/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/'+top_parent_info;click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);"><li><?= $ca_lookup ?></li></a>

 
<? endif;?><!-- if condition when visible_on_page_id==1-->

<? endif;?><!-- end condition for URL not empty--> 
			
<? endif;?><!-- End of if condition when answer_report!=0-->


<? }?>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The above function is for the home, its sub pages and the page navigate to the answer detail ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The below function is for the contactus, its sub pages and the page navigate to the contact us support ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<? function contactus_display_category_details($item){?>

<? /* $ca_lookup=stripcslashes(str_replace("-"," ",str_replace("_","/",trim($item["category_name"])))); */ ?>
<? $ca_lookup=stripcslashes(trim($item["category_name_with_hyphen"])); ?>


<? if(($item["DirectlyRTM"]=="null") and ($item["SelfServiceForm"]=="null") and ($item["AgentChat"]=="null") and ($item["Email"]=="null") and ($item["Phone"]=="null") and ($item["Facebook"]=="null") and ($item["text"]=="null")) :?>


<? if($item['visible_on_page_id']=="3"):?>


<a onclick="document.location='/app/contactus_sub_level/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/<?= $item["category_id"]?>.<?= $item["category_name"]?>';click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);">
<li><?= $ca_lookup ?></li>
</a>


<? else:?><!-- else condition for the visible on page not equal to 3 and no channel is present--> 


<a onclick="document.location='/app/contactus_sub_level/catid/<?= $item["category_id"]?>/catnme/<?= $item["category_name"]?>/TLP/'+top_parent_info;click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);"><li><?= $ca_lookup ?></li></a>


<? endif;?><!-- end if condition for the visible on page id==3 and no channel is present-->

    
<? else:?> <!-- else if there is any channel...that is subcategory not present and redirect to contactus_support page-->

<? if(($item['url_recommended'] == 1 && !empty($item['URL'])) || ($item['url_recommended'] == 3 && !empty($item['URL']))):?> <!-- if condition for URL not empty-->

<a href="<? echo $item['URL']; ?>" onclick="click_tracking('Direct URL - Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" target="_blank"><li><?= $ca_lookup ?></li></a>

<? else: ?>	 <!-- else condition for URL not empty--> 
	
<? if($item['visible_on_page_id']=="3"):?>	

  

<a onclick="document.location='/app/contactus_support/catid/<?= $item["category_id"]?>/catname/<?= $item["category_name"] ?>/a_id/<?= $item["answer_report"] ?>/TLP/<?= $item["category_id"]?>.<?= $item["category_name"]?>';click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);"><li><?= $ca_lookup ?></li></a>


<? else:?><!-- else condition for the visible on page not equal to 3 and channel is present-->


<a onclick="document.location='/app/contactus_support/catid/<?= $item["category_id"]?>/catname/<?= $item["category_name"] ?>/a_id/<?= $item["answer_report"] ?>/TLP/'+top_parent_info;click_tracking('Category Tiles - <?= $item["category_name"]?>',<?= $item["category_id"]?>)" href="javascript:void(0);"><li><?= $ca_lookup ?></li></a>

	 
<? endif;?><!-- end condition for the visible on page id==3 and channel is present--> 

<? endif;?><!-- end condition for URL not empty--> 
   
<? endif;?><!-- If there is no any channel...that is onlyu sub category is present-->

<? }?>


<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                 The above function is for the contactus, its sub pages and the page navigate to the contact us support ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The below div class="row" will display the category tiles when number of categories are 9 or 6 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	
<? $title=0; ?>
<? $subtitle=0; ?>
<? $clickedtilenamecount=0;?>

<section>
<div class="container">
<div class="row">
<div class="get-help">
<? for($i = 0; $i < count($this->data["attrs"]["category_details"]); $i++) : ?>


		<? $item = $this->data["attrs"]["category_details"][$i];?>
		
		<? /*$ca_lookup=str_replace("-"," ",str_replace("_","/",trim($item["category_name"]))); */?>
		<? $ca_lookup = trim($item["category_name_with_hyphen"]);?>

		<? if($item['visible_on_page_id']=="1" || $item['visible_on_page_id']=="2") :?> 
		
		
				<? if($item['visible_on_page_id']=="1" and $title==0) :?>
						<h1>Browse FAQs by Topic</h1>
						<? $title++;?>
						
				<ul class="boxes-3">
						
				<? endif;?>
				
				<? if($item['visible_on_page_id']=="2" and  $subtitle==0) :?> 
				<? $subtitle++;?>	
				<ul class="boxes-2">
						
				<? endif;?>
						
				<? home_display_category_details($item);?>
				
				
		
		<? endif;?>   
				
		
		<? if($item['visible_on_page_id']=="3" || $item['visible_on_page_id']=="4") :?>
		
		
				<? if($item['visible_on_page_id']=="3" and $title==0) :?>
				
				<h1 class="contact-title"><?php echo $this->data['attrs']['contactus_topic'];?></h1> 
				<h4 class="contact-title"><?php echo $this->data['attrs']['contactus_text'];?></h4> 
				<? $title++;?>
				
				<ul class="boxes-3 ca-contact">
				
				<? endif;?>
				
				<? if($item['visible_on_page_id']=="4" and  $subtitle==0) :?> 
				<? $subtitle++;?>		
				<ul class="boxes-2 contactus-sub cat-display-scroll">
						
				<? endif;?>
				
		        <? contactus_display_category_details($item);?> 
				
				
		<? endif;?>
		
		
<? endfor; ?> 

</ul>



<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The above div class="row" will display the category tiles when number of categories are 9 or 6 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The below code will display the category tiles when number of categories are '<' or '>' than 9 or  '<' or '>'6 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->



<? if(count($this->data['attrs']['more_category_details'])>0):?>


	<div id="parent_more" class="more_categ_display">
		
		
		<div id="more_link_categories" style="display:none;">      
		
		        <section>
				<div class="container">
				<div class="row">
				<div class="get-help inner-more-cat">
				<? $more_count=0; ?>
				
				<? for($i = 0; $i < count($this->data["attrs"]["more_category_details"]); $i++) : ?>
				
				
						<? $item = $this->data["attrs"]["more_category_details"][$i];?>
						
						<? if($item['visible_on_page_id']=="1" || $item['visible_on_page_id']=="2") :?>
						
						<? if($item['visible_on_page_id']=="1" and $more_count==0) :?> 
						<ul class="boxes-3">
						<? endif;?>
						
						<? if($item['visible_on_page_id']=="2" and $more_count==0) :?> 
						<ul class="boxes-2">
						<? endif;?>  
						
						<? home_display_category_details($item);?>
						<? $more_count++;?>
						<? endif;?>
								
						<? if($item['visible_on_page_id']=="3" || $item['visible_on_page_id']=="4") :?> <!-- if the tile is in contactus page -->
						
						
						<? if($item['visible_on_page_id']=="3" and $more_count==0) :?> 
						<ul class="boxes-3">
						<? endif;?>
						
						<? if($item['visible_on_page_id']=="4" and $more_count==0) :?> 
						<ul class="boxes-2">
						<? endif;?>  
						
						<? contactus_display_category_details($item);?>
						<? $more_count++;?>
						<? endif;?>
						
						
				<? endfor; ?> 
		        </ul>
				</div>
				</div>       
				</div>
				</section>
		
		</div>
		
		<?  $id = "rn_{$this->instanceID}_0";?>
		
		<div id="more_link"><a  href="javascript:void(0);" id="<?= $id;?>">More Categories</a></div>
		
		
	</div>
		
		
<? endif; ?>

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The above code will display the category tiles when number of categories are '<' or '>' than 9 or  '<' or '>'6 ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The below code will display the most popular answer link if the selected category or subcategory contains[For US only] ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

 
 
<? if($this->data['attrs']['page']=="2"  and $this->data['attrs']['interface']=="38") :?>

 
		<? $categ_id=$this->data['categ_id']; ?>
		<? $cat_id_name=$this->data['categ_id'].".".$this->data['cat_nme'];?>
		<rn:widget path="custom/ResponsiveDesign/Popular_answer_count" static_filter="c=#rn:php:$cat_id_name#" report_id="199430"/> 

  
<? endif;?>
   
 



<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                The above code will display the most popular answer link if the selected category or subcategory contains ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------                                                                        by jithin jose ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

        





</div>
</div>
</div>
</section> 
 






