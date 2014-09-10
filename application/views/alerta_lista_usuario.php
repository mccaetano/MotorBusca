<div class="row-fluid">
	<div class="span1">
		<img alt="Logo Empresa" src="<?php echo base_url();?>assets/img/LogoEmpresa_60.png">
	</div>
	<div class="span6">
		<h1>Alertas</h1>
	</div>
	<div class="span5">
		<div class="btn-group pull-right">
		  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
		    <?php echo $user[0]->email; ?>
		    <span class="caret"></span>
		  </a>
		  <ul class="dropdown-menu">
		    <li><a href="#">Trocar Senha</a></li>
		    <li><a href="<?php echo base_url();?>acesso/logout">Sair</a></li>
		  </ul>
		</div>
	</div>
</div>
<div class="clear"></div>

<hr>

<div class="well">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Titulo</th>
				<th>Tipo</th>
				<th>Período</th>
				<th>Data Criação</th>
				<th>Data Ultima alteração</th>
				<th><a class="btn btn-primary"
						href="<?php echo base_url();?>alerta/cadastro">novo</a></th>
			</tr>
		</thead>
		<tbody>
			<?php if ($lista) { foreach ($lista as $alerta) {  ?>
			<tr>
				<td><?php echo $alerta->alr_id; ?></td>
				<td><?php echo $alerta->alr_pesquisa; ?></td>
				<td><?php echo $alerta->tan_descricao; ?></td>
				<td><?php echo $alerta->apr_descricao; ?></td>
				<td><?php $data = @DateTime::createFromFormat("Y-m-d H:i:s", $alerta->alr_data_criacao);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>
				<td><?php $data = @DateTime::createFromFormat("Y-m-d H:i:s", $alerta->alr_data_ultima_alteracao);  echo  $data === FALSE ?  '' : $data->format("d/m/Y"); ?></td>
				<td><a class="btn"
					href="<?php echo base_url();?>alerta/alteracao/<?php echo $alerta->alr_id; ?>">Alterar</a>&nbsp;<a
					class="btn btn-danger" href="<?php echo base_url();?>alerta/exclusao/<?php echo $alerta->alr_id; ?>">Excluir</a></td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>