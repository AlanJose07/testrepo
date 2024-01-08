
<?
$CI = &get_instance();
$catid= getUrlParm('catid');
$incidentid = getUrlParm('incidentid');
$fname =  urldecode(getUrlParm('fname'));
$lname =  urldecode(getUrlParm('lname'));
$thread = urldecode(getUrlParm('incidentquery'));
$chatskill = getUrlParm('skillid');
$nice_chat_poc = \RightNow\Utils\Config::getConfig(1000066); //CUSTOM_CFG_NICE_CHAT_POC
$nice_chat_poc = trim($nice_chat_poc);
$thread  = urlencode(htmlspecialchars_decode($thread, ENT_QUOTES) );
$fname = urlencode(htmlspecialchars_decode($fname, ENT_QUOTES) );
$lname = urlencode(htmlspecialchars_decode($lname, ENT_QUOTES) );
?>
<script src="/euf/assets/themes/responsive/js/jquery.min.js"></script>
<script>
try{
	if(parent.window.opener != null && !parent.window.opener.closed)
	{
	  //parent.window.opener.location = 'https://faq.beachbody.com/app/home';//test1();
	  parent.window.opener.location.replace("/app/home");
	}

}catch(e){ alert(e.description);} 
</script>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>#rn:msg:LIVE_ASSISTANCE_LBL#</title>
	<link rel="icon" type="image/png" sizes="16x16"  href="/euf/assets/themes/mobile/images/BB_Support_Stacked_192x192_Blue.png">
    <style>
	*{box-sizing: border-box;}
     body.chatnody {
  background: #9E9E9E !important;
  overflow: hidden;
}

.card-headercont {
  background: #0076d6;
  height: 40px !important;
  padding: 5px 15px 3px 15px !important;
}
.pagecontainer-screen-chat {
  max-width: 540px;
  margin: 15px auto 0;
  background: #fff;
  min-width: 300px;
  /* height: calc(100vh - 20px); */
}
.chatwindowcontainre{
    /* background: #cccccc; */
     max-height: calc(100vh - 78px);
      overflow: auto;
      line-height: 0;
	  width: 100%;
	  text-align: center;
	  /*padding-left: 16px;*/
}
.iframeclass{
    height: 600px;
    /*width: 510px;*/
	width: 100%;
    margin: 0;
    border: 0;
}
@media only screen and (min-device-width: 1048px){
.container{
	    min-width: 0 !important;
}
}
@media only screen and (min-width : 768px) and (max-width : 1024px) {
  .pagecontainer-screen-chat {
      /*width: 60%*/
  }
}

@media only screen and (max-width:768px) {
  .pagecontainer-screen-chat {
      /*width: 90% !important;*/
  }

}
    </style> 
</head>
<body>
<?
if($CI->session->getSessionData('ischatconnected')=='true'){
	$CI->session->setSessionData(array('ischatconnected' => 'false'));
	//https://home-c35.nice-incontact.com/inContact/ChatClient/ChatClientPatron.aspx?poc=e0e48023-9106-4a92-b8a9-3919bd71c4cb&bu=4599337
?>
<div class="pagecontainer-screen-chat"> 
        <div class=card-headercont>
            <img src="/euf/assets/themes/responsive/images/logo.png" style="
    width: 30px;
">
        </div>
        <div class="chatwindowcontainre">
            <iframe src="https://home-c35.nice-incontact.com/inContact/ChatClient/ChatClient.aspx?poc=<?php echo $nice_chat_poc;?>&bu=4599337&p1=<?php echo $incidentid;?>&p2=<?php echo $catid;?>&p3=<?php echo $chatskill;?>&p4=<?php echo $fname;?>&p5=<?php echo $lname;?>&p6=<?php echo $thread;?>" class="iframeclass"></iframe>
        </div>
    </div>

<? }else{
header("Location: /app/home");
}?>

</body>
</html>
