<div class="alert alert-info">
<?php if ($pesquisa_destaque) { foreach ($pesquisa_destaque as $row) {?>
<hr>
<a href="<?php echo  base_url() . 'service/urlex/sender/' . base64_encode($row->aem_url); ?>">
<div class="row-fluid">
	<div class="span10">
		<p><strong><?php echo $row->aem_titulo; ?></strong><br/>
		<small><?php echo $row->ps_descricao . "/" . $row->cd_descricao . "/" . $row->es_descricao; ?><br/>
		<?php echo $row->aem_descricao; ?><br/>
		Empresa: <?php echo $row->aem_empresa; ?></small><br/>
		</p>
		<p class="muted"><small>desde de <?php echo $row->aem_data_criacao; ?></small>
		</p>
	</div>
</div>
</a>
<hr>
<?php }} ?>
</div>
<?php if ($pesquisa_resultado) { foreach ($pesquisa_resultado as $row) {?>
<hr>
<a href="<?php echo  base_url() . 'service/urlex/sender/' . base64_encode($row->aem_url); ?>">
<div class="row-fluid">
	<div class="span10">
		<p><strong><?php echo $row->aem_titulo; ?></strong><br/>
		<small><?php echo $row->ps_descricao . "/" . $row->cd_descricao . "/" . $row->es_descricao; ?><br/>
		<?php echo $row->aem_descricao; ?><br/>
		Empresa: <?php echo $row->aem_empresa; ?></small><br/>
		</p>
		<p class="muted"><small>desde de <?php echo $row->aem_data_criacao; ?></small>
		</p>
	</div>
</div>
</a>
<hr>
<?php }} ?>