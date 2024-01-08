<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>


<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<? if($this->data['flag']): ?>
<? if($this->data['resultData']['enable']): 
   $cookiename = "popupclosecookie".$this->data['resultData']['cookie_id'];
?>
<? if(!$_COOKIE[$cookiename]): ?>
<div id="myModal1" class="modal View_Modal pop-modal messagepopupclose" style="display:block"> 

<?php
	$result = $this->data['resultData'];
	$image_ext = 'jpeg';
	if(strpos($result['Image_type'],"jpeg"))
	$image_ext = 'jpeg'; 
	elseif(strpos($result['Image_type'],"jpg"))
	$image_ext = 'jpeg'; 
	elseif(strpos($result['Image_type'],"png"))
	$image_ext = 'png'; 
	//echo "<pre>";
	//print_r($result);

?>
 
  <div class="modal-content Bb_modal">
  	<div class="model-inner">
    <span class="close" id="orderClose1" >X</span>
	 <div class="cmp_logo"><img src="/euf/assets/images/beachbody_logo_site.png"></div>
	<div id="headingOrder"></div>    
	
	 <div class="info-text" id="odrSub"  style="display:block; visibility:visible">
	 
	 <? if($result['title_text']): ?>
	 <p style="
	 font-size: 21px;
     font-weight: 600;
     color: #999999;">
	 <?php echo $result['title_text']; ?>
	 </p>
	 <? endif; ?>
	 
	 <? if($result['content_text']): ?>
	 <p style="font-size: 16px;">
	 <?php echo $result['content_text']; ?>
	 </p>
	 <? endif; ?>
	 
	 <? if($result['link_label']): ?>
	 <p>
	 <a href="<?php echo $result['link_url'];?>" target="_blank"><?php echo $result['link_label'];?> <i class="fa fa-angle-right"></i></a>
	 </p>
	 <? endif; ?>
	 
	 <? if($result['Url']): ?>
	 <p>
	 <img src="data:image/<?= $image_ext?>;base64, <?php echo $result['Url']; ?>"  style="width: 85%;"/>
	 </p>
	
	 <? endif; ?>
	 
	 
	 </div> 
	 
		
  </div>
</div>

<? else: ?>

<? $this->data['resultData']['enable'] = false; ?>


</div>
<? endif; ?>

<? endif; ?>

<? endif; ?>

</div>
