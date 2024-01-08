<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
<title>Beachbody</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="/euf/assets/themes/responsive/css/coach_consent.css" rel="stylesheet">	
<script src="/euf/assets/themes/responsive/js/jquery_latest.js"></script>
</head>

<body>
<div class="form-main">
<div class="form_table">
<div class="close">X</div>
<?php
		$id = \RightNow\Utils\Url::getParameter('i_id');
		$coach_consent_remove = \RightNow\Utils\Url::getParameter('coach_consent_remove');
		if($id)
		$ref = $this->model('custom/bbresponsive')->FetchRefNo($id);
?>

<?php
		if($id)
		{
			if($coach_consent_remove){
?>
<div class="success-txt">Thank you! You have successfully removed the authorized party on your account.</div>
<div id="extraInfo"> <span>Reference #: <?php echo $ref; ?></span>
<br />
<br />
<span><a href="/app/coach_consent_form">Click to go back to the form to add an authorized party on your account</a></span>
</div>
<?php    }else{
?>
<div class="success-txt">Thank you! Your Consent update has been Completed.</div>
<div id="extraInfo"> <span>Reference #: <?php echo $ref; ?></span></div>
<? }
		}
		else
		{ 
?>
<div class="success-txt">Something went wrong. Please try again.</div>

<? 
		} 
?>
</div>
</div>
 
<script>
$(".close").on('click', function() { 
window.location.href = '/app/home'; 
})
</script> 
</body>
</html>
