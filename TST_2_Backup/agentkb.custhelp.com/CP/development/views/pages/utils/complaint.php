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
        <form id="rn_QuestionSubmit" method="post" >
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
                    <div class="full">
                        <div class="half first"><rn:widget path="custom/input/TextInputCO" name="Complaint.cf_department" max_length="100" label_input="Agent ID"  required="true"/></div>
                        <div class="half second"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.initiator_type" /></div>
                    </div>
                
                <h4>Customer Information</h4>
                <div class="end"></div>
                <div class="full">
                    <div class="half first"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_first_name" required="true"/></div>
                    <div class="half second"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_last_name"  required="true"/></div>
                </div>
                <div class="full">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_address" label_input="Address" required="true"/>
                </div>
                <div class="full">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_address2" label_input="Address 2"/>
                </div>
				 <div class="full">
                    <div class='above'> 	<rn:widget path="custom/forms/Intlcheck"> </div>
                    <div class="inhalf">
                        <div class="half "><rn:widget path="input/SelectionInput_country" name="Contact.Address.Country" required="true"  /></div>
                        <div class="half " ><rn:widget path="input/SelectionInput_country" name="Contact.Address.StateOrProvince"  required="true"/></div>
                        
                    </div>  
                    <div class="inhalf">
                        <div class="half " style="margin-left: 4%; margin-right:6px;">
						<rn:widget path="custom/input/TextInput_custom" name="Incident.CustomFields.c.pc_city"  label_input='City' required="true"/>
						</div>
                        <div class="half " style='width:46%'>
						<rn:widget path="custom/input/TextInput_custom" name="Incident.CustomFields.c.pc_postal_code"  label_input='Postal Code' required="true"/>
						
						</div>
                    </div> 
                    
                </div>
				 <div class="full">
                    <div class="half first">
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_pc_customer_email"  showna="true" label_input="Email Address" required="true"/>
				
					</div>
                    <div class="half second">
					<rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_customer_phone" label_input="Contact Phone" required="true"/>
					</div>
                </div>
                <div class="full">
                    <div class="half first">
					<rn:widget path="custom/input/TextInputCO" showna="true" name="Complaint.cf_order_num" max_length="50" label_input="Order Number"  required="true"/>
					</div>
                    <div class="half second">
						<rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_customer_num" required="true"/>
					</div>
                </div>
				
				<div class="full">
                    <div class="inhalf">
                        <div class="half ">
						<rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_coach" />
						</div>
                        <div class="half ">
						<rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_coach_id" />	
						</div>
                    </div>
                </div>
				  <h4>Product Information <span id="sku_msg" class="sku_msg rn_Hidden">Please copy and paste the SKU in the SKU box.</span></h4>
                <div class="end"></div>
                <div class="full">
                    <div class="onethird">
					<rn:widget path="custom/input/ProductCategoryInput_custom" name="prod" show_confirm_button_in_dialog="true" label_input="Product" required_lvl="3" selection="include" p_id="947" table="incidents" data_type="Product"/>
					</div>
                    <div class="onethird">
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_sku" max_length="50" label_input="SKU"  />
					
					</div>
                    <div class="onethird last">
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_type" max_length="50" label_input="Type"  />
					</div>
                    
                </div>
				<div class="full">
                    <div class="onethird">
					<rn:widget path="custom/input/TextInputCO" showna="true" name="Complaint.cf_lot_num" max_length="50" label_input="Lot#"  required="true"/>
					</div>
                    <div class="onethird">
					<rn:widget path="custom/input/TextInputCO" datefield="true" showna="true" name="Complaint.cf_expired_date" label_input="Exp Date" required="true" />
					</div>
                    <div class="onethird last">
					<rn:widget path="custom/input/TextInputCO"  datefield="true" showna="true" name="Complaint.cf_date_used" label_input="Date Used" required="true" />
					</div>
                </div> 
				<div class="full">
					<div class="onethird" id="bike_delivery" style="display:none">
					<rn:widget path="custom/input/TextInputCO"  datefield="true"  name="Complaint.cf_date_bike_delivery" label_input="Date of Bike Delivery" showna="true"/>
					</div>
					<div class="onethird" id="osc_incident" style="display:none">
					<rn:widget path="custom/input/TextInputCO"  name="Complaint.cf_osc_incident_number"  max_length="50" label_input="OSC Incident Number" /> 
					</div>
					<div class="onethird last" id="injured_person" style="display:none">
					<rn:widget path="custom/input/TextInputCO"  name="Complaint.cf_injured_person_name"  showna="true" max_length="50" label_input="Injured Person Name" /> 
					</div>
                </div> 
				
				 <div class="full" id="injury_decs" style="display:none"> 
					<rn:widget path="custom/input/TextInputCO"  name="Complaint.cf_injury_description"  showna="true" max_length="255" label_input="Please provide a detailed description of the injury? " /> 
                </div>
				
				 <div class="full">
                    <div class="half first" id="injury_type" style="display:none">
					<rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_injury_type" selection="true"  label_input="What was the type of injury?"/>
                    
					</div>
                    <div class="half second" id="other_text" style="display:none"> 
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_injury_type_other" selection="true"  label_input="Please Describe"/>
					</div>
                </div>
					 <div class="full">
                    <div class="half first" id="injury_part" style="display:none"><rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_injury_part" selection="true"  label_input="Where on your body did the injury occur?"/>
					</div>
					     <div class="half second" id="other_text_injury" style="display:none"> 
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_body_parts_other" selection="true"  label_input="Please Describe"/>
					</div>
                    
                </div>
				<div class="full">
					<div class="half first" id="bike_parts" style="display:none">
					<rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_bike_parts" selection="true"  label_input="What part of the bike was involved in the injury?"/></div>
					 <div class="half second" id="other_text_bike" style="display:none"> 
					<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_bike_parts_other" selection="true"  label_input="Please Describe"/>
					</div>
				 </div>
				 <div class="full">
				    <div class="half first" id="sought_medical_attention" style="display:none">
					 <rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_sought_medical_attention" selection="true"  label_input="Have you sought medical attention? "/></div>
					 <div class="half second" id="medical_attention" style="display:none">
					 <rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_medical_attention" selection="true" label_input="What type of medical attention did you receive?"/></div>
				 </div>
				 	 <div class="full" id="doctors_details" style="display:none">
                    <rn:widget path="custom/input/TextInputCO" name="Complaint.cf_doctors_details" selection="true"  label_input="If professional medical attention was sought, provide the doctor's name, phone, address, city and postal code"/>
                </div>
				 <div class="full">
	                 <div class="half first" id="qca" style="display:none">
					 <rn:widget path="custom/input/SelectionInputCOMenu" name="Complaint.cf_requested_qca" selection="true"  label_input="Has customer requested outreach from Quality Consumer Affairs?"/></div>
				</div>

				 <h4>Complaint</h4>
                <div class="end"></div> 
                       <div class="full">
					    <div id="form_routing" class="onethird" style="display:none">
						<rn:widget path="input/SelectionInput" name="Incident.c$form_routing" label_input="Form Routing" default_value=""/>
						</div>
					</div>
                <div class="full">
                 <rn:widget path="input/FormInput" name="incidents.thread" required="true" label_input="Complaint Details"/>
                </div>   
                <div class="full">
                    <rn:widget path="input/FileAttachmentUpload2"/>
                </div>   
                <div class="full">   
                    <div class="half first">
					<!--<rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_is_return" required="true" selection="true" label_input="Will the customer return the product?"  display_as_checkbox="false"  />-->
					</div>
                </div>
				 <div class="full">
                    <div class="half first">
			<div class="half first">
				
				<rn:widget path="custom/input/ProductCategoryInput_custom" show_confirm_button_in_dialog="true" no_reason_label="Please Select a Reason" reason="true" required_lvl="4" label_nothing_selected="Select a reason" selection="include"  data_type="Category"  p_id="1340" name="prod" label_input="Reason" table="incidents"/>
                <div id ="rc_link">
                	<a href="https://agentkb.custhelp.com/app/answers/detail/a_id/1830/" target="_blank">Definitions for reason codes</a>
                </div>
			</div>
               		</div>
                </div>
                
              <div id="defect_location" style="display:none">
                <rn:widget path="custom/input/ComplaintCustomSelectionInput" name ="incidents.c$location_of_package_damage" label_input="Location of Package Damage" required = "false"/>
                </div>
               
