<?php if ($pesquisa_resultado) { foreach ($pesquisa_resultado as $row) {?>
<hr>
<div class="row-fluid">
	<div class="span4">
		<img alt="<?php echo $row->acf_titulo; ?>" src="<?php echo $row->acf_url; ?>">
	</div>
	<div class="span8">
		<div class="row">
			<div class="span8"><?php echo $row->ac_title; ?></div>
			<div class="span2"><?php echo $row->ac_preco; ?></div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $row->ac_descricao; ?></div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $row->cd_descricao . "/" . $row->es_descricao; ?></div>
		</div>
	</div>
</div>
<hr>
<?php }} ?>