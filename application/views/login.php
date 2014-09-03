<div class="row-fluid">
	<div class="span12"><h1>Acesso do Usuário</h1></div>
</div>
<div class="clear"></div>

<?php 
if (isset ( $error ) && $error != "") {
echo "<div class=\"row-fluid\">";
echo "	<div class=\"span6\">";
echo "		<div class=\"alert alert-error\">";
echo $error;
echo "		</div>";
echo "	</div>";
echo "</div>";
} ?>

<div class="row-fluid">
<div class="span6">
	<div class="well">
		<h3>Login</h3>
		<form action="<?php echo base_url();?>acesso/login/<?php echo $pagereturn; ?>" method="post" class="form-horizontal">
			<fieldset>
				<div class="control-group">
					<label class="control-label" for="username">Email: </label>
					<div class="controls">
						<input type="text" name="username" id="username" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="password">Senha: </label>
					<div class="controls">
						<input type="password" name="password" id="password" />
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="checkbox"
								name="remember" value="1" id="remember" /> Lembrar me.
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button class="btn btn-primary" type="submit">Login</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<div class="span6">
	<div class="well">
		<h3>Cadastrar-se</h3>
		<form action="<?php echo base_url();?>acesso/cadastro/<?php echo $pagereturn; ?>" method="post" class="form-horizontal">
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
</div>
</div>
