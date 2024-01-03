<div id="rn_<?= $this->instanceID ?>" class="<?= $this->classList ?>">
<h2>Email us</h2>
<hr>
<? echo $this->data['email'];?>
<br>
<a href="mailto:<?=$this->data['email'];?>">Send email</a>
<br><br>
<h2>Call us</h2>
<hr>
<? echo $this->data['Answer'];?>
</div>