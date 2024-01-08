<rn:meta title="#rn:msg:LIVE_CHAT_LBL#" template="standard.php" clickstream="chat_request"/>

<div id="rn_PageTitle" class="rn_LiveHelp">
    <h1>#rn:msg:LIVE_HELP_HDG#</h1>
    <p>#rn:msg:REQ_REAL_T_CHAT_AGT_FILL_FLDS_PG_MSG#</p>
    <br />
</div>

<div id="rn_PageContent" class="rn_Live">
    <div class="rn_Padding" >
        <rn:condition chat_available="true">
        <div id="rn_ChatLaunchFormDiv" class="rn_ChatForm">
           <!-- <span class="rn_ChatLaunchFormHeader">#rn:msg:CHAT_MEMBER_OUR_SUPPORT_TEAM_LBL#</span> -->
            <form id="rn_ChatLaunchForm" method="post" action="/app/chat/chat_landing">
                <div id="rn_ErrorLocation"></div>
                <!--rn:widget path="input/FormInput" name="Incident.Subject" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/-->
                <rn:condition config_check="COMMON:intl_nameorder == 1">
                    <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
                    <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
                <rn:condition_else/>
                    <rn:widget path="input/FormInput" name="Contact.Name.First" label_input="#rn:msg:FIRST_NAME_LBL#" required="true"/>
                    <rn:widget path="input/FormInput" name="Contact.Name.Last" label_input="#rn:msg:LAST_NAME_LBL#" required="true"/>
                </rn:condition>
                <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
                <!-- optional fields -->
                <!--rn:widget path="input/CustomAllInput" table="Incident" chat_visible_only="true" always_show_mask="false" /-->
                <br />
                <rn:widget path="custom/input/ProductCategoryInputCustom" table="incidents" data_type="products" required="true"  label_input="Product" label_nothing_selected="Select a product" required_lvl="2"  />
                
                 <div id="derm" style="display:none">
        <!--<rn:widget path="input/SelectionInput" name="Incident.c$new_request_field" required="false" initial_focus="false" label_input="New Request Field">-->
      </div>   
               <div id="btnhide"> <rn:widget path="chat/ChatLaunchButton" 
                    error_location="rn_ErrorLocation" 
                    add_params_to_url="q_id,pac,request_source,p,c,survey_send_id,survey_send_delay,survey_comp_id,survey_term_id,chat_data,survey_term_auth,survey_comp_auth,survey_send_auth,i_id"/></div>
                <br /><br />
            </form>
       </div>
       </rn:condition>
       <rn:widget path="chat/ChatStatus"/>
       
        <div id="hidechat"><rn:widget path="chat/ChatHours"/></div>
        
         <div id="hidechatcustom" style="display:none">  <rn:widget path="custom/chat/ChatHoursCustom" label_chat_hours ="Derm Exclusive Chat hours are listed below."/></div> <br /> 
     <div id="msgshow" style="display:none"> <i> Chat for Derm Exclusive is currently not available.  </i></div>
     
        
    </div>
</div>


