
<?php 

if($this->data['Message']!=''){

		if(!$_COOKIE['servicealertclosecookie'])
		{
				?>
				<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?> service_alert" style="display:block">
				<?  $id = "rn_{$this->instanceID}_0"; ?>
				
						<div class="message">
								<div class="message-text">
								<?= $this->data['Message'] ?>
								</div>
								<div class="message-close" id="service-alert-close-messagebox">
										<svg style="width:24px;height:24px" viewBox="0 0 24 24">
										  <path fill="#000000" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
										</svg>
								</div> 
						</div>
				</div> 
				<?php
		}
		else
		{
				$this->data['Message']=""; 
		}

}
?>
 
<style>
	.message {
		  width: 100%;
		  display: flex;
		  align-items: center;
		  padding: 20px;
		  background: #CFD8DC;
		  transition: 400ms;
		  font-size:1.15em;
		  position: fixed;
		    left: 0;
		    bottom: 0;
			z-index:1000;
			color: red;
		}

</style>

