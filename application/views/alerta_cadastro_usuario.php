<div class="clear"></div>
<div class="row">
	<div class="span1">
		<img alt="Logo Empresa" src="<?php echo base_url();?>assets/img/LogoEmpresa_60.png">
	</div>
	<div class="span6">
		<h1>Seu Alerta</h1>
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
<hr>
<div class="well">
	<form id="frmForm" name="frmForm" action="<?php echo base_url();?>alerta/cadastro/<?php echo $tipoalerta; ?>" method="post">
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
				<div class="span11">
					<ul class="nav nav-tabs" id="iTipoAlerta">
						<?php if ($tipo_anuncio) { foreach ($tipo_anuncio as $row) {?>
						<li <?php echo $tipoalerta == $row->tan_id ? "class=\"active\"" : ""; ?>><a
							href="<?php echo base_url() . "alerta/cadastro/" . $row->tan_id;?>"><?php echo $row->tan_descricao; ?></a></li>
							<?php }} ?>
					</ul>
					<div class="tab-content">						
						<div
							class="tab-pane <?php echo $tipoalerta == 1 ? "active" : ""; ?>"
							id="1">
							<div class="row-fluid">
							<div class="span4">
								<div class="control-group">
									<label for="iImovelTipoContrato"><small>Tipo Contrato</small></label>
									<div class="controls">
										<select name="iImovelTipoContrato" id="iImovelTipoContrato">
											<option value="" <?php echo set_select('iImovelTipoContrato', null); ?>>Indiferente</option>
											<?php if ($pesquisa_tipo_casa) { foreach ($pesquisa_tipo_casa as $row) {?>
											<option value="<?php echo $row->pct_id; ?>" <?php echo set_select('iImovelTipoContrato', $row->pct_id); ?>><?php echo $row->pct_descricao; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="iImovelTipoImovel"><small>Tipo Imóvel</small></label>
									<div class="controls">
										<select name="iImovelTipoImovel" id="iImovelTipoImovel">
											<option value="" <?php echo set_select('iImovelTipoImovel', null); ?>>Indiferente</option>
											<?php if ($propriedade_tipo) { foreach ($propriedade_tipo as $row) {?>
											<option value="<?php echo $row->pt_id; ?>" <?php echo set_select('iImovelTipoImovel', $row->pt_id); ?>><?php echo $row->pt_descricao; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
							</div>
							<div class="span4">
								<div class="control-group">
									<label for="iImovelEstado"><small>Estado</small></label>
									<div class="controls">
										<select name="iImovelEstado" id="iImovelEstado" onchange="javascript: frmForm.submit();">
											<option value="" <?php echo set_select('iImovelEstado', null); ?>>Indiferente</option>
											<?php if ($estado) { foreach ($estado as $row) {?>
											<option value="<?php echo $row->es_id; ?>" <?php echo set_select('iImovelEstado', $row->es_id); ?>><?php echo $row->es_descricao; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="iImovelEstado"><small>Cidade</small></label>
									<div class="controls">
										<select name="iImovelCidade" id="iImovelCidade">
											<option value="" <?php echo set_select('iImovelCidade', null); ?>>Indiferente</option>
											<?php if ($cidade) { foreach ($cidade as $row) {?>
											<option value="<?php echo $row->cd_id; ?>" <?php echo set_select('iImovelCidade', $row->cd_id); ?>><?php echo $row->cd_descricao; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>							
							</div>
							<div class="span4">
								<div class="control-group">
									<label for="iImovelPreco"><small>Preço</small></label>
									<div class="controls">
										<select name="iImovelPreco" id="iImovelPreco">
											<option value="" <?php echo set_select('iImovelPreco', null); ?>>Indiferente</option>
											<?php if ($imovel_preco) { foreach ($imovel_preco as $row) {?>
											<option value="<?php echo $row['prc_id']; ?>" <?php echo set_select('iImovelPreco', $row['prc_id']); ?>><?php echo $row['prc_descricao']; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
								<div class="control-group">
									<label for="iImovelQuartos"><small>Quartos</small></label>
									<div class="controls">
										<select name="iImovelQuartos" id="iImovelQuartos">
											<option value="" <?php echo set_select('iImovelQuartos', null); ?>>Indiferente</option>
											<?php if ($imovel_quartos) { foreach ($imovel_quartos as $row) {?>
											<option value="<?php echo $row['qrt_id']; ?>" <?php echo set_select('iImovelQuartos', $row['qrt_descricao']); ?>><?php echo $row['qrt_id']; ?></option>
											<?php }} ?>
										</select>
									</div>
								</div>
							</div>
							</div>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 2 ? "active" : ""; ?>"
							id="2">
							<div class="row-fluid">
								<div class="span4">
									<div class="control-group">
										<label for="iCarroTipo"><small>Tipo Auto</small></label>
										<div class="controls">
											<select name="iCarroTipo" id="iCarroTipo">
												<option value="" <?php echo set_select('iCarroTipo', null); ?>>Indiferente</option>
												<?php if ($carro_tipo) { foreach ($carro_tipo as $row) {?>
												<option value="<?php echo $row->crt_id; ?>" <?php echo set_select('iCarroTipo', $row->crt_id); ?>><?php echo $row->crt_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iAutoPreco"><small>Preço</small></label>
										<div class="controls">
											<select name="iAutoPreco" id="iAutoPreco">
												<option value="" <?php echo set_select('iAutoPreco', null); ?>>Indiferente</option>
												<?php if ($carro_preco) { foreach ($carro_preco as $row) {?>
												<option value="<?php echo $row['prc_id']; ?>" <?php echo set_select('iAutoPreco', $row['prc_id']); ?>><?php echo $row['prc_descricao']; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iAutoPreco"><small>0 KM</small></label>
										<div class="controls">
											<select name="iAuto0KM" id="iAuto0KM">
												<option value="" <?php echo set_select('iAuto0KM', null); ?>>Indiferente</option>
												<?php if ($carro_0km) { foreach ($carro_0km as $row) {?>
												<option value="<?php echo $row['ckm_id']; ?>" <?php echo set_select('iAuto0KM', $row['ckm_id']); ?>><?php echo $row['ckm_descricao']; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iCarroMarca"><small>Marca</small></label>
										<div class="controls">
											<select name="iCarroMarca" id="iCarroMarca" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iCarroMarca', null); ?>>Indiferente</option>
												<?php if ($carro_marca) { foreach ($carro_marca as $row) {?>
												<option value="<?php echo $row->cmr_id; ?>" <?php echo set_select('iCarroMarca', $row->cmr_id); ?>><?php echo $row->cmr_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iCarroModelo"><small>Modelo</small></label>
										<div class="controls">
											<select name="iCarroModelo" id="iCarroModelo">
												<option value="" <?php echo set_select('iCarroModelo', null); ?>>Indiferente</option>
												<?php if ($carro_modelo) { foreach ($carro_modelo as $row) {?>
												<option value="<?php echo $row->cmd_id; ?>" <?php echo set_select('iCarroModelo', $row->cmd_id); ?>><?php echo $row->cmd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iCarroEstado"><small>Estado</small></label>
										<div class="controls">
											<select name="iCarroEstado" id="iCarroEstado" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iCarroEstado', null); ?>>Indiferente</option>
												<?php if ($estado) { foreach ($estado as $row) {?>
												<option value="<?php echo $row->es_id; ?>" <?php echo set_select('iCarroEstado', $row->es_id); ?>><?php echo $row->es_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iImovelEstado"><small>Cidade</small></label>
										<div class="controls">
											<select name="iCarroCidade" id="iCarroCidade">
												<option value="" <?php echo set_select('iCarroCidade', null); ?>>Indiferente</option>
												<?php if ($cidade) { foreach ($cidade as $row) {?>
												<option value="<?php echo $row->cd_id; ?>" <?php echo set_select('iCarroCidade', $row->cd_id); ?>><?php echo $row->cd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>					
								</div>
							</div>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 3 ? "active" : ""; ?>"
							id="3">
							<div class="row-fluid">
								<div class="span4">
									<div class="control-group">
										<label for="iEmpregoTipoContrato"><small>Tipo Contrato</small></label>
										<div class="controls">
											<select name="iEmpregoTipoContrato" id="iEmpregoTipoContrato">
												<option value="" <?php echo set_select('iEmpregoTipoContrato', null); ?>>Indiferente</option>
												<?php if ($emprego_contrato) { foreach ($emprego_contrato as $row) {?>
												<option value="<?php echo $row->emc_id; ?>" <?php echo set_select('iEmpregoTipoContrato', $row->emc_id); ?>><?php echo $row->emc_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iEmpregoCategoria"><small>Categoria</small></label>
										<div class="controls">
											<select name="iEmpregoCategoria" id="iEmpregoCategoria">
												<option value="" <?php echo set_select('iEmpregoCategoria', null); ?>>Indiferente</option>
												<?php if ($emprego_categoria) { foreach ($emprego_categoria as $row) {?>
												<option value="<?php echo $row->ect_id; ?>" <?php echo set_select('iEmpregoCategoria', $row->ect_id); ?>><?php echo $row->ect_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iEmpregoPeriodo"><small>Período</small></label>
										<div class="controls">
											<select name="iEmpregoPeriodo" id="iEmpregoPeriodo">
												<option value="" <?php echo set_select('iEmpregoPeriodo', null); ?>>Indiferente</option>
												<?php if ($emprego_periodo) { foreach ($emprego_periodo as $row) {?>
												<option value="<?php echo $row->emp_id; ?>" <?php echo set_select('iEmpregoPeriodo', $row->emp_id); ?>><?php echo $row->emp_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iEmpregoPais"><small>Pais</small></label>
										<div class="controls">
											<select name="iEmpregoPais" id="iEmpregoPais" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iEmpregoPais', null); ?>>Indiferente</option>
												<?php if ($pais) { foreach ($pais as $row) {?>
												<option value="<?php echo $row->ps_id; ?>" <?php echo set_select('iEmpregoPais', $row->ps_id); ?>><?php echo $row->ps_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iEmpregoEstado"><small>Estado</small></label>
										<div class="controls">
											<select name="iEmpregoEstado" id="iEmpregoEstado" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iEmpregoEstado', null); ?>>Indiferente</option>
												<?php if ($estado) { foreach ($estado as $row) {?>
												<option value="<?php echo $row->es_id; ?>" <?php echo set_select('iEmpregoEstado', $row->es_id); ?>><?php echo $row->es_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iEmpregoCidade"><small>Cidade</small></label>
										<div class="controls">
											<select name="iEmpregoCidade" id="iEmpregoCidade">
												<option value="" <?php echo set_select('iEmpregoCidade', null); ?>>Indiferente</option>
												<?php if ($cidade) { foreach ($cidade as $row) {?>
												<option value="<?php echo $row->cd_id; ?>" <?php echo set_select('iEmpregoCidade', $row->cd_id); ?>><?php echo $row->cd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>				
								</div>								
							</div>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 4 ? "active" : ""; ?>"
							id="4">
							<div class="row-fluid">
								<div class="span4">
									<div class="control-group">
										<label for="iProdutoCategoria"><small>Categoria</small></label>
										<div class="controls">
											<select name="iProdutoCategoria" id="iProdutoCategoria">
												<option value="" <?php echo set_select('iProdutoCategoria', null); ?>>Indiferente</option>
												<?php if ($produto_categoria) { foreach ($produto_categoria as $row) {?>
												<option value="<?php echo $row->prc_id; ?>" <?php echo set_select('iProdutoCategoria', $row->prc_id); ?>><?php echo $row->prc_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>		
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iProdutoMarca"><small>Marca</small></label>
										<div class="controls">
											<select name="iProdutoMarca" id="iProdutoMarca">
												<option value="" <?php echo set_select('iProdutoMarca', null); ?>>Indiferente</option>
												<?php if ($produto_marca) { foreach ($produto_marca as $row) {?>
												<option value="<?php echo $row->pmr_id; ?>" <?php echo set_select('iProdutoMarca', $row->pmr_id); ?>><?php echo $row->pmr_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>		
									<div class="control-group">
										<label for="iProdutoModelo"><small>Modelo</small></label>
										<div class="controls">
											<select name="iProdutoModelo" id="iProdutoModelo">
												<option value="" <?php echo set_select('iProdutoModelo', null); ?>>Indiferente</option>
												<?php if ($produto_modelo) { foreach ($produto_modelo as $row) {?>
												<option value="<?php echo $row->pmd_id; ?>" <?php echo set_select('iProdutoModelo', $row->pmd_id); ?>><?php echo $row->pmd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>		
								</div>
								<div class="span4">									
									<div class="control-group">
										<label for="iProdutoEstado"><small>Estado</small></label>
										<div class="controls">
											<select name="iProdutoEstado" id="iProdutoEstado" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iProdutoEstado', null); ?>>Indiferente</option>
												<?php if ($estado) { foreach ($estado as $row) {?>
												<option value="<?php echo $row->es_id; ?>" <?php echo set_select('iProdutoEstado', $row->es_id); ?>><?php echo $row->es_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iProdutoCidade"><small>Cidade</small></label>
										<div class="controls">
											<select name="iProdutoCidade" id="iProdutoCidade">
												<option value="" <?php echo set_select('iProdutoCidade', null); ?>>Indiferente</option>
												<?php if ($cidade) { foreach ($cidade as $row) {?>
												<option value="<?php echo $row->cd_id; ?>" <?php echo set_select('iProdutoCidade', $row->cd_id); ?>><?php echo $row->cd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>			
								</div>
							</div>
						</div>
						<div
							class="tab-pane <?php echo $tipoalerta == 5 ? "active" : ""; ?>"
							id="5">
							<div class="row-fluid">
								<div class="span4">									
									<div class="control-group">
										<label for="iTemporadaTipoImovel"><small>Tipo Imóvel</small></label>
										<div class="controls">
											<select name="iTemporadaTipoImovel" id="iTemporadaTipoImovel">
												<option value="" <?php echo set_select('iTemporadaTipoImovel', null); ?>>Indiferente</option>
												<?php if ($tipo_imovel) { foreach ($tipo_imovel as $row) {?>
												<option value="<?php echo $row->tpi_id; ?>" <?php echo set_select('iTemporadaTipoImovel', $row->tpi_id); ?>><?php echo $row->tpi_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>			
								</div>
								<div class="span4">
									<div class="control-group">
										<label for="iTemporadaPais"><small>Pais</small></label>
										<div class="controls">
											<select name="iTemporadaPais" id="iTemporadaPais" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iTemporadaPais', null); ?>>Indiferente</option>
												<?php if ($pais) { foreach ($pais as $row) {?>
												<option value="<?php echo $row->ps_id; ?>" <?php echo set_select('iTemporadaPais', $row->ps_id); ?>><?php echo $row->ps_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iTemporadaEstado"><small>Estado</small></label>
										<div class="controls">
											<select name="iTemporadaEstado" id="iTemporadaEstado" onchange="javascript: frmForm.submit();">
												<option value="" <?php echo set_select('iTemporadaEstado', null); ?>>Indiferente</option>
												<?php if ($estado) { foreach ($estado as $row) {?>
												<option value="<?php echo $row->es_id; ?>" <?php echo set_select('iTemporadaEstado', $row->es_id); ?>><?php echo $row->es_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="iTemporadaCidade"><small>Cidade</small></label>
										<div class="controls">
											<select name="iTemporadaCidade" id="iTemporadaCidade">
												<option value="" <?php echo set_select('iTemporadaCidade', null); ?>>Indiferente</option>
												<?php if ($cidade) { foreach ($cidade as $row) {?>
												<option value="<?php echo $row->cd_id; ?>" <?php echo set_select('iTemporadaCidade', $row->cd_id); ?>><?php echo $row->cd_descricao; ?></option>
												<?php }} ?>
											</select>
										</div>
									</div>		
								</div>
								<div class="span4">
								</div>
							</div>
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
				<div class="span2">
					<button id="btnGravar" name="btnGravar" type="submit" class="btn btn-primary" value="ok">Adicionar</button>
					<a href="<?php echo base_url();?>alerta/lista" class="btn">Voltar</a>
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