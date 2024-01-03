<ul class="reasonCancellation">
 <rn:block id="preRadioLabel"/>
 <?= $this->data['attrs']['label_input'] ?>
 <br/>
 <br/>
 <? if ($this->data['attrs']['label_input'] && $this->data['attrs']['required']): ?>
                    <rn:block id="preRequired"/>
                    <?php /*?><span class="rn_Required"><?= \RightNow\Utils\Config::getMessage(FIELD_REQUIRED_MARK_LBL) ?></span><span class="rn_ScreenReaderOnly"> <?= \RightNow\Utils\Config::getMessage(REQUIRED_LBL)?></span><?php */?>
                    <rn:block id="postRequired"/>
                <? endif; ?>
<?
 $radio_limit = $this->data['js']['radioitems_count']-1;
	$lbl=$this->data['cat'];
	
		
		for($i=0;$i<=$radio_limit;$i++):
		
		$cat = each($lbl);
		
		?>
		<li>
		<?
				
                $id = "rn_{$this->instanceID}_$i";
				 ?>
            <rn:block id="preRadioInput"/>
              <input type="radio" name="cat_radio" id="<?= $id ?>" value="<?=$cat['value'] ?>"/><?= $cat['value']?>
            <rn:block id="postRadioInput"/>
           
           
            <rn:block id="postRadioLabel"/>
		
		</li>
		
		
		
		
        <? endfor; ?>
		</ul>