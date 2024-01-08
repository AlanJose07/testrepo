<style type="text/css">legend[class="rn_Label"]{width:214px;}
legend[class="rn_Label rn_ErrorLabel"]{width:214px;}
</style>
<div>
<div class="full">
            <div id="HistContainer20" class="onethird">
            <rn:widget path="custom/input/SelectionInputCOTest" name="Complaint.cf_first_noticed_symptoms" selection="true"  label_input="First noticed symptoms" required="false" />
			
			</div>
            <div id="HistContainer21" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.first_noticed_symp_other_notes" label_input="Other Notes" max_length="4000"  />
			</div>
			</div>
			
			
			  <div class="full">
			
			
            <div id="HistContainer10" class="onethird">
             <rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_duration_symptoms" selection="true"  label_input="Duration of symptoms" required="true" />
			</div>
            <div id="HistContainer11" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_other_notes" label_input="Other Notes" max_length="4000"  />
			</div>
        </div>

		
       <div class="full">
            <div id="HistContainer" class="onethird">
             <rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_other_hist" selection="true"  label_input="Using other Products?" required="true" />
			</div>
            <div id="HistContainer2" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_other_desc" label_input="Describe" max_length="4000"  />
			</div>
        </div>

			<div class="full">
            <div id="HistContainer3" class="onethird">
			<rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_meds_hist" selection="true"  label_input="Taking Medications?" required="true" />
			</div>
            <div id="HistContainer4" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_meds_desc" label_input="Describe"  max_length="4000" />
			</div>
        </div>
			
         <div class="full">
            <div id="HistContainer5" class="onethird">
				<rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_allergies_hist" selection="true"  label_input="Allergies?" required="true"/>
			</div>
            <div id="HistContainer6" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_allergies_desc" label_input="Describe" max_length="4000"/>
			</div>
        </div>
			
			 <div class="full">
            <div id="HistContainer7" class="onethird">
			<rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_condition_hist" display_as_checkbox="false" selection="true"  label_input="Medical Conditions?" required="true"/>
			</div>
            <div id="HistContainer8" class="twothird">
		<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_condition_desc" label_input="Describe" max_length="4000"/>
			</div>
        </div>
        <div class="full">
 <div id="HistContainer12" class="onethird">
             <rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_injury_compensation" selection="true"  label_input="Does customer request compensation other than a refund or reshipment?" required="true" />
			</div>
            <div id="HistContainer13" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_injury_comp_desc" label_input="Describe:" max_length="4000"  />
			</div>
        </div>
        
        <div class="full">
         <div id="HistContainer9" class="onethird">
			<rn:widget path="custom/input/SelectionInputCO" name="Complaint.cf_attention_hist" display_as_checkbox="false"  selection="true" label_input="Obtained medical attention?" required="false"/>
			</div>
            <div id="HistContainer0" class="twothird">
			<rn:widget path="custom/input/TextInputCO" name="Complaint.cf_attention_desc" label_input="Describe (Include the doctor's name, phone, address, city and postal code)" max_length="4000"/>
			</div>
        </div>
			
</div>			