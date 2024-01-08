<rn:meta title="Product Complaint Form" template="standardhome.php" clickstream="incident_confirm"/>

<div id="rn_PageTitle" class="rn_AskQuestion">
    <h2>Your complaint has been submitted.</h2>
</div>
<div id="rn_PageContent" class="rn_AskQuestion">
    <div class="rn_Padding">
      <p>
            The following reference number has been assigned:
            <b>
                <rn:condition url_parameter_check="i_id == null">
                    ##rn:url_param_value:refno#
                <rn:condition_else/>
                    #<rn:field name="Incident.ReferenceNumber" />
                </rn:condition>
            </b>
        </p>
        <p>
            Click <a href='/app/utils/complaint'>Here</a> to enter another complaint.
        </p>
        <p>
            <a href='/app/home'>Return to AgentKB home</a>.
        </p>
    </div>
</div>
