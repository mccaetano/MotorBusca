
	<div class="well">
		<p><strong>Tipo Contrato</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input type="radio" id="iContrato" name="iContrato" value="null" <?php echo set_radio('iContrato', 'null', TRUE); ?>>
				</label>
			</div>
		</div>
		<?php if ($emprego_contrato) { foreach ($emprego_contrato as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->emc_descricao, "ISO-8859-1", "auto"); ?></small>
					<input type="radio" id="iContrato<?php echo $row->emc_id; ?>" name="iContrato" value="<?php echo $row->emc_id; ?>" <?php echo set_radio('iContrato', $row->emc_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Categoria</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input type="radio" id="iCategira" name="iCategira" value="null" <?php echo set_radio('iCategira', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($emprego_categoria) { foreach ($emprego_categoria as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->ect_descricao, "ISO-8859-1", "auto"); ?></small>
					<input type="radio" id="iCategira<?php echo $row->ect_id; ?>" name="iCategira" value="<?php echo $row->ect_id; ?>" <?php echo set_radio('iCategira', $row->ect_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Periodo</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input type="radio" id="iPeriodo" name="iPeriodo" value="null" <?php echo set_radio('iPeriodo', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($emprego_periodo) { foreach ($emprego_periodo as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->emp_descricao, "ISO-8859-1", "auto"); ?></small>
					<input type="radio" id="iPeriodo<?php echo $row->emp_id; ?>" name="iPeriodo" value="<?php echo $row->emp_id; ?>" <?php echo set_radio('iPeriodo', $row->emp_id); ?>>
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
					<input type="radio" id="iPais" name="iPais" value="null" <?php echo set_radio('iPais', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($pais) { foreach ($pais as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->ps_descricao, "ISO-8859-1", "auto"); ?></small>
					<input type="radio" id="iPais<?php echo $row->ps_id; ?>" name="iPais" value="<?php echo $row->ps_id; ?>" <?php echo set_radio('iPais', $row->ps_id); ?>>
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
					<input type="radio" id="iEstado" name="iEstado" value="null" <?php echo set_radio('iEstado', "null", TRUE); ?>>
				</label>
			</div>
		</div>				
		<?php if ($estado) { foreach ($estado as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->es_descricao; ?></small>
					<input type="radio" id="iEstado<?php echo $row->es_id; ?>" name="iEstado" value="<?php echo $row->es_id; ?>" <?php echo set_radio('iEstado', $row->es_id); ?>>
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
					<input type="radio" id="iCidade" name="iCidade" value="null" <?php echo set_radio('iCidade', "null", TRUE); ?>>
				</label>
			</div>
		</div>			
		<?php if ($cidade) { foreach ($cidade as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo mb_convert_encoding($row->cd_descricao, "ISO-8859-1", "auto"); ?></small>
					<input type="radio" id="iCidade<?php echo $row->cd_id; ?>" name="iCidade" value="<?php echo $row->cd_id; ?>" <?php echo set_radio('iCidade', $row->cd_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>