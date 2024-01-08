<?php
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
?>
<style>
.rn_ErrorMessage
{
	clear:both;
}
.rn_DisplayButton{
    padding: 10px 16px;
    color: white;
    background-color: gray;
    border: #999;
    font-size: 1.2em;
}
</style>
<link type="text/css" rel="stylesheet" href="/rnt/rnw/yui_3.8/gallery-treeview/assets/treeview-menu.css">
<rn:meta title="Product Complaint Form" template="standardhome.php" clickstream="incident_create"/>
<div class="rn_PageWrapper">
<div id="rn_PageTitle" class="rn_AskQuestion">
    <h2>Product Complaint Form</h2>
        <p>ATTORNEY CLIENT PRIVILEGED COMMUNICATION/CONFIDENTIAL DOCUMENT</p>
</div>
<div class="rn_myxhead">
<h4 style="color:red; position: relative; top: -13px;">For MYX-related contacts, all agents must follow<a target="_blank" href="<?= "https://agentkb.custhelp.com/app/answers/detail/a_id/8904"?>" style="color: #0000ff; background-color: #ffffff;padding-left:2px;">KB 8904</a>.</h4>
</div>
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="QuestionSubmit" method="post" >
       <div id="rn_ErrorLocation"></div>
			
			<h4>Team Lead/Agent Information</h4>
				<div class="end"></div>
                    <div class="full">
                        <div class="half first">
						<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_initiator" max_length="50" label_input="Team Lead/Agent Name"  initial_focus="true" required="true"/>
						</div>
                        <!--<div class="half second"><rn:widget path="custom/input/FormInput_custom" name="team_lead_agent_email"  label_input="Email" required="true"/></div>-->
                    </div>
                    <!--team_lead_agent_email-->
                           
                <h4>Customer Information</h4>
                <div class="end"></div>
                <div class="full">
                    <div class="half first"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_first_name" required="true"/></div>
                    <div class="half second"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_last_name"  required="true"/></div>
                </div>
					<br>
                     <div class="full">
                  <rn:widget path="custom/input/FormSubmit_customV2" label_button="Submit test" on_success_url="/app/utils/complaint_confirm" error_location="rn_ErrorLocation" />
                </div>
        </form>
    </div>
</div>
</div>
