<div class="row-fluid">
	<div class="span8"><h1>Novo Perfil</h1></div>	
</div>
<div class="clear"></div>

<hr>
<?php echo validation_errors('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>') ?>
<div class="well">
	<form action="<?php echo base_url();?>admin/perfil/novo" class="form-horizontal" method="post">	
		<fieldset>
			<div class="control-group">
			    <label class="control-label" for="iNome">Nome:</label>
			    <div class="controls">
			      <input type="text" id="iNome" name="iNome" placeholder="Nome completo" value="<?php echo set_value("iNome"); ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iEmail">Email:</label>
			    <div class="controls">
			      <input type="email" id="iEmail" name="iEmail" placeholder="Email" value="<?php echo set_value("iEmail"); ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iDataNascimento">Data Nascimento:</label>
			    <div class="controls">
			      <input type="date" id="iDataNascimento" name="iDataNascimento" placeholder="Data de Nascimento" value="<?php echo set_value("iDataNascimento"); ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iSenha">Senha:</label>
			    <div class="controls">
			      <input type="password" id="iSenha" name="iSenha" placeholder="Preencha a Senha">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="icSenha">Confirma a Senha:</label>
			    <div class="controls">
			      <input type="password" id="icSenha" name="icSenha" placeholder="Confime a Senha">
			    </div>
		  	</div>		  	
		  	<div class="control-group">
			    <div class="controls">
			    	<button class="btn btn-primary" type="submit">Salvar</button>
			    </div>
		  	</div>
		</fieldset>
	</form>
</div>

