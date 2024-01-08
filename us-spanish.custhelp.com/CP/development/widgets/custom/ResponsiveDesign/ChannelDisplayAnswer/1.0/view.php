
<? if(count( $this->data['answer_details'])>0):?>
<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<h1>Respuestas Rápidas</h1>
<? $j=0;?>
<? for($i=0;$i<count( $this->data['answer_details']);$i++):?>
<?  $id = "rn_{$this->instanceID}_$i";?>
<? if($i==0):?>
<h2 id="open-answer-tag_<?= $i;?>" class="open-tag"><div id="<?= $id?>"><?= $this->data['answer_details'][$i][0];?></div></h2>
<? else:?>
<h2 id="open-answer-tag_<?= $i;?>" class="close-tag"><div id="<?= $id?>"><?= $this->data['answer_details'][$i][0];?></div></h2>
<? endif;?>
<? if($j==0):?>
<div id="solution_<?= $i;?>" style="display:block"><rn:field name="answers.solution" /></div>
<? $j++;?>
<? else:?>
<div id="solution_<?= $i;?>" style="display:none"><rn:field name="answers.solution" /></div>
<? endif;?>
<? endfor;?>
</div>
<div class="divider" class="answer-divider"></div>
<? endif;?>
