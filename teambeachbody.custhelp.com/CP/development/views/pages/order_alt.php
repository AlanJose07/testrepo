
<rn:meta title="Order" template="standardOrder.php" clickstream="incident_create"/>

<div id="rn_IFrameContent" class="rn_OrderPage">
    <div id="rn_content" class="rn_questionform">
        <div class="rn_wrap">

            <form id="rn_OrderSubmit" method="post" action="" onsubmit="return false;">
            	<div style="display:none">
	            	<rn:widget path="standard/input/FormInput" name="incidents.subject" label_input="Subject" default_value="Edit Shakeology Home Direct Order" />
            	</div>
                <h2>Customize Shakeology Home Direct</h2>
                <div id="spCoachHeader" style="display:none;">
				<p><strong>
                        All requested changes become effective within two business days. Please contact Coach Relations at 1-800-240-0913 if you have a Home Direct Order scheduled to process before to this time frame. 
                    </strong></p>
					</div>
				  <div id="spCustomerHeader" style="display:none;">
				<p><strong>
                        All requested changes become effective within two business days. Please contact Customer Service at 1-800-427-3809 if you have a Home Direct Order scheduled to process before to this time frame.
                    </strong></p>
					</div>	
                <div class="rn_RequiredText rn_FloatRight">*&nbsp;Required Field</div>
                <div id="rn_ErrorLocation"></div>
                <div style="padding-left:10px">
				 <!--<rn:widget path="input/SelectionInputMemberType" name="Contact.Address.Country" required="true"/>-->                	 <rn:widget path="input/countrySelectionInput" name="Contact.Address.Country" required="true"/>
                 <rn:widget path="input/SelectionInputMemberType" name="Incident.CustomFields.c.member_type" required="true"/>
                </div>
                <div id="rn_Padding" class="rn_CoachArea rn_ClearBoth">
                 <!-- <h4>Coach Information</h4>-->
                    <div id="rn_Padding2" class="rn_Grid">
                        <table>
                            <tr>
                                <td>
				<rn:widget path="standard/input/FormInput" name="Contact.Name.First" label_input="
First Name" required="true" /></td>
                            <td>
				<rn:widget path="standard/input/FormInput" label_input ="Last Name" name="Contact.Name.Last" required="true" /></td> 
                            </tr>
                            <tr>
                                <td>
				<rn:widget path="standard/input/FormInput" name="Contact.Emails.PRIMARY.Address" label_input="Email Address" required="true" /></td> 
                            <td>
					<rn:widget path="standard/input/FormInput" name="Contact.Phones.HOME.Number" label_input ="Home Phone" required="true" /></td> 
                            </tr>
                            <tr>
                                <td>
                     <div id="divcoachid" style="display:none">       <rn:widget path="custom/input/TextInputCustom" name="Incident.CustomFields.c.coachcustomernumber" required="false" label_input="Coach ID *" /> </div>
                            </td>
                            <td>
							
                             <div id="divssn"  style="display:none"> 
                             <rn:widget path="custom/input/customTextInpuSSN" name="Incident.CustomFields.c.last_four_ssn" required="false"  label_input = "Last 4 digits of social security number *" always_show_mask="false" /> </div>
                            </td>
                            </tr>
                        </table>
 
                       <div class="rn_Italics">(Used to verify your identity.)</div>
<!--                     <rn:widget path="standard/input/FormInput" name="incidents.c$flavor_change_desc" label_input="Notes" required="false" />  -->

                    </div>
                </div>

                <div id="rn_Padding" class="rn_HDOrderArea">
                    <!--<rn:widget path="custom/input/CheckFlavorSelect" />-->
                    <h4>Shakeology HD Order</h4>
                    <div id="rn_Padding">
                        <div class="rn_ShakeologyHDOrder">
                            Please describe your current order (the order you would like to modify). You can determine the Current Ship Day by reviewing the details of your last Home Direct order. Providing this information helps us customize the correct Home Direct order if you have more than one Home Direct order per month. If you only have one Home Direct order per month then an approximate date is acceptable. </div>
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
					            <table id="edit_flavors" class="rn_EditSelectionFlavors">
					                <tr>
					                    <td>
					                     	<rn:widget path="custom/input/CurrentFlavorInput" name="incidents.c$flavor1" label_input="New Shakeology Flavor:" required="true"/>
									<!--	 <div class="rn_Hidden">	
					<rn:widget path="custom/input/SelectionInputHidden" name="Incident.CustomFields.c.flavor1"/>
											</div> -->
					                    </td>
					                </tr>
					            </table>
								     <rn:widget path="custom/input/CurrentFlavorInput" name="Incident.CustomFields.c.ordermodtype" label_input="Would you like the change to be a one time or ongoing?"  />
								
								 <div class="rn_Hidden">	
					<rn:widget path="custom/input/SelectionInputHidden" default_value="291" name="Incident.CustomFields.c.ordermodtype" />
										</div>
					            
					            <div id="ordermodtype" class="ordermodtype rn_Hidden">Please note: address changes are not permitted when requesting a one-time Shakeology flavor change.</div>
					            
					            <div class="" id="shippingdiv">
					                  <rn:widget path="custom/input/ShippingDateSelectionInput"  name="incidents.shippingdate" label_input="New Shipping Date:" required="true"/> 
							  
					            	  <rn:widget path="custom/input/ShippingAddressSelectionInputCustom"  name="incidents.shippingaddress" label_input="New Shipping Address:" required="true"/> 
							  <div class="rn_Hidden">
                                  <rn:widget path="custom/input/SelectionInputShippingNewAddress" name="Incident.CustomFields.c.new_address" required="false" default_value="0" />
                                </div>
					            	
					            	<rn:widget path="standard/input/FormInput" name="Incident.CustomFields.c.shakeology_hd_order_delay" required="true" label_input="Would you lke to delay your Shakeology Home Direct order?" />
									<br/>
                           			    </div>
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
                   <div id="divcoachnote" style="display:none"> <p class="rn_ShakeologyHDOrder rn_Wrapper">
                        <strong><span style="color: red">Please be advised that a Home Direct Order Modification or delay may impact your active status, rank and qualifications for contests and promotions such as Success Club. </span></strong>
                    </p> </div>
					<div id="spCoach" style="display:none;">
                    <p id="rn_CancelContent" >
                        Please note, if the desired combination is not listed or to process a cancellation, please contact 
						coach relations at 1-800-240-0913.
                    </p>
					</div>
					<div id="spCustomer" style="display:none;">
                    <p id="rn_CancelContent">
                        Please note, if the desired combination is not listed or to process a cancellation, please contact  Customer Service at 1-800-427-3809.
                    </p>
					</div>
					
                    <div class="rn_Hidden">
     		<rn:widget path="input/SelectionInputMemberType"  name="Incident.CustomFields.c.shakemodtype"  />
                    </div>
                </div>
               
                <rn:widget path="custom/input/OrderFormSubmit" error_location="rn_ErrorLocation" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/order_confirm" /> 
              
              <!--  <div id="divcust_submit" style="display:none">
                 <rn:widget path="custom/input/FormSubmit_custom" error_location="rn_ErrorLocation" label="#rn:msg:SUBMIT_CMD#" on_success_url="/app/cust_order_confirm" /> </div>-->
            </form>

        </div>
    </div>
</div>