<div id="multiselect" style="display:none">
			<rn:widget path="custom/input/IllnessMenuDisplay"/>
            </div>
			
				<rn:widget path="custom/input/OtherContainer"></rn:widget>
                <rn:widget path="custom/input/HistContainer"></rn:widget>
				<rn:widget path="custom/input/ReasonContainer"></rn:widget>
				<div class="rn_Hidden">
                    <rn:widget path="input/FormInput" name="Incident.CustomFields.c.complaint_routing" default_value="1"/>
                </div>
            <!--    <div class="full">
                    <rn:widget path="input/FormSubmit"  label_button="SubmitStand" on_success_url="/app/utils/complaint_confirm" error_location="rn_ErrorLocation" />
                </div>-->
				<!--<div class="full">
                  <rn:widget path="custom/input/FormSubmit_custom" label_button="Submit" on_success_url="/app/utils/complaint_confirm" error_location="rn_ErrorLocation"  />
                </div>-->

                <div class="full">
                  <rn:widget path="custom/input/FormSubmit_customV2" label_button="Submit" on_success_url="/app/utils/complaint_confirm" error_location="rn_ErrorLocation" />
                </div>
				
            <!--<rn:condition logged_in="false">
                <rn:widget path="input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" initial_focus="true" label_input="#rn:msg:EMAIL_ADDR_LBL#"/>
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" label_input="#rn:msg:SUBJECT_LBL#"/>
            </rn:condition>
            <rn:condition logged_in="true">
                <rn:widget path="input/FormInput" name="Incident.Subject" required="true" initial_focus="true" label_input="#rn:msg:SUBJECT_LBL#"/>
            </rn:condition>
                <rn:widget path="input/FormInput" name="Incident.Threads" required="true" label_input="#rn:msg:QUESTION_LBL#"/>
                <rn:widget path="input/FileAttachmentUpload"/>-->
                <!--<rn:widget path="input/ProductCategoryInput"/>
                <rn:widget path="input/ProductCategoryInput" data_type="Category"/>
                <rn:widget path="input/CustomAllInput" table="Incident"/>-->
                <!--<rn:widget path="input/FormSubmit" label_button="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" error_location="rn_ErrorLocation"/>-->
                <!--<rn:condition answers_viewed="2" searches_done="1">
                <rn:condition_else/>
                    <rn:widget path="input/SmartAssistantDialog"/>
                </rn:condition>-->
        </form>
    </div>
