<rn:meta title="Corporate Support Form" template="standardhome.php" clickstream="incident_confirm"/>

<div id="rn_PageTitle" class="rn_AskQuestion">
   </br> <h1>Your request has been submitted.</h1></br>
</div>

<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <p>
           Your submission has been assigned the following reference number:  
            <b>
                <rn:condition url_parameter_check="i_id == null">
                    ##rn:url_param_value:refno#
                <rn:condition_else/>
                    <!--<a href="/app/#rn:config:CP_INCIDENT_RESPONSE_URL#/i_id/#rn:url_param_value:i_id##rn:session#">-->#<rn:field name="Incident.ReferenceNumber" /></a>
                </rn:condition>
            </b>
        </p>
        <!--<p>
            #rn:msg:SUPPORT_TEAM_SOON_MSG#
        </p>
        <rn:condition logged_in="true">
        <p>
            #rn:msg:UPD_QUEST_CLICK_ACCT_TAB_SEL_QUEST_MSG#
        </p>
        <rn:condition_else/>
        <p>
            #rn:msg:UPD_QUEST_ACCT_LG_CLICK_ACCT_TAB_MSG#
        </p>
        <p>
            #rn:msg:DONT_ACCT_ACCOUNT_ASST_ENTER_EMAIL_MSG#
            <a href="/app/#rn:config:CP_ACCOUNT_ASSIST_URL##rn:session#">#rn:msg:ACCOUNT_ASSISTANCE_LBL#</a>
        </p>
        </rn:condition> -->
    </div>
</div>

