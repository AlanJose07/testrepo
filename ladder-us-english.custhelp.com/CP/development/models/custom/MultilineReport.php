<?php /* Originating Release: February 2013 */

namespace Custom\Models;
$CI = get_instance();

$CI->model('Report');
use RightNow\Utils\Connect,

    RightNow\Utils\Text,
    RightNow\Utils\Framework,
    RightNow\Api;
class MultilineReport extends \RightNow\Models\Report{
    function __construct()
	
    {
	
	
	
         parent::__construct();
    }
	/**
     * Array of filter names and the respective callback functions to clean the filter values.
     * The callback function can be customized using the hook 'pre_report_filter_clean'
     *
     * @return array Array of callback functions to clean the various filters
     */
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
	/**
     * Defines the column mapping between the main report and the sub reports.
     *
     * A Report(Ex:15100) to be executed by sup reports has to be added with the below details
     * 1. SubReportMapping - Key in this mapping is a regular expression which in the format "FilterName.Main report Soring column index"
     *                       Value is the array of sub report Id and the index of sorting column to be used.
     * 2. MainReportFilterID - The name of the IDs filter to be set with the IDs collected from the main report
     * 3. MainReportDefaultSortColID - The default Sorting column details in the main report
     *
     * @return array Array of Sub Report Mapping
     */
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
	/**
     * Get the report data and format it. The `$filters` array options can contain:
     *
     * * **initial:** Should the data be shown initially (use value of 1 to override report setting)
     * * **page:** The page number to show
     * * **per_page:** Number to show
     * * **level:** The drill down level requested
     * * **no_truncate:** Send 1 to prevent search limiting
     * * **start_index:** Index of first result (overrides page])
     * * **search:** Send 1 to signify search, 0 for no search
     * * **recordKeywordSearch:** Send 1 to signify that this search should be recorded in the keyword_searches table (search must also be set)
     * * **sitemap:** True to signify report is being run for sitemap output
     *
     * The results will be formatted based on the `$format` array which expects:
     *
     *
     * * **highlight:** Highlight text with <span></span> tags
     * * **emphasisHighlight:** Highlight text with <em></em> tags
     * * **raw_date:** True to leave date fields alone
     * * **no_session:** Do not append the session ID to URLs (applies to grid only)
     * * **urlParms:** String of key value pairs to add to any links
     * * **hiddenColumns:** Whether to include hidden column data in the returned results
     * * **dateFormat:** How to format date fields (w/ correct internationalization):
     *      * **short:** m/d/Y
     *      * **date_time:** m/d/Y h:i A
     *      * **long:** l, M d, Y
     *      * **raw:** Unformatted unix timestamp
     *
     * The result from this method will be an array containing the following data:
     *
     * * **headers:** The visible headers formatted (i.e. date)
     * * **data:** The visible data
     *      *    **data[i][text]:** Item to print. Formatted for date and wrapping text size and highlighted
     *      *    **data[i][a_id]:** Answer ID of the item (if exists)
     *      *    **data[i][i_id]:** Incident ID of the item (if exists)
     *      *    **data[i][link]:** Anchor link (if exists)
     *      *    **data[i][drilldown]: Drilldown link to next level (if exists)
     * * **per_page:** Number of results per page
     * * **page:** Current page
     * * **total_num:** Total number of results
     * * **total_pages:** Total number of total pages
     * * **row_num:** Whether or not row numbers should be added to data
     * * **truncated:** Search config truncated number to show
     * * **grouped:** ID data on current level is grouped
     * * **initial:** If report should show on initial search
     * ]
     *
     * @param int $reportID The analytics report number
     * @param string $reportToken The token matching the report number for security
     * @param array|null &$filters A php array containing all the filters to apply to the results
     * @param array|null $format An array of options for formatting the data
     * @param boolean    $useSubReport Flag to indicate that the report will be executed using sub reports
     * @param bool $forceCacheBust Whether to willfully ignore any previously cached data
     * @param bool $cleanFilters Flag to clean the filters before calling the report
     * @return array The resulting report data
     */
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
       // return $this->getResponseObject($this->returnData, 'is_array');
	   $res = $this->getResponseObject($this->returnData, 'is_array')->result;
	   /*echo "<pre>";
	   print_r(html_entity_decode($res['data'][0][1]));
	   die("--------------------here----------------");*/
    }
	/**
     * Gets report data and view definition information from views engine and builds it up into the correct structure
     * @param bool $showHiddenColumns Whether or not to show hidden columns
     * @param bool $forceCacheBust Whether to willfully ignore any previously cached data
     * @return array The report data in the correct format
     */
    protected function getReportData($showHiddenColumns, $forceCacheBust = false)
    {
        $this->setViewDefinition();
        $queryArguments = $this->convertCPFiltersToQueryArguments();

        $preHookData = array('data' => array('reportId' => $this->reportID, 'queryArguments' => $queryArguments, 'reportType' => 'internal'));
        \RightNow\Libraries\Hooks::callHook('pre_report_get_data', $preHookData);
        $queryArguments = $preHookData['data']['queryArguments'];

        $cacheKey = "getReportData$this->reportID" . serialize($queryArguments) . (($showHiddenColumns) ? 'withHiddenColumns' : '');
        if(!$forceCacheBust && null !== ($cachedResult = Framework::checkCache($cacheKey)))
        {
            list($this->returnData, $this->viewDataColumnDefinition) = $cachedResult;
            return;
        }
        if(IS_DEVELOPMENT && $this->isAnswerListReportWithoutSpecialSettingsFilter($this->reportID))
        {
            Framework::addDevelopmentHeaderWarning(sprintf(Config::getMessage(RPT_ID_PCT_D_INCLUDES_ANS_TB_PCT_S_MSG), $this->reportID, Sql::ANSWERS_SPECIAL_SETTINGS_FILTER_NAME, Sql::ANSWERS_SPECIAL_SETTINGS_FILTER_NAME));
        }
        $viewData = Sql::view_get_query_cp($this->reportID, $queryArguments);
        $this->recordSearchData($queryArguments['search_args']);
        $this->viewDataColumnDefinition = $viewData['columns'];
        $exceptions = $this->getViewExceptions($viewData['view_handle']);

        $numberPerPage = $this->getNumberPerPage(intval(($this->viewDefinition['rpt_per_page'] === INT_NOT_SET) ? $this->viewDefinition['row_limit'] : $this->viewDefinition['rpt_per_page']));
        $this->setMaxResultsBasedOnSearchLimiting($numberPerPage);
        $dataArray = $this->getViewResults($viewData['view_handle'], min($numberPerPage, ($this->returnData['max_results']) ? $this->returnData['max_results'] : 0x7fffffff));
        $numberThisPage = count($dataArray);
        $pageNumber = (isset($this->appliedFilters['page'])) ? intval($this->appliedFilters['page']) : 1;
        $pageNumber = (intval($pageNumber) <= 0) ? 1 : $pageNumber;
        $rowCount = ($this->returnData['max_results'] > 0) ? $this->returnData['max_results'] : $viewData['row_count'];
        $this->returnData['headers'] = $this->getHeaders($showHiddenColumns);
        $this->returnData['total_num'] = ($numberPerPage > 0) ? $viewData['row_count'] : 0;
        $this->returnData['start_num'] = ($this->returnData['total_num'] > 0) ? ($numberPerPage * ($pageNumber - 1) + 1) : 0;
        $this->returnData['per_page'] = ($viewData['row_count'] < $numberThisPage) ? $rowCount : $numberThisPage;
        $this->returnData['total_pages'] = ($numberPerPage > 0) ? ceil($rowCount / $numberPerPage) : 0;
		
        $this->returnData['end_num'] = ($this->returnData['total_num'] > 0) ? ($this->returnData['start_num'] + $numberThisPage - 1) : 0;
        $this->returnData['search_term'] = $this->appliedFilters['keyword']->filters->data;
        if($this->returnData['total_num'] <= $numberThisPage)
        {
            $this->returnData['truncated'] = 0;
        }
        $this->returnData['row_num'] = $this->viewDefinition['row_num'];
        $this->returnData['grouped'] = $this->viewDefinition['grouped'];
        $this->returnData['data'] = $dataArray;
        $this->returnData['exceptions'] = $exceptions;
        $this->returnData['page'] = intval($pageNumber);
        $this->checkValidPageNumberRequest();

        $postHookData = array('data' => array('reportId' => $this->reportID, 'returnData' => &$this->returnData, 'reportType' => 'internal'));
        \RightNow\Libraries\Hooks::callHook('post_report_get_data', $postHookData);

        Framework::setCache($cacheKey, array($postHookData['data']['returnData'], $this->viewDataColumnDefinition));
        Api::view_cleanup($viewData['view_handle']);
    }

}
