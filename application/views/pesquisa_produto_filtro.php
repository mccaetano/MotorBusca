
	<div class="well">
		<p><strong>Categoria</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCategoria" name="iCategoria" value="null" <?php echo set_radio('iCategoria', 'null', TRUE); ?>>
				</label>
			</div>
		</div>
		<?php if ($produto_categoria) { foreach ($produto_categoria as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->prc_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCategoria<?php echo $row->prc_id; ?>" name="iCategoria" value="<?php echo $row->prc_id; ?>" <?php echo set_radio('iCategoria', $row->prc_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Marca</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iMarca" name="iMarca" value="null" <?php echo set_radio('iMarca', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($produto_marca) { foreach ($produto_marca as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->pmr_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iMarca<?php echo $row->pmr_id; ?>" name="iMarca" value="<?php echo $row->pmr_id; ?>" <?php echo set_radio('iMarca', $row->pmr_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Modelo</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iModelo" name="iModelo" value="null" <?php echo set_radio('iModelo', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($produto_modelo) { foreach ($produto_modelo as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->pmd_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iModelo<?php echo $row->pmd_id; ?>" name="iModelo" value="<?php echo $row->pmd_id; ?>" <?php echo set_radio('iModelo', $row->pmd_id); ?>>
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
				<label class="radio"><small><?php echo $row->es_descricao; ?></small>
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
				<label class="radio"><small><?php echo $row->cd_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCidade<?php echo $row->cd_id; ?>" name="iCidade" value="<?php echo $row->cd_id; ?>" <?php echo set_radio('iCidade', $row->cd_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	