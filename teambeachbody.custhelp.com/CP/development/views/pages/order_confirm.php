<rn:meta title="Order Confirmation" template="standardOrder.php" clickstream="incident_create"/>

<div id="rn_IFrameContent" class="rn_OrderPage">
    <div id="rn_content" class="rn_questionform">
        <div class="rn_wrap">


                <h2>Your Home Direct Order Customization Has Been Submitted</h2>
                <? // This condition should never be null, but just being paranoid ?>
                <rn:condition url_parameter_check="refno != null">
                    <p>
                        Your incident number is <b>#rn:url_param_value:refno#</b>
                    </p>
                </rn:condition>
                <p>
                     The request to customize your Shakeology order has been received and changes will become effective within two business days.
                </p>
                
                
        </div>
    </div>
</div>
