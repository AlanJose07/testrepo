<rn:meta controller_path="custom/opa/OPAWidget" js_path="custom/opa/OPAWidget" base_css="custom/opa/OPAWidget" presentation_css="widgetCss/OPAWidget.css"/>

<iframe src="<?=$this->data['url']?>" frameborder="0" style="height:600px; width: 100%">
	<!-- this is a fix for cobrowsing OPA. Do not remove -->
	<?php 
		echo '<script src="'.$this->data['opaURL'].'" type="text/javascript"></script>';
	?>
</iframe>
