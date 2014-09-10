<div class="row-fluid">
	<div class="span8"><h1>Alertas</h1></div>
</div>
<div class="clear"></div>

<hr>

<div class="well">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>email</th>
				<th>Titulo</th>
				<th>Tipo</th>
				<th>Período</th>
				<th>Data Criação</th>
				<th>Data Ultima alteração</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($lista) { foreach ($lista as $alerta) {  ?>
			<tr>
				<td><?php echo $alerta->alr_id; ?></td>
				<td><?php echo $alerta->email; ?></td>
				<td><?php echo $alerta->alr_pesquisa; ?></td>
				<td><?php echo $alerta->tan_descricao; ?></td>
				<td><?php echo $alerta->apr_descricao; ?></td>
				<td><?php $data = @DateTime::createFromFormat("Y-m-d H:i:s", $alerta->alr_data_criacao);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>
				<td><?php $data = @DateTime::createFromFormat("Y-m-d H:i:s", $alerta->alr_data_ultima_alteracao);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>				
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>