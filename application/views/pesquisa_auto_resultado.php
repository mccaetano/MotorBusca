<?php if ($pesquisa_resultado) { foreach ($pesquisa_resultado as $row) {?>
<hr>
<a href="<?php echo $row->aa_url; ?>">
<div class="row-fluid">
	<div class="span4">
		<img alt="<?php echo $row->cft_titulo; ?>" src="<?php echo $row->cft_url; ?>" width="150" height="150">
	</div>
	<div class="span8">
		<div class="row">
			<div class="span8"><?php echo $row->aa_titulo; ?></div>
			<div class="span2"><?php echo $row->aa_preco; ?></div>
		</div>
		<div class="row">
			<div class="span5">Marca: <?php echo $row->cmr_descricao; ?></div>
			<div class="span5">Modelo: <?php echo $row->cmd_descricao; ?></div>
		</div>
		<div class="row">
			<div class="span5">Cor: <?php echo $row->aa_cor; ?></div>
			<div class="span5">Transmissão: <?php echo $row->aa_transmissao; ?></div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $row->cd_descricao . "/" . $row->es_descricao; ?></div>
		</div>
	</div>
</div>
</a>
<hr>
<?php }} ?>