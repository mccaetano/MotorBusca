<div class="alert alert-info">
<?php if ($pesquisa_destaque) { foreach ($pesquisa_destaque as $row) {?>
<hr>
<a href="<?php echo  base_url() . 'service/urlex/sender/' . base64_encode($row->ac_url); ?>">
<div class="row-fluid">
	<div class="span4">
		<img alt="<?php echo $row->acf_titulo; ?>" src="<?php echo $row->acf_url; ?>" width="150" height="150">
	</div>
	<div class="span8">
		<div class="row">
			<div class="span8"><?php echo $row->ac_title; ?></div>
			<div class="span2"><?php echo $row->ac_preco; ?></div>
		</div>
		<div class="row">
			<div class="span8"><?php echo $row->ac_endereco; ?></div>
			<div class="span2"><?php echo $row->ac_quartos; ?> Quartos</div>
		</div>
		<div class="row">
			<div class="span8"><?php echo $row->ac_bairro . ", " . $row->ac_complemento; ?></div>
			<div class="span2"><?php echo $row->ac_banheiros; ?> Banheiros</div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $row->cd_descricao . "/" . $row->es_descricao; ?></div>
		</div>
	</div>
</div>
</a>
<hr>
<?php }} ?>
</div>

<?php if ($pesquisa_resultado) { 
	$rcount = count($pesquisa_resultado);
	if ($rcount+$pg > 10) { $rcount = 10; }
	for ($row=$pg;$row < $rcount; $row++) {?>
<hr>
<a href="<?php echo  base_url() . 'service/urlex/sender/' . base64_encode($pesquisa_resultado[$row]->ac_url); ?>">
<div class="row-fluid">
	<div class="span4">
		<img alt="<?php echo $pesquisa_resultado[$row]->acf_titulo; ?>" src="<?php echo $pesquisa_resultado[$row]->acf_url; ?>" width="150" height="150">
	</div>
	<div class="span8">
		<div class="row">
			<div class="span8"><?php echo $pesquisa_resultado[$row]->ac_title; ?></div>
			<div class="span2"><?php echo $pesquisa_resultado[$row]->ac_preco; ?></div>
		</div>
		<div class="row">
			<div class="span8"><?php echo $pesquisa_resultado[$row]->ac_endereco; ?></div>
			<div class="span2"><?php echo $pesquisa_resultado[$row]->ac_quartos; ?> Quartos</div>
		</div>
		<div class="row">
			<div class="span8"><?php echo $pesquisa_resultado[$row]->ac_bairro . ", " . $pesquisa_resultado[$row]->ac_complemento; ?></div>
			<div class="span2"><?php echo $pesquisa_resultado[$row]->ac_banheiros; ?> Banheiros</div>
		</div>
		<div class="row">
			<div class="span10"><?php echo $pesquisa_resultado[$row]->cd_descricao . "/" . $pesquisa_resultado[$row]->es_descricao; ?></div>
		</div>
	</div>
</div>
</a>
<hr>
<?php } ?>
<div class="pagination">
  <ul>
    <li><a href="<?php echo $url; ?>">Prev</a></li>
    <li><a href="<?php echo $url; ?>">1</a></li>
    <li><a href="<?php echo $url; ?>">2</a></li>
    <li><a href="<?php echo $url; ?>">3</a></li>
    <li><a href="<?php echo $url; ?>">4</a></li>
    <li><a href="<?php echo $url; ?>">5</a></li>
    <li><a href="<?php echo $url; ?>">Next</a></li>
  </ul>
</div>
<?php } ?>