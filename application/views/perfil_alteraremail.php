<div class="page-header">
	<h1>Alterar Email</h1>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel-default">
			<div class="panel-heading"><h4>Perfil</h4></div>
			<div class="panel-body">
				<ul class="nav nav-pills  nav-stacked">
					<li><a href="<?php echo base_url(); ?>perfil">Perfil</a></li>
					<li><a href="<?php echo base_url(); ?>perfil/alterarsenha">Alterar Senha</a></li>
					<li class="active"><a href="<?php echo base_url(); ?>perfil/alteraremail">Alterar Email</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<form action="post" class="form-horizontal">
			<fieldset>
				<div class="well">
					<div class="form-group">
						<label class="control-label">Email Atual:</label> <input
							class="form-control" type="email">
					</div>
					<div class="form-group">
						<label class="control-label">Novo Email:</label> <input
							class="form-control" type="email">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Alterar</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>