<?php
namespace Custom\Widgets\ResponsiveDesign;

use RightNow\Utils\Connect,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
    RightNow\Utils\Config,
    RightNow\Api,
	RightNow\Connect\v1_4 as RNCPHP;

class CustomBreadCrumb extends \RightNow\Libraries\Widget\Base {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {
		
		
	$catid = \RightNow\Utils\Url::getParameter('catid');
	
	$answerid = \RightNow\Utils\Url::getParameter('ans_id');
	
	$tlp = \RightNow\Utils\Url::getParameter('TLP');
		
	if($catid=="" || $catid=="ans_id")
	{
		$catid=0;
	}
		   		
		
	$uri=$_SERVER['REQUEST_URI'];
		
		//HOME PAGE
		if( (strpos( $uri, "home" ) !== false) ):
			$visible_on_page="home";
			$visible_on_page_parent="home";
			
		//GET HELP
		elseif( (strpos( $uri, "gethelp" ) !== false) ) :
		    $visible_on_page="gethelp";	
			$visible_on_page_parent="home";
			
		//CONTACT US
		elseif( (strpos( $uri, "contactus" ) !== false) ) :
		    $visible_on_page="contactus";
			$visible_on_page_parent="contactus";
			
		//CONTACT US SUB LEVEL	
		elseif( (strpos( $uri, "contactus_sub_level" ) !== false) ) :
		    $visible_on_page="contactus_sub_level";
			$visible_on_page_parent="contactus";			
			
		//ANSWERS
		elseif( (strpos( $uri, "answers" ) !== false) ) :
		     $visible_on_page="answers";	;
			
		else:
		endif;	
		
			
	
	   $baseQuery="SELECT 
					SC.ID,SC.LookupName,
					SC.Parent 
				FROM 
					ServiceCategory SC 
				WHERE 
					SC.ID =".$catid;
	
	$cat =  RNCPHP\ROQL::query($baseQuery)->next();
	$category = $cat->next();
	
	$catId=$category["ID"];
	
	
	$catName=str_replace(" ","-",str_replace("/","_",trim($category["LookupName"])));
	
	//$catName=$category["LookupName"];
	
	$catParentIdFirst=$category["Parent"];
	
	
	
