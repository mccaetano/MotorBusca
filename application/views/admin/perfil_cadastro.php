<div class="row-fluid">
	<div class="span8"><h1>Novo Perfil</h1></div>
	<div class="span2 pull-right"><a  class="btn btn-inverse" href="<?php echo base_url();?>admin/perfil/lista">voltar</a>
	</div>
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
			    <label class="control-label" for="iAtivo">Ativo:</label>
			    <div class="controls">
			      <input type="checkbox" id="iAtivo" name="iAtivo" <?php echo set_checkbox('iAtivo', 'on'); ?>>
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iAcesso">Acesso:</label>
			    <div class="controls">
			    	<select id="iAcesso" name="iAcesso">
			    		<?php if ($perfil_acessos) { foreach ($perfil_acessos as $perfil_acesso) {?>
			    		<option value="<?php echo $perfil_acesso->pra_id; ?>" <?php echo set_select('iAcesso', $perfil_acesso->pra_id); ?>><?php echo $perfil_acesso->pra_descricao; ?></option>
			    		<?php }} ?>
			    	</select>
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

