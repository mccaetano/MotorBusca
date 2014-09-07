
	<div class="well">
		<p><strong>Tipo Auto</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input type="radio" id="iCarroTipo" name="iCarroTipo" value="null" <?php echo set_radio('iCarroTipo', 'null', TRUE); ?>>
				</label>
			</div>
		</div>
		<?php if ($carro_tipo) { foreach ($carro_tipo as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->crt_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();"  type="radio" id="iCarroTipo<?php echo $row->crt_id; ?>" name="iCarroTipo" value="<?php echo $row->crt_id; ?>" <?php echo set_radio('iCarroTipo', $row->crt_id); ?>>
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
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCarroMarca" name="iCarroMarca" value="null" <?php echo set_radio('iCarroMarca', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($carro_marca) { foreach ($carro_marca as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo$row->cmr_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCarroMarca<?php echo $row->cmr_id; ?>" name="iCarroMarca" value="<?php echo $row->cmr_id; ?>" <?php echo set_radio('iCarroMarca', $row->cmr_id); ?>>
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
					<input type="radio" onclick="javascript: frmPesquisa.submit();" id="iCarroModelo" name="iCarroModelo" value="null" <?php echo set_radio('iCarroModelo', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($carro_modelo) { foreach ($carro_modelo as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo$row->cmd_descricao; ?></small>
					<input type="radio" onclick="javascript: frmPesquisa.submit();" id="iCarroModelo<?php echo $row->cmd_id; ?>" name="iCarroModelo" value="<?php echo $row->cmd_id; ?>" <?php echo set_radio('iCarroModelo', $row->cmd_id); ?>>
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
				<label class="radio"><small><?php echo$row->es_descricao; ?></small>
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
				<label class="radio"><small><?php echo$row->cd_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCidade<?php echo $row->cd_id; ?>" name="iCidade" value="<?php echo $row->cd_id; ?>" <?php echo set_radio('iCidade', $row->cd_id); ?>>
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p><strong>Preço</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco" name="iPreco" value="null" <?php echo set_radio('iPreco', "null", TRUE); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>10.000 - 80.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco1" name="iPreco" value="10000,80000" <?php echo set_radio('iPreco', "10000,80000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>80.000 - 100.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco2" name="iPreco" value="80000,100000" <?php echo set_radio('iPreco', "80000,100000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>100.000 - 200.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco3" name="iPreco" value="100000,200000" <?php echo set_radio('iPreco', "100000,200000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>200.000 - 300.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco4" name="iPreco" value="200000,300000" <?php echo set_radio('iPreco', "200000,300000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>300.000 - 400.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco5" name="iPreco" value="300000,400000" <?php echo set_radio('iPreco', "300000,400000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>400.000 - 500.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco6" name="iPreco" value="400000,500000" <?php echo set_radio('iPreco', "400000,500000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>500.000 - 700.000</small>
					<input type="radio" id="iPreco7" name="iPreco" value="500000,700000" <?php echo set_radio('iPreco', "500000,700000"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>700.000 - 1.000.000</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco8" name="iPreco" value="700000,1000000" <?php echo set_radio('iPreco', "700000,1000000"); ?>>
				</label>
			</div>
		</div>
	</div>
	<div class="well">		
		<p><strong>0 KM</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iNovo" name="iNovo" value="null" <?php echo set_radio('iNovo', "null", TRUE); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Usado</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iNovo1" name="iNovo" value="1" <?php echo set_radio('iNovo', "1"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Novo</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iNovo2" name="iNovo" value="2" <?php echo set_radio('iNovo', "2"); ?>>
				</label>
			</div>
		</div>
	</div>