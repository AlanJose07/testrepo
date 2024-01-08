
<rn:meta title="Order" template="standardOrder.php" clickstream="incident_create"/>

<div id="rn_IFrameContent" class="rn_OrderPage">
    <div id="rn_content" class="rn_questionform">
        <div class="rn_wrap">

            <form id="rn_OrderSubmit" method="post" action="" onsubmit="return false;">
            	<div style="display:none">
	            	<rn:widget path="standard/input/FormInput" name="Incidents.Subject" label_input="Subject" default_value="Edit Shakeology Home Direct Order" />
            	</div>
                <div class='portal_topper'>Customize Shakeology Home Direct</div>
                <p><strong>
                        Changes become effective <span style="text-decoration: underline">within two business days of "Save Changes"</span>. Please contact Customer Service at 1-800-427-3809 if you
                        have a Home Direct Order scheduled to process prior to this time frame.
                    </strong></p>
                <div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>

                <div id="rn_Padding" class="rn_CoachArea rn_ClearBoth">
                    <h4>Customer Information</h4>
                    <div id="rn_Padding" class="rn_Grid">
                        <table>
                            <tr>
                                <td><rn:widget path="standard/input/FormInput" name="Contact.Name.First" required="true" label_input ="First Name" /></td>
                            <td><rn:widget path="standard/input/FormInput" name="Contact.Name.Last" required="true" label_input ="Last Name"/></td> 
                            </tr>
                            <tr> 
                                <td><rn:widget path="standard/input/FormInput" name="Contact.Emails.PRIMARY.Address" required="true" label_input="Email Address"/></td> 
                            <td><rn:widget path="standard/input/FormInput" name="Contact.Phones.HOME.Number" required="true" label_input ="Home Phone" /></td> 
                            </tr>
                            
                        </table>
 
                       <div class="rn_Italics">(Used to verify your identity.)</div>
<!--                     <rn:widget path="standard/input/FormInput" name="incidents.c$flavor_change_desc" label_input="Notes" required="false" />  -->

                    </div>
                </div>

                <div id="rn_Padding" class="rn_HDOrderArea">
                    <h4>Shakeology HD Order</h4>
                    <div id="rn_Padding">
                        <div class="rn_ShakeologyHDOrder">
                            Please describe your current order (the order you would like to modify).
                        </div>
                        <div class="rn_Grid">
                           <table>
                                <tr>
                                    <td><rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.current_flavor" required="true" /></td>
                                    <td><rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.current_ship_day" required="true" /></td> 
                                    <td><rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.current_zip" required="true" /></td>
                                </tr>
                            </table>
                        </div>
                         <div class="rn_Grid">
                            <table>
                                <tr>
                                    <td>
                       
					   
                        <rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.reason_for_change" label_input="Reason for Change" required="true"/> 
							</td>
                                    <td>
						<div id="rn_please_explain" class="rn_EditSelection rn_Hidden">
						<rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.please_explain" label_input="Please Explain" required="false" />
						</div>
									</td> 
                                   
                                </tr>
                            </table>
						</div>
                        <div id="rn_ChangeOptions" class="rn_EditSelection rn_Hidden">
						<div id="txt_display">
					    	<p>Only update the portion you want to modify. For example, if you only want to change your shipping date, then only change the shipping date drop-down menu.</p></div>
					    	<div id="input_wrapper">
					            <table class="rn_EditSelectionFlavors">
					                <tr>
					                    <td>
					                    	<rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.flavor1" label_input="New Shakeology Flavor:" required="true" />
					                 	<div class="rn_Hidden">
                    	<rn:widget path="custom/input/SelectionInputHidden" name="Incident.CustomFields.c.flavor1"/>
						
                    </div>
					                    </td>
					                </tr>
					            </table>
					
					 <rn:widget path="custom/input/ShippingDateSelectionInput_Cust" name="incidents.shippingdate" label_input="New Shipping Date:" required="true"/>
					 <rn:widget path="custom/input/ShippingAddressSelectionInputCustom"  name="incidents.shippingaddress" label_input="New Shipping Address:" required="true"/>
                      <div class="rn_Hidden">
                                  <rn:widget path="custom/input/SelectionInputShippingNewAddress" name="incidents.c$new_address" required="false" default_value="0" />
                      </div>
<br>
                            
					        </div>
					    </div>
						
						<!--
                        <div class="rn_ShakeologyHDOrder">
                            Only update the portion you want to modify. For example if you only want to change
                            your shipping date, select "Edit" from the pulldown menu and only change the shipping date menu option.
                        </div>						
						<rn:widget path="custom/input/EditCancelSelectionInput" name="incidents.subject" label_input="Edit/Cancel" required="true"/>
                        -->
                    </div>
                 <div class="rn_Hidden">
                    	<rn:widget path="input/SelectionInput" name="Incident.CustomFields.c.shakemodtype" default_id="283"/>
                    </div>
				
                    <p id="rn_CancelContent">
                        Please note, if the desired combination is not listed or to process a cancellation, please contact Customer Service at 1-800-427-3809.
                    </p>
					<div id="rn_ErrorLocation"></div>
				<!-- Removed for Version upgrade 	 <rn:widget path="custom/input/FormSubmit_custom" error_location="rn_ErrorLocation" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/cust_order_confirm" />-->
                </div>
                
            </form>

        </div>
    </div>
</div>