	if($catParentIdFirst!="")// FIRST LEVEL 
	{
		 
	 $queryFirst="SELECT 
					SC.ID,
					SC.LookupName,
					SC.Parent 
				 FROM 
					ServiceCategory SC 
				 WHERE 
					SC.ID =".$catParentIdFirst;
	
	 $catParent =  RNCPHP\ROQL::query($queryFirst)->next();
	 
	 $categoryFirst = $catParent->next();
	 
	
	 //$categoryNameFirst=$categoryFirst["LookupName"];
	  $categoryNameFirst=str_replace(" ","-",str_replace("/","_",trim($categoryFirst["LookupName"])));
	  
	 $categoryParentIdSecond=$categoryFirst["Parent"];

	 //================REMOVE ANSWER ID SECTION=========
	 if($categoryParentIdSecond=="")
	 {
	 $queryFirstAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$catParentIdFirst;
	 }
	 else
	 {
	 
	 //---answer id--
	$queryFirstAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$catParentIdFirst;
	}
	
	 
	 $catAnswerFirst =  RNCPHP\ROQL::query($queryFirstAnswer)->next();
	 
	 $answerFirst = $catAnswerFirst->next();
	 
	 $answer_report_id_first=$answerFirst["answer_report_id"];
	 //--------------
	  //================REMOVE ANSWER ID SECTION=========
	 
		 if($categoryParentIdSecond!="")//SECOND LEVEL
		 {
						
			$querySecond="SELECT 
							SC.ID,
							SC.LookupName,
							SC.Parent
						  FROM 
							ServiceCategory SC 
						  WHERE 
							SC.ID =".$categoryParentIdSecond;
			
			$catParentSecond =  RNCPHP\ROQL::query($querySecond)->next();

			$categorySecond = $catParentSecond->next();
			
			//$categoryNameSecond=$categorySecond["LookupName"];
			$categoryNameSecond=str_replace(" ","-",str_replace("/","_",trim($categorySecond["LookupName"])));
			
			$categoryIdSecond=$categorySecond["ID"];
			
			$categoryParentIdThird=$categorySecond["Parent"];
			
			//================REMOVE ANSWER ID SECTION=========			
			if($categoryParentIdThird=="")
			{
			$querySecondAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$categoryParentIdSecond;
			}
			else
			{
			 //---answer id--
			$querySecondAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$categoryParentIdSecond;
			}
	
	 
			 $catAnswerSecond =  RNCPHP\ROQL::query($querySecondAnswer)->next();
			 
			 $answerSecond = $catAnswerSecond->next();
			 
			 $answer_report_id_second=$answerSecond["answer_report_id"];
			//--------------
			//================REMOVE ANSWER ID SECTION=========	
			
			if($categoryParentIdThird!="")//THIRD LEVEL
			{
			
			$queryThird="SELECT 
							SC.ID,
							SC.LookupName,
							SC.Parent
						  FROM 
							ServiceCategory SC 
						  WHERE 
							SC.ID =".$categoryParentIdThird;
			
			$catParentThird =  RNCPHP\ROQL::query($queryThird)->next();

			$categoryThird = $catParentThird->next();
			
			//$categoryNameThird=$categoryThird["LookupName"];
			$categoryNameThird=str_replace(" ","-",str_replace("/","_",trim($categoryThird["LookupName"])));
			$categoryIdThird=$categoryThird["ID"];
				
			$categoryParentIdFourth=$categoryThird["Parent"];	
			
			 //================REMOVE ANSWER ID SECTION=========
			
    			if($categoryParentIdFourth=="")
				{
				$queryThirdAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$categoryParentIdThird;
				}
				else
				{
						//---answer id--
				$queryThirdAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE 		bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$categoryParentIdThird;
				}
				
	
			$catAnswerThird =  RNCPHP\ROQL::query($queryThirdAnswer)->next();
	 
			$answerThird = $catAnswerThird->next();
	 
			$answer_report_id_third=$answerThird["answer_report_id"];
			//--------------
			//================REMOVE ANSWER ID SECTION=========
				
				if($categoryParentIdFourth!="")//FOURTH LEVEL
				{
					
				$queryFourth="SELECT 
								SC.ID,
								SC.LookupName,
								SC.Parent
							  FROM 
								ServiceCategory SC 
							  WHERE 
								SC.ID =".$categoryParentIdFourth;
					
				$catParentFourth =  RNCPHP\ROQL::query($queryFourth)->next();

				$categoryFourth = $catParentFourth->next();
				
				//$categoryNameFourth=$categoryFourth["LookupName"];
				$categoryNameFourth=str_replace(" ","-",str_replace("/","_",trim($categoryFourth["LookupName"])));
				$categoryIdFourth=$categoryFourth["ID"];
					
				$categoryParentIdFifth=$categoryFourth["Parent"];
					
			 //================REMOVE ANSWER ID SECTION=========
			 //---answer id--
					
					
			if($categoryParentIdFifth=="")
			{
			$queryFourthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$categoryParentIdFourth;
			}
			else
			{
			$queryFourthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$categoryParentIdFourth;
			}
		
			$catAnswerFourth =  RNCPHP\ROQL::query($queryFourthAnswer)->next();
			 
			 $answerFourth = $catAnswerFourth->next();
			 
			 $answer_report_id_fourth=$answerFourth["answer_report_id"];
			//--------------
			//================REMOVE ANSWER ID SECTION=========
					
						if($categoryParentIdFifth!="")//FIFTH LEVEL
						{
						
						$queryFifth="SELECT 
										SC.ID,
										SC.LookupName,
										SC.Parent
									  FROM 
										ServiceCategory SC 
									  WHERE 
										SC.ID =".$categoryParentIdFifth;
						
						$catParentFifth =  RNCPHP\ROQL::query($queryFifth)->next();


						$categoryFifth = $catParentFifth->next();
						
						//$categoryNameFifth=$categoryFifth["LookupName"];
						$categoryNameFifth=str_replace(" ","-",str_replace("/","_",trim($categoryFifth["LookupName"])));
						$categoryIdFifth=$categoryFifth["ID"];
						
						$categoryParentIdSixth=$categoryFifth["Parent"];
						
						 //================REMOVE ANSWER ID SECTION=========
												
						if($categoryParentIdSixth=="")
						{
						$queryFifthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$categoryParentIdFifth;
						}
						else
						{
								//---answer id--
						$queryFifthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$categoryParentIdFifth;
						}
						
						
						 $catAnswerFifth =  RNCPHP\ROQL::query($queryFifthAnswer)->next();
						 
						 $answerFifth = $catAnswerFifth->next();
						 
						 $answer_report_id_fifth=$answerFifth["answer_report_id"];
							//--------------
						
						 //================REMOVE ANSWER ID SECTION=========
						
						if($categoryParentIdSixth!="")//SIXTH LEVEL
						{
									$querySixth="SELECT 
										SC.ID,
										SC.LookupName,
										SC.Parent
									  FROM 
										ServiceCategory SC 
									  WHERE 
										SC.ID =".$categoryParentIdSixth;
						
						$catParentSixth =  RNCPHP\ROQL::query($queryFifth)->next();

						$categorySixth = $catParentSixth->next();
						
						//$categoryNameSixth=$categorySixth["LookupName"];
						$categoryNameSixth=str_replace(" ","-",str_replace("/","_",trim($categorySixth["LookupName"])));
						$categoryIdSixth=$categorySixth["ID"];
						
						$categoryParentIdSeventh=$categorySixth["Parent"];
						
						//================REMOVE ANSWER ID SECTION=========
						
						if($categoryParentIdSeventh=="")
						{
						$querySixthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page_parent' and bbb.category.ID=".$categoryParentIdSeventh;
						}
						else
						{
						//---answer id--
						$querySixthAnswer="SELECT BB.categ_contac_hom_map.answer_report_id FROM BB.categ_contac_hom_map bbb WHERE bbb.enable=1 and bbb.visible_on_page.LookupName='$visible_on_page' and bbb.category.ID=".$categoryParentIdSeventh;
						}
						
						$catAnswerSixth =  RNCPHP\ROQL::query($querySixthAnswer)->next();
						 
						 $answerSixth = $catAnswerSixth->next();
						 
						 $answer_report_id_sixth=$answerSixth["answer_report_id"];
						  //================REMOVE ANSWER ID SECTION=========
						
					}
						
				}
				}
			
			}
			
		 }
	 
	}
		//ANSWER ID
		
		
		
