<?php /* Originating Release: February 2013 */

namespace Custom\Models;

use RightNow\Api,
    RightNow\Utils\Text, 
    RightNow\Utils\Config, 
    RightNow\ActionCapture,
    RightNow\Utils\Framework, 
    RightNow\Internal\Sql\Report as Sql;
	use RightNow\Connect\v1_2 as RNCPHP;

require_once(CORE_FILES . 'compatibility/Internal/Sql/Report.php');

/**
 * Methods for the retrieval and manipulation of analytics reports.
 */
 
class custom_report_model extends \RightNow\Models\Report
{    
    public function getDataHTML($reportID, $reportToken, $filters, $format)
    {
        if($this->preProcessData($reportID, $reportToken, $filters, $format))
        {  
            $this->getData($format['hiddenColumns']);
            $this->formatData(true, $format['hiddenColumns']);
            $this->getOtherKnowledgeBaseData();  
        }    
        return $this->getResponseObject($this->returnData, 'is_array');
    }
    
    /**
     * Formats the views data
     * @param bool $isHtml Whether to format links in html syntax; defaults to true 
     * @param bool $includeHiddenColumns Whether to include hidden columns in the data
     */
    protected function formatData($isHtml = true, $includeHiddenColumns = false)
    {
        if($this->reportIsTypeExternalDocument && $this->returnData['search_term'])
            $this->formatExternalSearchData();
        else
            $this->formatViewsData($isHtml, $includeHiddenColumns);
        
        $this->keywordSearchUpdate();
    }
    
   
    /**
     * Formats all the data with HTML links and appropriate date and currency formatting.
     *
     * @param bool $formatAsHtml If true html links are added for column links and exceptions tags are added
     * @param bool $hiddenColumnsIncluded Whether or not to include hidden columns as part of the return data
     */
    protected function formatViewsData($formatAsHtml = true, $hiddenColumnsIncluded = false)
    {
        $formattedDataCacheKey = "getFormattedData$this->reportID" . crc32(serialize($this->appliedFormats) . serialize($this->returnData)) . ($hiddenColumnsIncluded ? 'withHiddenColumns' : '');
        $formattedAidCacheKey = "getFormattedAid$this->reportID" . crc32(serialize($this->appliedFormats) . serialize($this->returnData));
        
        if(null !== ($cachedResult = Framework::checkCache($formattedDataCacheKey)))
        {
            if(null !== ($aidResult = Framework::checkCache($formattedAidCacheKey)))
            {
                $this->answerIDList = $aidResult;
            }
            $this->returnData['data'] = $cachedResult;
            return;
        }
        $columnExceptionList = $this->setExceptionTags($this->viewDefinition['exceptions'], $this->returnData['exceptions']);
        $dataSize = count($this->returnData['data']);
        for($i = 0; $i < $dataSize; $i++)
        {
            $icon = '';
            $row = $this->returnData['data'][$i];
		
            $columnCount = count($this->viewDataColumnDefinition);
            $count = 0;
            $answersIDListIsUpdated = false;
            $temp = array();
            for($j = 0; $j < $columnCount; $j++)
            {
                $currentField = isset($this->viewDefinition['all_cols']["field$j"]) ? $this->viewDefinition['all_cols']["field$j"] : null;
                if($currentField){
                    $columnDefinition = isset($currentField['col_definition']) ? $currentField['col_definition'] : null;
                    if($columnDefinition === ($this->answerTableAlias . '.a_id') && !$answersIDListIsUpdated){
                        $this->answerIDList[] = $row[$j];
                        $answersIDListIsUpdated = true;
                    }
                }
                
                if($this->viewDataColumnDefinition["col_item{$j}"]['val'] === "answers.url" && $row[$j] !== "" && $formatAsHtml)
                    $icon = Framework::getIcon($row[$j]);

                if((isset($this->viewDataColumnDefinition["col_item{$j}"]['hidden']) &&  ($this->viewDataColumnDefinition["col_item{$j}"]['hidden'] === 0)) || $hiddenColumnsIncluded)
                {
                    // the column is visible or it's hidden but we're told to include it
                    $bindType = $this->viewDataColumnDefinition["col_item{$j}"]['bind_type'];

                    if($bindType == BIND_MEMO)
                    {
                        //expand answer tags if the column definition is either answer.solution or answer.description
                        if($columnDefinition === "{$this->answerTableAlias}.solution" || $columnDefinition === "{$this->answerTableAlias}.description" || $this->reportIsTypeExternalDocument)
                        {
                            $temp[$count] = Text::expandAnswerTags($row[$j]);
                            
                        }
                        else
                        {
                            $temp[$count] = $row[$j];
                        }
                    }
                    else if($bindType == BIND_NTS)
                    {
					  $temp[$count] = $row[$j];
                    }
                    else if($bindType == BIND_DATE || $bindType == BIND_DTTM)
                    {
                        if(!is_null($row[$j]))
                        {
                            $formatDefine = DATEFMT_SHORT;
                            if($this->appliedFormats['raw_date'])
                            {
                                $formatDefine = false;
                            }
                            else if(($formatSpecified = $this->appliedFormats['dateFormat']) && $formatSpecified !== 'short')
                            {
                                if($formatSpecified === 'long')
                                    $formatDefine = DATEFMT_LONG;
                                else if($formatSpecified === 'date_time')
                                    $formatDefine = DATEFMT_DTTM;
                                else if($formatSpecified === 'raw')
                                    $formatDefine = false;
                            }
                            $temp[$count] = ($formatDefine !== false) ? $row[$j] : $row[$j];
                        }
                        else
                        {
                            $temp[$count] = ($this->appliedFormats['raw_date']) ? null : '';
                        }
                    }
                    else if($bindType == BIND_CURRENCY )
                    {
                        $temp[$count] = Api::currency_str($row[$j]->currency_id, $row[$j]->value);
                    }
                    else
                    {
                        $temp[$count] = $row[$j];
                    }

                    if($formatAsHtml)
                    {
                        // add highlighting to non-numeric columns
                        if(($this->appliedFormats['highlight'] || $this->appliedFormats['emphasisHighlight']) && ($bindType !== BIND_INT))
                        {
                            $searchTermArray = explode(' ', $this->returnData['search_term']);
                            if(count($searchTermArray))
                            {
                                $text = $temp[$count];
                                if($this->appliedFormats['emphasisHighlight'])
                                    $text = Text::emphasizeText($text, array('query'=>$this->returnData['search_term']));
                                else
                                    $text = Text::highlightTextHelper($text, $this->returnData['search_term'], $this->appliedFormats['highlightLength']);
                                $temp[$count] = $text;
                            }
                        }

                        // add exceptions
                        if(in_array($j + 1, $columnExceptionList))
                        {
                            foreach($this->viewDefinition['exceptions'] as $k => $v)
                            {
                                if($row[$this->viewDefinition['exceptions'][$k]['data_col']] > 0 && $this->viewDefinition['exceptions'][$k]['col_id'] - 1 == $j)
                                {
                                    $temp[$count] = $this->viewDefinition['exceptions'][$k]['start_tag'].$temp[$count].$this->viewDefinition['exceptions'][$k]['end_tag'];
                                    break;
                                }
                            }
                        }
                    }

                    //add links
                    $url = $target = "";
                    if($currentField && isset($currentField['url_info'])){
                        $url = $currentField['url_info']['url'];
                        $target = $currentField['url_info']['target'];
                    }
                    if($url != "")
                    {
                        $url = $this->replaceColumnLinks($url, $row, $this->appliedFormats['urlParms']);

                        if($this->appliedFormats['no_session'])
                            $str = "<a href='{$url}' ";
                        else
                            $str = "<a href='{$url}" . \RightNow\Utils\Url::sessionParameter() . "'";

                        if($target != "")
                        {
                            $target = $this->replaceColumnLinks($target, $row);
                            $str .= " target='$target' ";
                        }
                        if($this->appliedFormats['tabindex'])
                        {
                            $str .= " tabindex='{$this->appliedFormats['tabindex']}{$i}' ";
                        }
                        $str .= '>' . $temp[$count] . '</a>';
                        $temp[$count] = $str;
                    }
                    $count++;
                }
            }
            if($icon && $this->viewDataColumnDefinition['col_item0']['bind_type'] !== BIND_INT)
                $temp[0] = "{$icon} {$temp[0]}";

            $dataArray[$i] = $temp;
        }
        if(count($dataArray))
        {
            $this->returnData['data'] = $dataArray;
        }
        Framework::setCache($formattedDataCacheKey, $this->returnData['data']);
        Framework::setCache($formattedAidCacheKey, $this->answerIDList);
    }

   
}