</div>
</div>
<script>

//	document.getElementById("rn_FormSubmit_custom_99_Button").removeAttribute("disabled"); 
    /*document.getElementById("rn_FormSubmit_custom_100_Button").addEventListener("click", function() {
        console.log("checks click");
		if (document.getElementById("rn_FormSubmit_custom_100_Button").hasAttribute("disabled") == true){
            console.log("checks true 1");
        document.getElementById("rn_FormSubmit_custom_100_Button").removeAttribute("disabled"); 
        }
	});

    let answer =  document.getElementById("rn_FormSubmit_custom_100_Button").hasAttribute("disabled");
console.log(document.getElementById("rn_FormSubmit_custom_100_Button").hasAttribute("disabled"));
if (answer==true){
    console.log("checks true");
    document.getElementById("rn_FormSubmit_custom_100_Button").removeAttribute("disabled"); 
    console.log(document.getElementById("rn_FormSubmit_custom_100_Button").hasAttribute("disabled"));
} else if (document.getElementById("rn_FormSubmit_custom_100_Button").hasAttribute("disabled") == false){
    console.log("checks false");
    document.getElementById("rn_FormSubmit_custom_100_Button").removeAttribute("disabled"); 
}
*//*
document.getElementById("rn_FormSubmit_customV1_100_Button").addEventListener("click", function() {

    document.getElementById("rn_FormSubmit_custom_100_Button").classList.add("rn_Hidden"); 
});
*/
/*
document.getElementById("rn_FormSubmit_customV1_100_Button").addEventListener("click", function() {
    var child=document.getElementById("rn_ErrorLocation").firstElementChild;
    console.log(child);
    child.classList.add("rn_Hidden");

        
});*/

</script>