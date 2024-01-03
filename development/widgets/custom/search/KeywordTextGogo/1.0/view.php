<script src="js/jquery.min.js"></script>
<script src="js/html5placeholder.js"></script>
<?php /* Originating Release: February 2013 */?>

<div id="rn_<?=$this->instanceID;?>" class="rn_KeywordText">
    <rn:block id="top"/>
    <label for="rn_<?=$this->instanceID;?>_Text"><?=$this->data['attrs']['label_text'];?></label>
    <rn:block id="preInput"/>
	<?php if( $this->data['clang']=="ko_KR" && $this->data['flgtNo']=="DAL"){?>
	  <input id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" maxlength="255" value="<?=$this->data['js']['initialValue'];?>" placeholder="검색."/>
	 
	  <?php }elseif( $this->data['clang']=="ko_KR" && $this->data['flgtNo']=="CPA" && $this->data['ko']==1){?>
	  <input id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" maxlength="255" value="<?=$this->data['js']['initialValue'];?>" placeholder="자주 묻는 질문을 검색합니다"/>
	 
	  <?php }
	   elseif( $this->data['clang']=="de_DE" && $this->data['flgtNo']=="CPA" && $this->data['ge']==1){?>
	  <input id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" maxlength="255" value="<?=$this->data['js']['initialValue'];?>" placeholder="Durchsuchen Sie unsere FAQs"/>
	 
	  <?php }
	  elseif($this->data['flgtNo']=="CPA") {?> 
	  <input id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" maxlength="255" value="<?=$this->data['js']['initialValue'];?>" placeholder="Search our FAQs"/>
	  
	  <?php }  
	   else {?> 
	  <input id="rn_<?=$this->instanceID;?>_Text" name="rn_<?=$this->instanceID;?>_Text" type="text" maxlength="255" value="<?=$this->data['js']['initialValue'];?>" placeholder="Search"/>
	  
	  <?php }   ?> 
	<rn:block id="postInput"/>
    <rn:block id="bottom"/>
</div>







