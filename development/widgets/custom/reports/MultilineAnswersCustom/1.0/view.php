<?php /* Originating Release: February 2013 */?>
<?php /* Script to show/hide the answer details on clicking the question (answers retrieved from ajax)*/?>

<div id="test" style="display:block">
 <input type="hidden" value= "<?php echo $this->data['prod']; ?>" id="hiddenprod" name="hiddenprod"/>
</div>


<script type="text/javascript">
function showHideAnswers(m)
{
	  //var nid=((m-2)*10)+3;
	  var nid=(m*10000)+3;
	  var lid=(m*1)+7;
	  
	   var prodid=document.getElementById("hiddenprod").value;

	  if(document.getElementById(nid).style.display =="block")
	  {
		  document.getElementById(nid).style.display = 'none';
		  document.getElementById(lid).className = 'arrow';
	  }
	  else
	  {
		document.getElementById(nid).style.display = 'block';
		document.getElementById(lid).className = 'minusarrow';
		var xmlhttp;
        if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
        else
		{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
        xmlhttp.onreadystatechange=function()
        {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		
         // document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		 
        }
        }
		
		var params = "a_id="+m;
     	xmlhttp.open("POST","/cc/ajaxCustom/set_answer_view/",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xmlhttp.send(params);
		
		if(prodid!=false)
		{
		var xmlhttp;
        if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		}
        else
		{// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
       
	   
	    xmlhttp.onreadystatechange=function()
        {
         if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
		
         // document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
		 
        }
        }
		
		var params = "a_id="+m+"&prodid="+prodid; 
     	xmlhttp.open("POST","/cc/ajaxCustom/set_answer_viewbyprod/",true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        xmlhttp.send(params);
		
		}
		
		
	 }	 
}
<?php /* End of script*/?>
</script>
<div id="rn_<?=$this->instanceID;?>" class="<?= $this->classList ?>">
    <rn:block id="top"/>
    <div id="rn_<?=$this->instanceID;?>_Alert" role="alert" class=""></div>
    <rn:block id="preLoadingIndicator"/>
    <div id="rn_<?=$this->instanceID;?>_Loading"></div>
    <rn:block id="postLoadingIndicator"/>
    <div id="rn_<?=$this->instanceID;?>_Content" class="rn_Content">
        <rn:block id="topContent"/>
      
        <? if (is_array($this->data['reportData']['data']) && count($this->data['reportData']['data']) > 0): ?>
        <rn:block id="preResultList"/>
        <? if ($this->data['reportData']['row_num']): ?>
            <ol start="<?=$this->data['reportData']['start_num'];?>">
        <? else: ?>
            <ul>
        <? endif; ?>
        <rn:block id="topResultList"/>
        <? $md=0;
		 $reportColumns = count($this->data['reportData']['headers']);
           foreach ($this->data['reportData']['data'] as $value): ?>
           <rn:block id="resultListItem">
            <li class="arrow" id="list_<?=$md;?>">
                <span id="qst_<?=$md;?>" class="rn_Element1"><?=$value[0];?></span> <!-- Appending the dynamic variable to the id of the question  -->
				<div class="rn_ans_div" id="ans_<?=$md;?>">  <!-- Appending the dynamic variable to the id of answer and adding a class to hide the answer details-->
                <? if($value[1]): ?>
				<span class="rn_Element2"><?=$value[1];?></span>
                <div class="lines"></div>
                <? endif; ?> 
				
                <span class="rn_Element3"><?=$value[2];?></span>
                <? for ($i = 3; $i < $reportColumns; $i++): ?>
                    <? $header = $this->data['reportData']['headers'][$i]; ?>
                    <? if (!array_key_exists('visible', $header) || $header['visible'] === true): ?>
                    <span class="rn_ElementsHeader"><?=(($this->data['reportData']['headers'][$i]['heading']) ? ($this->data['reportData']['headers'][$i]['heading'] . ': ') : '');?></span>
                    <span class="rn_ElementsData"><?=$value[$i];?></span>
                    <? endif; ?>
                <? endfor; ?>
				
				</div>
				<input type="hidden" id="get_ans_<?=$md;?>" value="<?=$value[3];?>"/>
				 </li>
				 <? $md++; ?>
            </rn:block>
			
        <? endforeach; ?>
        <rn:block id="bottomResultList"/>
        <? if ($this->data['reportData']['row_num']): ?>
            </ol>
        <? else: ?>
            </ul>
        <? endif; ?>
        <rn:block id="postResultList"/>
        <? endif; ?>
        <rn:block id="bottomContent"/>
    </div>
    <rn:block id="bottom"/>
</div>
