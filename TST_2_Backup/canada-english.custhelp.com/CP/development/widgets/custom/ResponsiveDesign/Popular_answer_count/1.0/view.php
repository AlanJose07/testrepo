<? /* Overriding Multiline's view */ ?>

<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
		<? if(count($this->data['reportData']['data'])>0):?>
			<?  $id = "rn_{$this->instanceID}_0";?>
			<div class="view-more" id="most_popular_answer"> <a href="javascript:void(0);" id="<?= $id;?>" class="more_popular_class">View Most Popular Answers <i class="fa fa-angle-right"></i></a> </div>
		<? endif;?>
</div>