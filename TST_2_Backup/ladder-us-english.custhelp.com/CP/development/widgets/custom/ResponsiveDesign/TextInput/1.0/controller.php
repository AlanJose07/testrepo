<?php
namespace Custom\Widgets\ResponsiveDesign;
use RightNow\Utils\Connect,
    RightNow\Utils\Framework,
    RightNow\Utils\Text,
    RightNow\Utils\Config,
    RightNow\Api,
	RightNow\Connect\v1_2 as RNCPHP;
class TextInput extends \RightNow\Widgets\TextInput {
    function __construct($attrs) {
        parent::__construct($attrs);
    }

    function getData() {

      return parent::getData();
/*               $catid = \RightNow\Utils\Url::getParameter('catid');
              if($this->data['attrs']['name']=="Incident.Subject")
              {
                                $baseQuery="SELECT 
                                SC.ID,SC.LookupName,
                                SC.Parent FROM 
                                ServiceCategory SC 
                                WHERE 
                                SC.ID =".$catid;

                                $cat =  RNCPHP\ROQL::query($baseQuery)->next();
                                $category = $cat->next();
                                $catId=$category["ID"];

                                $catName=str_replace(" ","-",str_replace("/","_",trim($category["LookupName"])));

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
                              
                              $categoryNameFirst=str_replace(" ","-",str_replace("/","_",trim($categoryFirst["LookupName"])));

                              $categoryParentIdSecond=$categoryFirst["Parent"];
                              }
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
                              }
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
                                  }
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
                                  }
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
                                  }
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
                                  }

                                  $this->data["js"]["catname"] = str_replace("_","/",str_replace("-"," ",$catName));
                                  $this->data["js"]["category_name_first"] = str_replace("_","/",str_replace("-"," ",$categoryNameFirst));
                                  $this->data["js"]["category_name_second"] = str_replace("_","/",str_replace("-"," ",$categoryNameSecond));
                                  $this->data["js"]["category_name_third"] = str_replace("_","/",str_replace("-"," ",$categoryNameThird));
                                  $this->data["js"]["category_name_fourth"] = str_replace("_","/",str_replace("-"," ",$categoryNameFourth));
                                  $this->data["js"]["category_name_fifth"] = str_replace("_","/",str_replace("-"," ",$categoryNameFifth));
                                  $this->data["js"]["category_name_sixth"] = str_replace("_","/",str_replace("-"," ",$categoryNameSixth));
                              
            } */

    }
   
    /**
     * Overridable methods from TextInput:
     */
    // public function outputConstraints()
    // protected function determineDisplayType($fieldName, $dataType, $constraints)
}