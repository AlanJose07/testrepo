<rn:meta title="#rn:msg:SHP_TITLE_HDG#" template="standard.php" clickstream="home"/>
<div id="rn_PageTitle" class="rn_Home">
    <div id="rn_SearchControls" class="cust-src-alin">
        <h1 class="rn_ScreenReaderOnly">#rn:msg:SEARCH_CMD#</h1>
        <form onSubmit="return false;">
            <rn:container report_id="176">
            <div class="rn_SearchInput">
                <rn:widget path="search/AdvancedSearchDialog" report_page_url="/app/answers/list"/>
                <rn:widget path="search/KeywordText" label_text="#rn:msg:FIND_THE_ANSWER_TO_YOUR_QUESTION_CMD#" initial_focus="true"/>
            </div>
            <rn:widget path="search/SearchButton" report_page_url="/app/answers/list"/>
            </rn:container>
        </form>
    </div>
</div>
<div id="rn_PageContent" class="rn_Home">
    <rn:widget path="search/ProductCategoryList" data_type="categories" label_title="#rn:msg:FEATURED_SUPPORT_CATEGORIES_LBL#"/>
    <br/><br/>
    <div class="rn_Module">
        <h2>#rn:msg:MOST_POPULAR_ANSWERS_LBL#</h2>
        <rn:widget path="reports/Multiline" report_id="194" per_page="12"/>
        <a class="rn_AnswersLink" href="/app/answers/list#rn:session#">#rn:msg:SEE_ALL_POPULAR_ANSWERS_UC_LBL#</a>
    </div>
</div>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<style>
#main {
    width:800px;
    margin: auto;
    line-height:160%;
    font-size: 120%;
}
.rn_SubmitButton{
    margin: 14px 0 0 1.3em !important;
    padding: 8px 12px !important;
}
</style>
</head>
<body>

<!-- code for chatboat popup<div id="main">
<div id="SWITIAI-widget1" widget_style="" domain="beachbody"
widget_url="https://beta.customerserviceai.com:9911/"
robot_icon_url=""
guest_icon_url=""
chat_subject=""
></div>


<script src="https://beta.customerserviceai.com:9911/welcome/SWITIAIwidget2.js" type="text/javascript" defer></script>-->

