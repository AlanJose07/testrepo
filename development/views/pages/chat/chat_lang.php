<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_request"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<script src="js/jquery.min.js"></script>
<div style="width:100%; padding-top:10px;"> <span class="rn_ChatLaunchFormHeader"> </span> <br/>
  <br/>
</div>
<div class="main-container-chat options">
  <div id="rn_PageContent" class="rn_Live">
    <div class="rn_Padding" >
      <rn:condition chat_available="true">
        <div id="rn_ChatLaunchFormDiv" class="rn_ChatForm">
          <div id="ChatForm" style="margin-top:20px;">
            <?php
			$CI = get_instance();
			if(getUrlParm('ge')!=1 && getUrlParm('ko')!=1)
			 { 
			 
			 $newurl="app/chat/chat_launch".$CI->session->getSessionData('enc_str');
			 
			header("Location:https://custhelp.gogoinflight.com/".$newurl);
	 		}
             
 			 $sid=$CI->session->getSessionData('sessionID');
			 
			if(getUrlParm('ko')==1)
			{?>
            <label>사용 가능한 언어를 선택하십시오.</label>
			<br />
			<br />
			  <input type="radio" name="lang" value="English" onClick="JavaScript:radio_input('https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'en_US',$CI->session->getSessionData('enc_str'));?>')"> 영어<br>
			  <input type="radio" name="lang" value="Simplified Chinese" onClick="JavaScript:radio_input('https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'zh_CN',$CI->session->getSessionData('enc_str'));?>')"> 중국어 간체<br>
			  <input type="radio" name="lang" value="Traditional Chinese" onClick="JavaScript:radio_input('https://custhelpyue.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'zh_TW',$CI->session->getSessionData('enc_str'));?>')"> 중국어 번체
			 
              <br />
              <br /><?php }
			  if(getUrlParm('ge')==1) { ?>
			 <label>Bitte wählen Sie die verfügbare Sprache</label>
			<br />
			<br />
			  <input type="radio" name="lang" value="English" onClick="JavaScript:radio_input('https://custhelp.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'en_US',$CI->session->getSessionData('enc_str'));?>')"> Englisch<br>
			  <input type="radio" name="lang" value="Simplified Chinese" onClick="JavaScript:radio_input('https://custhelpcmn.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'zh_CN',$CI->session->getSessionData('enc_str'));?>')"> Vereinfachtes Chinesisch<br>
			  <input type="radio" name="lang" value="Traditional Chinese" onClick="JavaScript:radio_input('https://custhelpyue.gogoinflight.com/app/<?php echo $switch_interface,str_replace(['en_US','fr_FR','ja_JP','ko_KR','zh_TW','zh_CN','de_DE'],'zh_TW',$CI->session->getSessionData('enc_str'));?>')"> Traditionelles Chinesisch
			 
              
              <br />
              <br /> <?php }?>
            </form>
          </div>
        </div>
      </rn:condition>
     
    </div>
  </div>
</div>
<script type="text/javascript">
function radio_input(url)
{
var res = url.replace("chat_lang","chat_launch");
window.location.href =res;
}
</script>

