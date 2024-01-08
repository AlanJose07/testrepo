<?php
namespace Custom\Models;
use RightNow\Api,
    RightNow\Utils\Framework,
    RightNow\Connect\v1_4 as RNCPHP,
    RightNow\Utils\Config;

class AL_Theme_Model extends \RightNow\Models\Base
{
    private $theme;
    
    public function __construct()
    {
        parent::__construct();
    }
     
    public function setCurrentTheme($themeId)
    {
        $this->theme = $this->getThemeById($themeId);
        $this->CI->session->setSessionData(array('themeID' => $this->theme->themeId));
    }
    
    public function currentTheme()
    {
        if(!$this->theme)
        {
            $this->theme = $this->getThemeById($this->currentThemeId());
        }
        
        return $this->theme;
    }
    
    private function getThemeById($id)
    {
		try
		{
			$theme = RNCPHP\AL_Theme\Theme::fetch($id);
			if(!$theme) $this->exitNoTheme();
		}
		catch(RNCPHP\ConnectAPIError $e)
		{
			$this->exitNoTheme();
		}
        
        $result = new Theme($theme);
		
        $data = AL_Report_Lib::executeReport(
			/*
				This API call is not available in the current version (May 2013), 
				substituting hard coded value as a workaround.
				RNCPHP\Config::fetch(CUSTOM_CFG_AL_THEME_AC_ID_SETTINGS)->Value,
			*/
            115323,  /* This is the ID for PRODUCTION */
            array('Theme ID' => $theme->ID));
		
        $result->addSettings($data);

		//echo('<pre>');
		//var_dump($result);
		//echo('</pre>');
        return $result;
    }
    
    public function currentThemeId()
    {
		return $this->CI->session->getSessionData('themeID');
    }
    
    private function exitNoTheme()
    {
        //TODO: Add a configuration setting here to determine if an error should be raised of if the user should be redirected to a special no theme page.
        //TODO: Add a configuration setting to control the no-theme URL.
		header('Location: /app/splash');
        exit;
    }
	
	public function setTheme(&$args)
	{
		$themeId = getUrlParm('theme');
		
		if($themeId)
		{
			$this->setCurrentTheme($themeId);
		}
    }
}

class Theme
{
    public $name;
    public $themeId;
    
    public function __construct($theme)
    {
        $this->name = $theme->Name;
        $this->themeId = $theme->ID;
    }
    
    public function addSettings($settings)
    {
		$nrows= $settings->count();
		
		if ( $nrows) 
		{
			while($row = $settings->next())
			{
				$this->settings[$row['Name']] = $row['SettingValueLongText'];
			}
		} 
    }
}

class AL_Report_Lib
{
	public static function executeReport($ac_id, $filterData = null)
	{
		$result = false;

		$filters = new RNCPHP\AnalyticsReportSearchFilterArray;
        
        if($filterData)
        {
            foreach ($filterData as $name => $value)
            {
                $filter = new RNCPHP\AnalyticsReportSearchFilter;
                $filter->Name = $name;
                $filter->Values = array($value);
                
                $filters[] = $filter;
            }
        }

		$report = RNCPHP\AnalyticsReport::fetch($ac_id);
		
		return $report->run(0, $filters);
 	}
}
?>