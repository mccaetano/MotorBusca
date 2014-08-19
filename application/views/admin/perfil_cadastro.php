<div class="row-fluid">
	<div class="span8"><h1>Cadastro de Perfil</h1></div>
	<div class="span2 pull-right"><a  class="btn btn-inverse" href="<?php echo base_url();?>admin/perfil/lista">voltar</a>
	</div>
</div>
<div class="clear"></div>

<hr>

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
			      <input type="text" id="iEmail" name="iEmail" placeholder="Email" value="<?php echo set_value("iEmail"); ?>">
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
			    		<option value=""></option>
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

