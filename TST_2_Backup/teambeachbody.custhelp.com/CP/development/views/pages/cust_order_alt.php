
<rn:meta title="Order" template="standardOrder.php" clickstream="incident_create"/>

<div id="rn_IFrameContent" class="rn_OrderPage">
    <div id="rn_content" class="rn_questionform">
        <div class="rn_wrap">

            <form id="rn_OrderSubmit" method="post" action="" onsubmit="return false;">
            	<div style="display:none">
	            	<rn:widget path="standard/input/FormInput" name="incidents.subject" label_input="Subject" default_value="Edit Shakeology Home Direct Order" />
            	</div>
                <div class='portal_topper'>Customize Shakeology Home Direct</div>
                <p><strong> 
                        All requested changes become effective within two business days. Please contact Customer Service at 1-800-427-3809 if you have a Home Direct Order scheduled to process before to this time frame. 
                    </strong></p>
                <div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
                <div id="rn_ErrorLocation"></div>
                <div id="rn_Padding" class="rn_CoachArea rn_ClearBoth">
                    <h4>Customer Information</h4>
                    <div id="rn_Padding" class="rn_Grid">
                        <table >
                            <tr>
                                <td>
							<rn:widget path="standard/input/FormInput" label_input="
First Name" name="contacts.first_name" required="true" />
								 </td>
                            <td>
						<rn:widget path="standard/input/FormInput" label_input="
Last Name"  name="contacts.last_name" required="true" />
						  </td> 
                            </tr>
                            <tr>
                            <td>
								<rn:widget path="standard/input/FormInput" name="contacts.email" label_input="Email Address"   required="true" />
								</td> 
                            <td>    
							<rn:widget path="standard/input/FormInput" label_input="Home Phone"   name="contacts.ph_home" required="true" />
							</td> 
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
                            Please describe your current order (the order you would like to modify). You can determine the Current Ship Day by reviewing the details of your last Home Direct order. Providing this information helps us customize the correct Home Direct order if you have more than one Home Direct order per month. If you only have one Home Direct order per month then an approximate date is acceptable. 
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
                                    <td valign="top">
									<rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.reason_for_change" label_input="Reason for Change" required="true"/>
									</td>
                                    <td>
									   <div id="rn_please_explain" class="rn_EditSelection rn_Hidden" >
									<rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.please_explain" label_input="Please Explain" required="false" />
									</div>
									</td> 
                                   
                                </tr>
                            </table>
                        </div>
                        
                        
                        
                        <div id="rn_ChangeOptions" class="rn_EditSelection rn_Hidden">
					    	<p>Only update the portion you want to modify. For example, if you only want to change your shipping date, then only change the shipping date drop-down menu.</p>
					    	<div id="input_wrapper">
					            <table class="rn_EditSelectionFlavors">
					                <tr>
					                    <td>
					                    	<rn:widget path="custom/input/CurrentFlavorInput" name="incidents.c$flavor1" label_input="New Shakeology Flavor:" required="true"/>
										 <div class="rn_Hidden">	
					<rn:widget path="custom/input/SelectionInputHidden" name="Incident.CustomFields.c.flavor1"/>
											</div>
					    
					                    </td>
					                </tr>
					            </table>
					            <rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.ordermodtype" label_input="Would you like the change to be a one time or ongoing?"  />
								
								 <div class="rn_Hidden">	
					<rn:widget path="custom/input/SelectionInputHidden" default_value="291" name="Incident.CustomFields.c.ordermodtype" />
											</div>
								
					            <div id="ordermodtype" class="ordermodtype rn_Hidden">Please Note: Address changes are not permitted when requesting a one-time Shakeology flavor change.</div>
					            
					            <div class="" id="shippingdiv">
							  <rn:widget path="custom/input/ShippingDateSelectionInput_Cust"  name="incidents.shippingdate" label_input="New Shipping Date:" required="true"/> 
							
							  <rn:widget path="custom/input/ShippingAddressSelectionInputCustom"  name="incidents.shippingaddress" label_input="New Shipping Address:" required="true"/> 
							  <div class="rn_Hidden">
                                  <rn:widget path="custom/input/SelectionInputShippingNewAddress" name="Incident.CustomFields.c.new_address" required="false" default_value="0" />
                                </div>
					            </div>
<br>
                            
					        </div>
					    </div>
						
						
                    </div>
                    <div class="rn_Hidden">
                    
				<rn:widget path="input/SelectionInput"  name="Incident.CustomFields.c.shakemodtype" default_value ="286" />
                    </div>
                    <p id="rn_CancelContent">
                        Please note, if the desired combination is not listed or to process a cancellation, please contact Customer Service at 1-800-427-3809.
                    </p>
                </div>
				
        <!-- Removed for Version upgrade   <rn:widget path="custom/input/FormSubmit_custom" error_location="rn_ErrorLocation" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/cust_order_confirm" /> -->
            </form>

        </div>
    </div>
</div>