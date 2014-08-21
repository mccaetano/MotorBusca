

<div class="row-fluid">
	<div class="span8"><h1>Cadastro de Perfil</h1></div>
	<div class="span2 pull-right"><a  class="btn btn-primary" href="<?php echo base_url();?>admin/perfil/novo">novo</a>
	</div>
</div>
<div class="clear"></div>

<hr>

<div class="well">
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>email</th>
				<th>Data Nascimento</th>
				<th>Ativo</th>
				<th>Acesso</th>
				<th>Ação</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($perfis) { foreach ($perfis as $perfil) {  ?>
			<tr>
				<td><?php echo $perfil->id_perfil; ?></td>
				<td><?php echo $perfil->nome_completo; ?></td>
				<td><?php echo $perfil->email; ?></td>
				<td><?php echo DateTime::createFromFormat("Y-m-d H:i:s", $perfil->data_nascimento)->format("d/m/Y"); ?></td>
				<td><?php echo $perfil->ativo == 1 ? 'sim' : 'não';  ?></td>
				<td><?php echo $perfil->t_mb_perfil_acesso_pra_id; ?></td>
				<td><a class="btn" href="<?php echo base_url();?>admin/perfil/alteracao/<?php echo $perfil->id_perfil; ?>">Alterar</a>&nbsp;<a
					class="btn btn-danger" href="<?php echo base_url();?>admin/perfil/exclusao/<?php echo $perfil->id_perfil; ?>">Excluir</a></td>
			</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>