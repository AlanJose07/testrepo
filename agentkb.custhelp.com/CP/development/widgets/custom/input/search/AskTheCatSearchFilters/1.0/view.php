<rn:meta controller_path="custom/search/AskTheCatSearchFilters" js_path="custom/search/AskTheCatSearchFilters" base_css="custom/search/AskTheCatSearchFilters" />

<!-- Add HTML/PHP view code here -->
<div class="atc-filters-widget">

	<hr />

	<div class="atc-filter-wrapper-outer">
<font size=3>
<b>Please check only one</b> </font>
<br></br>


		<div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Customer Service" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div>

		<div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Coach Relations" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div>
		<div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Telesales" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div>


                <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Beauty" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
		</div>


                <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="UK" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
			</div>
			
			 <div class="atc-filter-wrapper-inner">
			<rn:widget path="custom/search/FilterCheckbox" filter_name="Cert" report_id="#rn:php:intval($this->data['attrs']['report_id'])#" />
			</div>

	</div>
	
	<hr />

</div>

