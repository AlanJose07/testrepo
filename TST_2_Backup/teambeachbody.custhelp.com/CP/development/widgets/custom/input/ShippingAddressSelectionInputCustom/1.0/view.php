<!--
<rn:block id='SelectionInput-top'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preRequired'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postRequired'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-inputTop'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-inputBottom'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preRequired'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postRequired'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preRadioInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postRadioInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preRadioLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postRadioLabel'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postInput'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-preHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-postHint'>

</rn:block>
-->

<!--
<rn:block id='SelectionInput-bottom'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-top'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-label'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-value'>

</rn:block>
-->

<!--
<rn:block id='FieldDisplay-bottom'>

</rn:block>
-->

<rn:block id='bottom'>
<br/><br/>

<div id="rn_<?=$this->instanceID;?>_EditSelection" class="rn_EditSelection rn_Hidden">
        <div id="rn_ShippingText">
            Shipping Information
        </div>
        <div class="rn_Hidden">
        <!--	<rn:widget path="custom/input/ShippingChangedSelectionInput" name="incidents.c$new_address" required="false" default_value="0" /> -->
        </div>
        <div id="rn_ShippingAddress">
            <table>
                <tr>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_first_name" id="rn_<?=$this->instanceID;?>_first_name_Label" class="rn_Label">First Name
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_first_name" name="first_name" class="rn_Text" />
                        </div>
                    </td>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_last_name" id="rn_<?=$this->instanceID;?>_last_name_Label" class="rn_Label">Last Name
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_last_name" name="last_name" class="rn_Text" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="rn_TextInput rn_TextInputWide">
                            <label for="rn_<?=$this->instanceID;?>_address" id="rn_<?=$this->instanceID;?>_address_Label" class="rn_Label">Address
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_address" name="address" class="rn_Text" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="rn_TextInput rn_TextInputWide">
                            <label for="rn_<?=$this->instanceID;?>_apt" id="rn_<?=$this->instanceID;?>_apt_Label" class="rn_Label">Apt., Suite, etc.
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_apt" name="apt" class="rn_Text" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_city" id="rn_<?=$this->instanceID;?>_city_Label" class="rn_Label">City
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_city" name="city" class="rn_Text" />
                        </div>
                    </td>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_province" id="rn_<?=$this->instanceID;?>_province_Label" class="rn_Label">State/Province
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_province" name="province" class="rn_Text" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_zip" id="rn_<?=$this->instanceID;?>_zip_Label" class="rn_Label">ZIP/Postal code
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_zip" name="zip" class="rn_Text" />
                        </div>
                    </td>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_country" id="rn_<?=$this->instanceID;?>_country_Label" class="rn_Label">Country
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_country" name="country" class="rn_Text" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_phone" id="rn_<?=$this->instanceID;?>_phone_Label" class="rn_Label">Phone number
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_phone" name="phone" class="rn_Text" />
                        </div>
                    </td>
                    <td>
                        <div class="rn_TextInput_Empty">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="rn_TextInput">
                            <label for="rn_<?=$this->instanceID;?>_email" id="rn_<?=$this->instanceID;?>_email_Label" class="rn_Label">Contact Email Address
                            <span class="rn_Required"> * </span><span class="rn_ScreenReaderOnly"><?=getMessage(REQUIRED_LBL)?></span>
                            </label>
                            <input type="text" id="rn_<?=$this->instanceID;?>_email" name="email" class="rn_Text" />
                        </div>
                    </td>
                    <td>
                        <div class="rn_TextInput_Empty">
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


</rn:block>
