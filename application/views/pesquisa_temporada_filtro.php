	<div class="well">		
		<p><strong>Tipo de Imóvel</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iTipoImovel" name="iTipoImovel" value="null" <?php echo set_radio('iTipoImovel', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($tipo_imovel) { foreach ($tipo_imovel as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->tpi_descricao, "ISO-8859-1", "auto"); ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iTipoImovel<?php echo $row->tpi_id; ?>" name="iTipoImovel" value="<?php echo $row->tpi_id; ?>" <?php echo set_radio('iTipoImovel', $row->tpi_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Pais</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPais" name="iPais" value="null" <?php echo set_radio('iPais', "null", TRUE); ?>>
				</label>
			</div>
		</div>				
		<?php if ($pais) { foreach ($pais as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->ps_descricao, "ISO-8859-1", "auto"); ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPais<?php echo $row->ps_id; ?>" name="iPais" value="<?php echo $row->ps_id; ?>" <?php echo set_radio('iPais', $row->ps_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Estado</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iEstado" name="iEstado" value="null" <?php echo set_radio('iEstado', "null", TRUE); ?>>
				</label>
			</div>
		</div>				
		<?php if ($estado) { foreach ($estado as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->es_descricao, "ISO-8859-1", "auto"); ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iEstado<?php echo $row->es_id; ?>" name="iEstado" value="<?php echo $row->es_id; ?>" <?php echo set_radio('iEstado', $row->es_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Cidade</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCidade" name="iCidade" value="null" <?php echo set_radio('iCidade', "null", TRUE); ?>>
				</label>
			</div>
		</div>			
		<?php if ($cidade) { foreach ($cidade as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->cd_descricao, "ISO-8859-1", "auto"); ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCidade<?php echo $row->cd_id; ?>" name="iCidade" value="<?php echo $row->cd_id; ?>" <?php echo set_radio('iCidade', $row->cd_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>