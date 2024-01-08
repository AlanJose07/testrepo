<rn:meta title="Product Complaint Form" template="standardhome.php" clickstream="incident_create"/>
<div class="rn_PageWrapper">
<div id="rn_PageTitle" class="rn_AskQuestion">
    <h2>Product Complaint Form</h2>
        <p>ATTORNEY CLIENT PRIVILEGED COMMUNICATION/CONFIDENTIAL DOCUMENT</p>
</div>
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
        <form id="rn_QuestionSubmit" method="post" >
            <div id="rn_ErrorLocation"></div>
			
			<h4>Initiator Information</h4>
				<div class="end"></div>
                    <div class="full">
                        <div class="half first">
						<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_initiator" max_length="50" label_input="Name"  initial_focus="true" required="true"/>
						</div>
                        <!--<div class="half second"><rn:widget path="custom/input/FormInput_custom" name="team_lead_agent_email"  label_input="Email" required="true"/></div>-->
                    </div>
                    <!--team_lead_agent_email-->
                    <div class="full">
                        <div class="half first"><rn:widget path="custom/input/TextInputCO" name="Complaint.cf_department" max_length="100" label_input="Agent ID"  required="false"/></div>
                     <!--   <div class="half second"><rn:widget path="input/FormInput" name="Incident.CustomFields.c.initiator_type" /></div>-->
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
						<rn:widget path="input/FormInput" name="Incident.CustomFields.c.pc_customer_num" />
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
					<rn:widget path="custom/input/ProductCategoryInput_custom" show_confirm_button_in_dialog="true" label_input="Product" required_lvl="3" selection="include" p_id="947" table="incidents"/>
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
				
				 <h4>Complaint</h4>
                <div class="end"></div> 
                
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
				
				 <rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_first_time_using_product" selection="true"  label_input="First time using product" required="true" />
				 </div>
				 <div class="full">
                    <div class="half first">
			<div class="half first">
				
				<rn:widget path="custom/input/ProductCategoryInput_custom" show_confirm_button_in_dialog="true" no_reason_label="Please Select a Reason" reason="true" required_lvl="4" label_nothing_selected="Select a reason" selection="include"  data_type="Category"  p_id="1340" name="prod" label_input="Reason" table="incidents"/>
                <div id ="rc_link">
                	<a href="https://agentkb.custhelp.com/app/answers/detail/a_id/1570" target="_blank">Definitions for reason codes</a>
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
				
				<div class="full">
                  <rn:widget path="custom/input/FormSubmit_custom" label_button="Submit" on_success_url="/app/utils/complaint_confirm" error_location="rn_ErrorLocation" />
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
