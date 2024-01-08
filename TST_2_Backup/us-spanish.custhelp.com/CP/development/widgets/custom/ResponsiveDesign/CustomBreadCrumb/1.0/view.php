
<?php

		//ANSWER ID
				
		$answer_Id_first=$this->data["js"]["answerid_first"];
		$answer_Id_second=$this->data["js"]["answerid_second"];
		$answer_Id_third=$this->data["js"]["answerid_third"];
		$answer_Id_fourth=$this->data["js"]["answerid_fourth"];
		$answer_Id_fifth=$this->data["js"]["answerid_fifth"];
		$answer_Id_sixth=$this->data["js"]["answerid_sixth"];
		
		$tileText=$this->data["js"]["tlp"];
		
		$tileTextVar="/TLP/".$tileText;
		
		$mostPopularAnswersLabel="";
		$chat="";
		
		//Remove this in cotroller also after checking this in Pagination
		//=========================REMOVE==================================
		$answerIdFirst="/ans_id/$answer_Id_first";
		$answerIdSecond="/ans_id/$answer_Id_second";
		$answerIdThird="/ans_id/$answer_Id_third";
		$answerIdFourth="/ans_id/$answer_Id_fourth";
		$answerIdFifth="/ans_id/$answer_Id_fifth";
		$answerIdSixth="/ans_id/$answer_Id_sixth";
		
		$answerIdFirst="";$answerIdSecond="";$answerIdThird="";$answerIdFourth="";$answerIdFifth="";$answerIdSixth="";
		//==============================REMOVE ==============================================
		
		
		//BASE LEVEL
		$catId=$this->data["js"]["catid"];
		$catName=$this->data["js"]["catname"];
		$answerid=$this->data["js"]["answerid"];


		//FIRST LEVEL
		$catId_First=$this->data["js"]["category_id_first"];
		$catName_First=$this->data["js"]["category_name_first"];

		//SECOND LEVEL
		$catId_Second=$this->data["js"]["category_id_second"];
		$catName_Second=$this->data["js"]["category_name_second"];

		//THIRD LEVEL
		$catId_Third=$this->data["js"]["category_id_third"];
		$catName_Third=$this->data["js"]["category_name_third"];

		//FOURTH LEVEL
		$catId_Fourth=$this->data["js"]["category_id_fourth"];
		$catName_Fourth=$this->data["js"]["category_name_fourth"];

		//FIFTH LEVEL
		$catId_Fifth=$this->data["js"]["category_id_fifth"];
		$catName_Fifth=$this->data["js"]["category_name_fifth"];
	
		//SIXTH LEVEL
		$catId_Sixth=$this->data["js"]["category_id_sixth"];
		$catName_Sixth=$this->data["js"]["category_name_sixth"];
	//=================================================================
	
		//OTHER VARIABLES 
				
		
		$catNameFirst="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_First)));
				
		$catNameSecond="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_Second)));
				
		$catNameThird="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_Third)));
		
		$catNameFourth="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_Fourth)));
				
		$catNameFifth="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_Fifth)));
				
		$catNameSixth="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName_Sixth)));
		
		$mostpopularCatname="/catnme/".str_replace(" ","-",str_replace("/","_",trim($catName)));
	
	
	
		//CONSTRUCTING LINK URL FROM URL
		
		$uri=$_SERVER['REQUEST_URI']; 

		//ccontactus_support_chat chat		
		if((strpos($uri, "contactus_support_chat" ) !== false) ) :		
				
			$text = str_replace('/app/contactus_support_chat/', '/app/contactus_support/', $uri);		
    		$text = trim($text);		
	        		
			
		     $chat = "chat";		
			$rootPageUrl="/app/contactus/";		
			$rootPageLabel="Contact Us";		
					
			$subPageUrl="/app/contactus_sub_level/catid/";		
					
			//===============REMOVE THIS===================		
			$answerIdFirst="";$answerIdSecond="";$answerIdThird="";$answerIdFourth="";$answerIdFifth="";$answerIdSixth="";		
			//===============================REMOVE=====================
			
		//ccontactus_support_fb facebook
		elseif((strpos($uri, "contactus_support_fb" ) !== false) ) :
		
			$text = str_replace('/app/contactus_support_fb/', '/app/contactus_support/', $uri);
    		$text = trim($text);
	        
	
		     $chat = "messenger";
			$rootPageUrl="/app/contactus/";
			$rootPageLabel="Contact Us";
			
			$subPageUrl="/app/contactus_sub_level/catid/";
			
			//===============REMOVE THIS===================
			$answerIdFirst="";$answerIdSecond="";$answerIdThird="";$answerIdFourth="";$answerIdFifth="";$answerIdSixth="";
			//===============================REMOVE=====================	
		
		//HOME PAGE
		elseif( (strpos( $uri, "home" ) !== false) || (strpos( $uri, "gethelp" ) !== false)  ):
			$rootPageUrl="/app/home/";
			
			//changed by sriram
			//$rootPageLabel="Obtenga respuestas rápidas";
			//$rootPageLabel="Obten Respuestas Rápidas";
			$rootPageLabel="Busca Preguntas Frecuentes por Tema";


			
			$subPageUrl="/app/gethelp/catid/";
			
		//CONTACT US
		elseif( (strpos( $uri, "contactus" ) !== false) || (strpos( $uri, "contactus_sub_level" ) !== false) ) :
		    $rootPageUrl="/app/contactus/";
			//commented by sriram
			//$rootPageLabel="Contáctenos";
			$rootPageLabel="Contáctanos";

			$subPageUrl="/app/contactus_sub_level/catid/";
			
			//===============REMOVE THIS===================
			$answerIdFirst="";$answerIdSecond="";$answerIdThird="";$answerIdFourth="";$answerIdFifth="";$answerIdSixth="";
			//===============================REMOVE=====================
				
		//ANSWERS
		elseif( (strpos( $uri, "answers" ) !== false) ) :
		    $rootPageUrl="/app/home/";
		    //changed by sriram
			//$rootPageLabel="Obtenga respuestas rápidas";
			//$rootPageLabel="Obten Respuestas Rápidas";
			$rootPageLabel="Busca Preguntas Frecuentes por Tema";

			$subPageUrl="/app/gethelp/catid/";
			
			//ANSWER LIST --FOR VIEW MOST POPULAR ANSWER PAGE
			if((strpos( $uri, "list" ) !== false)):
			
			$mostPopularAnswersLabel="<label class='breadcrumb'>Most Popular Answers</label>";
							
			endif;			
						
		else:
		endif;
		
		
	
		//==================================SIXTH LEVEL===============================================
		
		if($catId_Sixth!="" && $catId_Fifth!="" && $catId_Fourth!="" && $catId_Third!="" && $catId_Second!="" && $catId_First!="" 
		&& $catId!=""):
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"><a href="<?=$rootPageUrl?>"> <?=$rootPageLabel?></a></span>  
		
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Sixth.$catNameSixth.$answerIdSixth.$tileTextVar;?>"> <?php echo $catName_Sixth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Fifth.$catNameFifth.$answerIdFifth.$tileTextVar;?>"> <?php echo $catName_Fifth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Fourth.$catNameFourth.$answerIdFourth.$tileTextVar;?>"> <?php echo $catName_Fourth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Third.$catNameThird.$answerIdThird.$tileTextVar;?>"> <?php echo $catName_Third;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Second.$catNameSecond.$answerIdSecond.$tileTextVar;?>"> <?php echo $catName_Second;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a></span> 
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?> 
		
		</div>
		<?php
		
		
		//================================FIFTH LEVEL======================================================
		
		elseif($catId_Fifth!="" && $catId_Fourth!="" && $catId_Third!="" && $catId_Second!="" && $catId_First!="" && $catId!=""):
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="<?=$rootPageUrl?>"> <?=$rootPageLabel?></a></span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Fifth.$catNameFifth.$answerIdFifth.$tileTextVar;?>"> <?php echo $catName_Fifth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Fourth.$catNameFourth.$answerIdFourth.$tileTextVar;?>"> <?php echo $catName_Fourth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Third.$catNameThird.$answerIdThird.$tileTextVar;?>"> <?php echo $catName_Third;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Second.$catNameSecond.$answerIdSecond.$tileTextVar;?>"> <?php echo $catName_Second;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		<span class="breadcrumb"> <a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a> </span>
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>
		</div>
		<?php
		
			 	
		//=======================FOURTH LEVEL===========================================
		
		elseif($catId_Fourth!="" && $catId_Third!="" && $catId_Second!="" && $catId_First!="" && $catId!=""):
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="<?=$rootPageUrl?>"> <?=$rootPageLabel?></a> </span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Fourth.$catNameFourth.$answerIdFourth.$tileTextVar;?>"> <?php echo $catName_Fourth;?> </a> 
		</span> 
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Third.$catNameThird.$answerIdThird.$tileTextVar;?>"> <?php echo $catName_Third;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Second.$catNameSecond.$answerIdSecond.$tileTextVar;?>"> <?php echo $catName_Second;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a></span> 
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>

		</div>
		<?php
		 
		
		//===================THIRD LEVEL=======================================
		
		elseif($catId_Third!="" && $catId_Second!="" && $catId_First!="" && $catId!=""):
		
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"><a href="<?=$rootPageUrl?>"> <?=$rootPageLabel?></a> </span>
				
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Third.$catNameThird.$answerIdThird.$tileTextVar;?>"> <?php echo $catName_Third;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Second.$catNameSecond.$answerIdSecond.$tileTextVar;?>"> <?php echo $catName_Second;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
			
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a></span> 
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>
		
		</div>
		<?php
		
			
		//===================SECOND LEVEL=======================================
		
		elseif($catId_Second!="" && $catId_First!="" && $catId!=""):
		
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="<?=$rootPageUrl?>"><?=$rootPageLabel?></a> </span>
				
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_Second.$catNameSecond.$answerIdSecond.$tileTextVar;?>"> <?php echo $catName_Second;?> </a> 
		</span>
		
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a> </span>
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>
		 </div>
		<?php
			
		//===================FIRST LEVEL=======================================
		
		elseif($catId_First!="" && $catId!=""):
		
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="<?=$rootPageUrl?>"> <?=$rootPageLabel?></a> </span>
				
		<span class="breadcrumb"><a href="<?=$subPageUrl.$catId_First.$catNameFirst.$answerIdFirst.$tileTextVar;?>"> <?php echo $catName_First;?> </a> 
		</span>
		
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a></span> 
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>
		
		</div>
		<?php
		
			
		//===================BASE LEVEL=======================================
		
		else:
		
		if($catName!="")
		{
		?>
		<div class="breadcrumb-container"> <span class="breadcrumb"> <a href="<?=$rootPageUrl?>"><?=$rootPageLabel?></a> </span>
				
		<?php
		if($mostPopularAnswersLabel!=""):
		?>
		 <span class="breadcrumb"><a href="<?=$subPageUrl.$catId.$mostpopularCatname.$tileTextVar;?>"> <?php echo $catName;?> </a> </span>
		 <?php echo $mostPopularAnswersLabel;?> 
		 
		 <?php		
		elseif($chat == "chat"):		
		?>		
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 		
		</span>		
		<label class="breadcrumb"><?php echo "Chat"?></label>
		
		<?php
		elseif($chat == "messenger"):
		?>
		<span class="breadcrumb"><a href="<?=$text;?>"> <?php echo $catName;?> </a> 
		</span>
		<label class="breadcrumb"><?php echo "Messenger"?></label>
		
		<?php
		else:
		?>
		<label class="breadcrumb"><?php echo $catName;?></label> 
		<?php
		endif;
		?>
		
		</div>
		<?php
		}
		
		endif;
		
	//=========================================================
	
	
?>
