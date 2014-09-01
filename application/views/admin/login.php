<div class="row-fluid">
	<div class="span6 offset3"><h1>Acesso do Usuário</h1></div>
</div>
<div class="clear"></div>
<div class="row-fluid">
<div class="span6 offset3">
<?php
if (isset ( $error ) && $error != "") {
	
 echo "<div class=\"alert alert-error\">";
 echo $error;
	echo "</div>";
} ?>
		<div class="well">
		
<div class="row-fluid">
<?php echo form_open('admin/login', array('class' => 'form-horizontal')); ?>
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
		<input type="submit"
				value="login" />
	</div>
</div>
</fieldset>
			</form>
</div>
</div>
</div>
</div>
