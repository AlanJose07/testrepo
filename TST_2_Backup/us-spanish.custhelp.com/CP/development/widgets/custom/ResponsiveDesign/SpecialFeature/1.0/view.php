<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">

<?php
foreach($this->data['resultData'] as $result)
{

 $image_ext = 'jpeg';
 if(strpos($result['Image_type'],"jpeg"))
 	$image_ext = 'jpeg'; 
 elseif(strpos($result['Image_type'],"jpg"))
 	$image_ext = 'jpeg'; 
 elseif(strpos($result['Image_type'],"png"))
 	$image_ext = 'png'; 			
?>

<?php

	if(($result['Position'] == "left")||($result['Position'] == "right"))
	{
	?>
<section>
    <div class="container">
      <div class="row">
        <div class="shake-desc">
		<?php
	if($result['Position'] == "left")
	{
?>
          <div class="shake-desc-sec1">
            <div class="shake-desc-left-1">
			<img src="data:image/<?= $image_ext?>;base64, <?php echo $result['Url']; ?>"  />
			</div>
            <div class="shake-desc-right-1">
              <h2><?php echo $result['Title'];?></h2>
              <p><?php echo $result['Desc'];?></p>
              <a href="<?php echo $result['Link_Url'];?>" onclick="click_tracking('Try - <?= $result['Title']?>')"><?php echo $result['Link_Label'];?> <i class="fa fa-angle-right"></i></a> </div>
          </div>
          
<?php
	}
	else if ($result['Position'] == "right")
	{
	?>
	<div class="shake-desc-sec2">
            <div class="shake-desc-left-2">
              <h2><?php echo $result['Title'];?></h2>
              <p><?php echo $result['Desc'];?></p>
              <a href="<?php echo $result['Link_Url'];?>" onclick="click_tracking('Try - <?= $result['Title']?>')"><?php echo $result['Link_Label'];?> <i class="fa fa-angle-right"></i></a> </div>
            <div class="shake-desc-right-2">
			<img src="data:image/<?= $image_ext?>;base64, <?php echo $result['Url']; ?>"  />
			</div>
          </div>
	<?php
	}
	
	?>
	
        </div>
      </div>
    </div>
  </section>
	<?php
	
	}
	else if ($result['Position'] == "middle")
	{
	?>
  <div class="divider"></div>
  <section>
    <div class="container">
      <div class="row">
        <div class="shake-desc">
          <div class="shake-desc-sec3">
            <div class="shake-desc-left-3">
			<img src="data:image/<?= $image_ext?>;base64, <?php echo $result['Url']; ?>"  />
			</div>
            <div class="shake-desc-right-3">
              <h2><?php echo $result['Title'];?></h2>
              <p><?php echo $result['Desc'];?></p>
              <a href="<?php echo $result['Link_Url'];?>" onclick="click_tracking('Try - <?= $result['Title']?>')"><?php echo $result['Link_Label'];?> <i class="fa fa-angle-right"></i></a> </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
	<?php
	}
	else
	{}
}
?>
  
</div>