		$this->data["js"]["answerid_first"] = ($answer_report_id_first=="")? 0 : $answer_report_id_first;
		$this->data["js"]["answerid_second"] = ($answer_report_id_second=="")? 0 : $answer_report_id_second;
		$this->data["js"]["answerid_third"] = ($answer_report_id_third=="")? 0 : $answer_report_id_third;
		$this->data["js"]["answerid_fourth"] = ($answer_report_id_fourth=="")? 0 : $answer_report_id_fourth;
		$this->data["js"]["answerid_fifth"] = ($answer_report_id_fifth=="")? 0 : $answer_report_id_fifth;
		$this->data["js"]["answerid_sixth"] = ($answer_report_id_sixth=="")? 0 : $answer_report_id_sixth;
		
		
		//TLP
		$this->data["js"]["tlp"] = $tlp;
		
	
		//BASE LEVEL
		$this->data["js"]["catid"] = $catId;
		//$this->data["js"]["catname"] = $catName;
		
		$this->data["js"]["catname"] = str_replace("_","/",str_replace("-"," ",$catName));
		
		$this->data["js"]["answerid"] = $answerid;

		//FIRST LEVEL
		$this->data["js"]["category_id_first"] = $catParentIdFirst;
		//$this->data["js"]["category_name_first"] = $categoryNameFirst;
		$this->data["js"]["category_name_first"] = str_replace("_","/",str_replace("-"," ",$categoryNameFirst));
		
		$this->data["js"]["category_parent_id_first"] = $catParentIdFirst;


		// SECOND LEVEL
		$this->data["js"]["category_id_second"] = $categoryIdSecond;
		//$this->data["js"]["category_name_second"] = $categoryNameSecond;
		
		$this->data["js"]["category_name_second"] = str_replace("_","/",str_replace("-"," ",$categoryNameSecond));
		
		$this->data["js"]["category_parent_id_second"] = $categoryParentIdSecond;


		//THIRD LEVEL
		$this->data["js"]["category_id_third"] = $categoryIdThird;
		//$this->data["js"]["category_name_third"] = $categoryNameThird;
	
		$this->data["js"]["category_name_third"] = str_replace("_","/",str_replace("-"," ",$categoryNameThird));
		$this->data["js"]["category_parent_id_third"] = $categoryParentIdThird;


		//FOURTH LEVEL
		$this->data["js"]["category_id_fourth"] = $categoryIdFourth;
		//$this->data["js"]["category_name_fourth"] = $categoryNameFourth;
		
		$this->data["js"]["category_name_fourth"] = str_replace("_","/",str_replace("-"," ",$categoryNameFourth));
		
		$this->data["js"]["category_parent_id_fourth"] = $categoryParentIdFourth;


		//FIFTH LEVEL
		$this->data["js"]["category_id_fifth"] = $categoryIdFifth;
		//$this->data["js"]["category_name_fifth"] = $categoryNameFifth;
		
		$this->data["js"]["category_name_fifth"] = str_replace("_","/",str_replace("-"," ",$categoryNameFifth));
		$this->data["js"]["category_parent_id_fifth"] = $categoryParentIdFifth;
		
		//SIXTH LEVEL
		
		$this->data["js"]["category_id_sixth"] = $categoryIdSixth;
		//$this->data["js"]["category_name_sixth"] = $categoryNameSixth;
		
		$this->data["js"]["category_name_sixth"] = str_replace("_","/",str_replace("-"," ",$categoryNameSixth));
		$this->data["js"]["category_parent_id_sixth"] = $categoryParentIdSixth;
		
	}
}