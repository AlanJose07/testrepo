<?php 
if($this->data['Message'] !="")
{
?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>" style="display:block">

 <div class="message">
      <div class="message-text">
        <?= $this->data['Message'] ?>
      </div>
      <div class="message-close">
        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
    <path fill="#000000" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
</svg>
      </div>
    </div>
</div>
<?php
}
?>
<script type="text/javascript">

</script>
<!--<script type="text/javascript">
try
{
	$('.message-close').on('click', function(e) {
	  $('.message').hide();//addClass('close');
	  try
	  {
	  	sessionStorage.setItem("service_alert_session","2");
		var ss = sessionStorage.getItem("service_alert_session");
	  	//document.getElementById('sa_session_val').value = 2;
	  }
	  catch(err_inner)
	  {}
	})
}
catch(err)
{

}
</script> 
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<script>
		$('.message-close').on('click', function(e) {
		alert("hi");
		  $('.message').addClass('close');
		})
		
		$('button').on('click', function() {
		alert("heyyy");
		  $('.message').removeClass('close');
		})
</script>-->