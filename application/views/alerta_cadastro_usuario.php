<div class="clear"></div>
<div class="row">
	<div class="span8">
		<h1>Seu Alerta</h1>
	</div>
	<div class="span2 pull-right">
		<div class="btn-group">
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
<hr>
<div class="well">
	<form action="<?php echo base_url();?>alerta/cadastro" method="post">
		<fieldset>
			<div class="row text-center">
				<div class="span12">
					<input type="text" id="iPesquisa" name="iPesquisa" class="span10"
						placeholder="Titulo do Alerta" value="<?php echo set_value('iPesquisa') ?>">
				</div>
			</div>
			<div class="row text-center">
				<div class="span12">Tipo de Aleta</div>
			</div>
			<div class="row">
				<div class="span10">
					<ul class="nav nav-tabs" id="iTipoAlerta">
						<?php if ($tipoaunucios) { foreach ($tipoaunucios as $tipoaunucio) {?>
						<li <?php echo $tipoalerta == $tipoaunucio->tan_id ? "class=\"active\"" : ""; ?>><a
							href="<?php echo base_url() . "alerta/cadastro/" . $tipoaunucio->tan_id;?>"><?php echo $tipoaunucio->tan_descricao; ?></a></li>
							<?php }} ?>
					</ul>
					<div class="tab-content">
						<div
							class="tab-pane <?php echo $tipoalerta == 1 ? "active" : ""; ?>"
							id="1">
							<div class="control-group">
								<label for="iImocelTipoContrato"><small>Tipo Contrato</small></label>
								<div class="controls">
									<select name="iImocelTipoContrato" id="iImocelTipoContrato">
										<option value="" <?php echo set_select('iImocelTipoContrato', null); ?>>Indiferente</option>
										<?php if ($pesquisa_tipo_casa) { foreach ($pesquisa_tipo_casa as $row) {?>
										<option value="<?php echo $row->pct_id; ?>" <?php echo set_select('iImocelTipoContrato', $row->pct_id); ?>><?php echo $row->pct_descricao; ?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
							<div class="control-group">
								<label for="iImocelTipoImovel"><small>Tipo Imóvel</small></label>
								<div class="controls">
									<select name="iImocelTipoImovel" id="iImocelTipoImovel">
										<option value="" <?php echo set_select('iImocelTipoImovel', null); ?>>Indiferente</option>
										<?php if ($tipo_imovel) { foreach ($tipo_imovel as $row) {?>
										<option value="<?php echo $row->pt_id; ?>" <?php echo set_select('iImocelTipoImovel', $row->pt_id); ?>><?php echo $row->pt_descricao; ?></option>
										<?php }} ?>
									</select>
								</div>
							</div>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 2 ? "active" : ""; ?>"
							id="2">
							<p>panel2</p>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 3 ? "active" : ""; ?>"
							id="3">
							<p>panel3</p>
						</div>
					</div>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="span9">
					<div class="control-group">
						<label for="iPeriodo">Período:</label>
						<div class="controls">
							<select name="iPeriodo" >
								<?php if ($periodos) { foreach ($periodos as $periodo) { ?>
							  <option value="<?php echo $periodo->apr_id; ?>"><?php echo $periodo->apr_descricao; ?></option>
							  <?php }} ?>
							</select>
						</div>
					</div>
				</div>
				<div class="span1">
					<button type="submit" class="btn btn-primary">Adicionar</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
<script>
$('#iTipoAlerta a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>