<rn:meta title="#rn:msg:ASK_QUESTION_HDG#" template="standard.php" clickstream="incident_create"/>

<div id="rn_masthead" class="rn_askquestion">
  <div class="rn_iconwrap">
	<h1>#rn:msg:ASK_QUESTION_HDG#</h1>


  </div> <!-- class="rn_iconwrap" -->
  <div class="mastheadintro">
        <p>#rn:msg:SUBMIT_QUESTION_TECHNICAL_SUPPORT_CMD#&nbsp;</p>
  </div> <!-- class="mastheadintro" -->
</div> <!-- id="rn_masthead" -->

<div id="rn_content" class="rn_questionform">
  <div class="rn_wrap">
	<div class="rn_list_form">         
		<rn:widget path="standard/forms/FormOpen" />


		<h2>#rn:msg:SUBMIT_YOUR_QUESTION_CMD#</h2>

		<p><span class="rn_required">*&nbsp;</span>#rn:msg:REQD_FIELD_MSG#</p> 

	   
		<? // ask a question custom widget ?>
		<rn:widget path="custom/customAAQ/EmailInput" />
		
		<fieldset>
		  <legend>#rn:msg:YOUR_QUESTION_LBL#</legend>
		  <table class="rn_table_layout_ie7">
			<rn:widget path="standard/field/Input" table="incidents" field_name="subject" required="true" label="#rn:msg:SUBJECT_LBL#" /> <rn:widget path="standard/field/Input" table="incidents" field_name="thread" required="true" label="#rn:msg:QUESTION_LBL#" />
		  </table>
		</fieldset>
		<fieldset>
		  <legend>#rn:msg:ADDTL_INFO_HDG#</legend>
		  <table class="rn_table_layout_ie7">
         <rn:widget path="standard/forms/MenuFilterForm" label="#rn:msg:PRODUCT_LBL#" required_lvl="1" />    
         <rn:widget path="standard/forms/MenuFilterForm" data_type="categories" label="#rn:msg:CATEGORY_LBL#" required_lvl="1" />  
			<rn:widget path="standard/field/InputCustomAll" table="incidents" always_show_mask="true"/>
		  </table>
		</fieldset>
		<fieldset>
		  <legend>#rn:msg:ATTACH_DOCUMENTS_LBL#</legend>
		  <rn:widget path="standard/utils/FileAttachmentUpload" label="" />
		</fieldset>
		<fieldset  id="theFormButton">
		  <legend>#rn:msg:WHEN_DONE_HDG#</legend>
		  <p class="rn_buttonwrap"> 

			<!-- <rn:widget path="custom/customAAQ/CustomFormButton" label="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" /> -->

<rn:widget 
path="standard/forms/FormButton"
label="#rn:msg:CONTINUE_ELLIPSIS_CMD#" on_success_url="/app/ask_confirm" />


		  </p>
		</fieldset>
	  </form>
	</div>
	<!-- class="rn_list_form" -->
  </div>
  <!-- class="rn_wrap" -->
</div>

<? //Custom AAQ Widget, Custom Fields ?>
<rn:widget required="true" path="custom/customAAQ/CustomFields" />  
