<?php if ($pesquisa_resultado) { foreach ($pesquisa_resultado as $row) {?>
<hr>
<a href="<?php echo $row->atm_url; ?>">
<div class="row-fluid">
	<div class="span4">
		<img alt="<?php echo $row->tft_titulo; ?>" src="<?php echo $row->tft_url; ?>" width="150" height="150">
	</div>
	<div class="span8">
		<div class="row">
			<div class="span10"><?php echo $row->atm_titulo; ?></div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $row->atm_descricao; ?></div>
		</div>
	</div>
</div>
</a>
<hr>
<?php }} ?>