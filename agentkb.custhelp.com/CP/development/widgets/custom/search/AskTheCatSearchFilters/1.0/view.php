<rn:meta controller_path="custom/search/AskTheCatSearchFilters" js_path="custom/search/AskTheCatSearchFilters" base_css="custom/search/AskTheCatSearchFilters" />

<!-- Add HTML/PHP view code here -->
<div class="atc-filters-widget">

	<hr />

	<div class="atc-filter-wrapper-outer">
<font size=3>
<b>Please check only one</b> </font>
<br></br>


		<div class="atc-filter-wrapper-inner beachbody">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Beachbody" report_id="#rn:php:intval($this->data['attrs']['report_id'])#"  class="beachbody" id="beachbody"/>
		</div>

		<!-- <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Coach Relations" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div> 

              <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Beauty" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div>


                <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="UK" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
			</div>
			
			 <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Cert" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
			</div>-->
			
			
			<div class="atc-filter-wrapper-inner ladder">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Ladder" report_id="#rn:php:intval($this->data['attrs']['report_id'])#"  class="ladder" id="ladder"/>
			</div>

			<div class="atc-filter-wrapper-inner myx">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="MYX Fitness" report_id="#rn:php:intval($this->data['attrs']['report_id'])#"  class="myx" id="myx"/>
			</div>
			
			<div class="atc-filter-wrapper-inner training">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Training Team ONLY" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" class="training" id="training"/>
			</div>

	</div>
	
	<hr />

</div>
<!--
<script>
$(document).ready(function() {
  $(document).on('change', ".check_class", function () {
    $(".check_class").prop("checked", false);
    $(this).prop("checked", true);
  });
});
</script> 
<script type="text/javascript">
		$(document).ready(function () {
			$('#btnUncheckAll').click(function () {
				$('input[type=checkbox]').each(
				function (index, checkbox) {
					if (index != 0) {
						checkbox.checked = false;
					}
				});
			});
		});
	</script>-->

