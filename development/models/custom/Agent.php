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
 \RightNow\Models\Base::loadModel('Report');
class Agent extends \RightNow\Models\Report
{
function __construct()
    {
        parent::__construct();
    }

    public function getDataHTML($reportID, $reportToken, &$filters, $format, $useSubReport = true, $forceCacheBust = false, $cleanFilters = true)
    {
        if ($filters && $cleanFilters) {
            $preFilterCleanHookData = array("filters" => $filters, "cleanFilterFunctionsMap" => $this->getCleanFilterFunctions());
            \RightNow\Libraries\Hooks::callHook('pre_report_filter_clean', $preFilterCleanHookData);
            $filters = $this->cleanFilterValues($preFilterCleanHookData["filters"], $preFilterCleanHookData["cleanFilterFunctionsMap"]);
        }
        $subReportMap = false;
        if ($useSubReport) {
            $preHookData = self::getSubReportMapping();
            \RightNow\Libraries\Hooks::callHook('pre_sub_report_check', $preHookData);
            $subReportMap = $preHookData[$reportID];
        }
        if ($useSubReport && $subReportMap) {
            return $this->getDataHTMLUsingSubReports($reportID, $reportToken, $filters, $format, $subReportMap, $forceCacheBust);
        }

        if($this->preProcessData($reportID, $reportToken, $filters, $format))
        {
            $this->getData($format['hiddenColumns'], $forceCacheBust);
            $this->formatData(true, $format['hiddenColumns']);
            $this->getOtherKnowledgeBaseData();
        }
        return $this->getResponseObject($this->returnData, 'is_array');
    }
private function getCleanFilterFunctions() {
        $cleanModerationDateFilter = function($dateFilterValue) {
            if (empty($dateFilterValue)) {
                return null;
            }
            $dateFormatObj = Text::getDateFormatFromDateOrderConfig();
            $dateFormat = $dateFormatObj["short"];
            $dateIntervals = array("day", "year", "month", "week", "hour");
            $dateIntervals = array_merge($dateIntervals, array_map(function ($interval) {
                return $interval . "s";
            }, $dateIntervals)
            );
            $dateValueParts = explode("_", $dateFilterValue);
            $interval = strtolower($dateValueParts[2]);
            $isHour = $interval === 'hours' || $interval === 'hour';
            if (count($dateValueParts) === 3 && $dateValueParts[0] === "last" && intval($dateValueParts[1]) && array_search($interval, $dateIntervals)) {
                $dateExpression = "-$dateValueParts[1] " . strtolower($dateValueParts[2]);
                $dateValue = $isHour ? strtotime($dateExpression) : strtotime("midnight", strtotime($dateExpression));
            }
            $dateValue = $dateValue ? $dateValue . "|" : Text::validateDateRange($dateFilterValue, $dateFormat, "|", true);
            $dateValue = $dateValue ?: null;
            return $dateValue;
        };

        return array("questions.updated" => $cleanModerationDateFilter,
            "comments.updated" => $cleanModerationDateFilter);
    }
	
	protected function checkTokenError($token)
    {
	
		return false;
	}
private static function getSubReportMapping(){
        static $subReportMapping = array();
        if (!$subReportMapping) {
            $subReportMapping = array(15100 => array("SubReportMapping" => array(4 => array("SubReportID" => 15144, "SubReportColID" => 2),
                        "question_content_flags.flag4" => array("SubReportID" => 15145, "SubReportColID" => 2),
                        "p4" => array("SubReportID" => 15146, "SubReportColID" => 2),
                        "c4" => array("SubReportID" => 15147, "SubReportColID" => 2),
                        ".+4" => array("SubReportID" => 15123, "SubReportColID" => 2),
                        8 => array("SubReportID" => 15140, "SubReportColID" => 2),
                        "question_content_flags.flag8" => array("SubReportID" => 15141, "SubReportColID" => 2),
                        "p8" => array("SubReportID" => 15142, "SubReportColID" => 2),
                        "c8" => array("SubReportID" => 15143, "SubReportColID" => 2),
                        ".+8" => array("SubReportID" => 15122, "SubReportColID" => 2),
                    ), "MainReportIDFilter" => "question_id", "FilterNamesOnJoins" => array('questions.updated', 'questions.status', 'p', 'c', 'question_content_flags.flag')
                ),
                15101 => array("SubReportMapping" => array(5 => array("SubReportID" => 15152, "SubReportColID" => 2),
                        "comment_cnt_flgs.flag5" => array("SubReportID" => 15153, "SubReportColID" => 2),
                        "p5" => array("SubReportID" => 15154, "SubReportColID" => 2),
                        "c5" => array("SubReportID" => 15155, "SubReportColID" => 2),
                        ".+5" => array("SubReportID" => 15125, "SubReportColID" => 2),
                        9 => array("SubReportID" => 15148, "SubReportColID" => 2),
                        "comment_cnt_flgs.flag9" => array("SubReportID" => 15149, "SubReportColID" => 2),
                        "p9" => array("SubReportID" => 15150, "SubReportColID" => 2),
                        "c9" => array("SubReportID" => 15151, "SubReportColID" => 2),
                        ".+9" => array("SubReportID" => 15124, "SubReportColID" => 2),
                    ), "MainReportIDFilter" => "comment_id", "FilterNamesOnJoins" => array('comments.updated', 'comments.status', 'p', 'c', 'comment_cnt_flgs.flag')
                ),
                15102 => array("SubReportMapping" => array(1 => array("SubReportID" => 15115, "SubReportColID" => 1),
                        3 => array("SubReportID" => 15115, "SubReportColID" => 2),
                        4 => array("SubReportID" => 15133, "SubReportColID" => 2),
                        5 => array("SubReportID" => 15132, "SubReportColID" => 2),
                        6 => array("SubReportID" => 15116, "SubReportColID" => 2),
                        7 => array("SubReportID" => 15117, "SubReportColID" => 2),
                        8 => array("SubReportID" => 15118, "SubReportColID" => 2),
                        9 => array("SubReportID" => 15119, "SubReportColID" => 2),
                        10 => array("SubReportID" => 15120, "SubReportColID" => 2),
                        11 => array("SubReportID" => 15121, "SubReportColID" => 2),
                        12 => array("SubReportID" => 15133, "SubReportColID" => 3)
                    ), "MainReportIDFilter" => "user_id", "FilterNamesOnJoins" => array('users.status')
                )
            );
        }
        return $subReportMapping;
    }

}
