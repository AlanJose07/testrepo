<style>
/*.fb-send-to-messenger {
  margin-left: 90px;
}*/

</style>
<?php
$CI = get_instance();
$uriSegments = $CI->uri->uri_to_assoc($CI->config->item('parm_segment'));
$contextId = $uriSegments['contextId'];
$facebookPageId = $uriSegments['facebookPageId'];
$facebook_app_id = \RightNow\Utils\Config::getConfig(1000049);  //CUSTOM_CFG_FACEBOOK_APP_ID
$facebookAppId = $facebook_app_id;
//$facebookAppId = '110100299485445';
//$facebookPageId = '2102715376480453';
?>

<HTML>
<HEAD>
  
  <link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />  
  <link href="/euf/assets/themes/responsive/css/fb_styles.css" rel="stylesheet">
  <style>
    .text-block{
      text-align: left;      
	  margin-right: auto;
    }    
   
  </style>
</HEAD>
<BODY>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId            : '<?php echo $facebookAppId;?>',
    autoLogAppEvents : true,
    xfbml            : true,
    version          : 'v3.2'
  });

 };
 
 
  $(document).ready(function(){ 
    var windowWidth = $(window).width(); //alert(windowWidth);
    var blockwidth =  $('.text-block').width(); 
	//alert(windowWidth);
     $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px'); 
     if ($(window).width() < 1024 && $(window).width() >767){ 
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      }  
     if ($(window).width() < 767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      }    
	 
	  if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }    
          
  });
  $(window).resize(function(){
     var windowWidth = $(window).width(); //alert(windowWidth);
	// alert(windowWidth);
      $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px');
      if ($(window).width() < 1024 && $(window).width() >767) {
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      } 
      if ($(window).width() < 767) {
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      }
      if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }
	  
    });
  $(window).on('load', function(){
     var windowWidth = $(window).width(); //alert(windowWidth);
	// alert(windowWidth);
      $('.text-block').css('margin-left', windowWidth / 2 - 73 + 'px');
      if ($(window).width() < 1024 && $(window).width() >767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 263 + 'px');
      } 
      if ($(window).width() < 767) { 
        $('.text-block').css('margin-left', windowWidth / 2 - 74 + 'px');
      } 
	  if ($(window).width() == 768) { 
        //$('.text-block').css('margin-left', 289 + 'px');
      }     
    });
	

</script>

<script>

FB.Event.subscribe('send_to_messenger', function(e) {
    // callback for events triggered by the plugin
    console.log(e);
    if (e.event === 'opt_in') {
		var page_url = String(window.location.href);
		var exploded_url = page_url.split('/');
		var ref_no_index = exploded_url.indexOf('ref_no');
		ref_no = exploded_url[ref_no_index+1];
		$.ajax({
		   url: '/cc/bbresponsivecontroller/fb_status_update',  
		   data:  {ref_no: ref_no},
		   async:true,
		   dataType: "json", 
		   type: "POST",
			  success: function(data) {    
			 ajaxResult=data;
			}
			  
			}); 
        setTimeout(redirectToMessenger, 1000);
    }
});
 
function redirectToMessenger() {
    window.location = "http://m.me/<?php echo $facebookPageId?>";
}


</script>

    
<div class="page-holder">
  <div class="holder">
    <div class="image-holder">
      <img src="/euf/assets/images/mobile-icons/fb.jpg">
      <p class="f-24"></p>
      <p class="p-6"></p>
      <p class="p-3"></p>
    </div>
	
    <div class="text-block">      
      <div class="fb-wrapper">
          <div class="fb-send-to-messenger" messenger_app_id="<?php echo $facebookAppId; ?>" page_id="<?php echo $facebookPageId;?>" data-ref="<?php echo $contextId;?>" color="blue" size="xlarge" cta_text="MESSAGE_ME">
      </div>
     
	  <div>
    </div>
  </div>
</div>

 

</BODY>
</HTML>