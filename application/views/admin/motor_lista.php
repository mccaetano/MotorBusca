<div class="row-fluid">
	<div class="span8">
		<h1>Cadastro de Motor de Feeds</h1>
	</div>
	<div class="span2 pull-right">
		<a class="btn btn-primary"
			href="<?php echo base_url();?>admin/motorfeeds/novo">novo</a>
	</div>
</div>
<div class="clear"></div>

<hr>

<div class="well">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Descrição</th>
				<th>Anunciante</th>
				<th>URL</th>
				<th>Data Criação</th>
				<th>Data Ultima execução</th>
				<th>Tipo Anuncio</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($motor) { foreach ($motor as $feed) {  ?>
			<tr>
				<td><?php echo $feed->man_id; ?></td>
				<td><?php echo $feed->man_descricao; ?></td>
				<td><?php echo $feed->man_anunciante; ?></td>
				<td><?php echo $feed->man_url_carga; ?></td>
				<td><?php $data = DateTime::createFromFormat("Y-m-d H:i:s", $feed->man_data_criacao);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>
				<td><?php $data = DateTime::createFromFormat("Y-m-d H:i:s", $feed->man_data_ultima_carga);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>
				<td><?php echo $feed->tan_id; ?></td>
				<td><a class="btn"
					href="<?php echo base_url();?>admin/motorfeeds/alteracao/<?php echo $feed->man_id; ?>">Alterar</a>&nbsp;<a
					class="btn btn-danger" href="<?php echo base_url();?>admin/motorfeeds/exclusao/<?php echo $feed->man_id; ?>">Excluir</a></td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>