<div class="span2">
	<div class="well">
<?php
	if ($iPesquisa != FALSE) {
		echo "<a href=\"" . base_url() . "pesquisa/imovel/p1\"><i class=\"icon-remove\"></i>" . $iPesquisa . "</a><br>" . PHP_EOL;
	}
	if ($iContratoTipo != FALSE) {
		echo "<a href=\"" . base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "\"><i class=\"icon-remove\"></i>" . $iContratoTipo . "</a><br>" . PHP_EOL;		
	}
	if ($iCasaTipo != FALSE) {
		echo "<a href=\"" . base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "/" . $iContratoTipo . "\"><i class=\"icon-remove\"></i>" . $iCasaTipo . "</a><br>" . PHP_EOL;
	}
	if ($iEstado != FALSE) {
		echo "<a href=\"" . base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "/" . $iContratoTipo . "/" . $iCasaTipo . "\"><i class=\"icon-remove\"></i>" . $iEstado . "</a><br>" . PHP_EOL;
	}
	if ($iCidade != FALSE) {
		echo "<a href=\"" . base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "/" . $iContratoTipo . "/" . $iCasaTipo . "/" . $iEstado . "\"><i class=\"icon-remove\"></i>" . $iCidade . "</a><br>" . PHP_EOL;
	}		 		 		 
?>
	</div>
	<div class="well">
		<p><strong>Tipo Contrato</strong></p>
		<ul class="nav nav-list">
<?php if ($lista_contrato) { foreach ($lista_contrato as $row) {?>
			<li><a href="<?php echo base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "/" . $row->pct_descricao; ?>"><i class="icon-plus"></i><?php echo $row->pct_descricao;?></a></li>
<?php }} ?>		
		</ul>
	</div>
	<div class="well">		
		<p><strong>Tipo de Imóvel</strong></p>
		<ul class="nav nav-list">
<?php if ($lista_tipoimovel) { foreach ($lista_tipoimovel as $row) {?>
			<li><a href="<?php echo base_url() . "pesquisa/imovel/". $pg . "/" . $iPesquisa . "/" . $iContratoTipo . "/" . $row->pt_descricao; ?>"><i class="icon-plus"></i><?php echo $row->pt_descricao;?></a></li>
<?php }} ?>		
		</ul>		
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCasaTipo" name="iCasaTipo" value="null" <?php echo set_radio('iCasaTipo', "null", TRUE); ?>>
				</label>
			</div>
		</div>		
		<?php if ($tipo_imovel) { foreach ($tipo_imovel as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small><?php echo $row->pt_descricao; ?></small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iCasaTipo<?php echo $row->pt_id; ?>" name="iCasaTipo" value="<?php echo $row->pt_id; ?>" <?php echo set_radio('iCasaTipo', $row->pt_id); ?>>
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
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iPreco7" name="iPreco" value="500000,700000" <?php echo set_radio('iPreco', "500000,700000"); ?>>
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
		<p><strong>Quartos</strong></p>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>Indiferente</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iQuartos" name="iQuartos" value="null" <?php echo set_radio('iQuartos', "null", TRUE); ?>>
				</label>
			</div>		
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>1 Quarto</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iQuartos1" name="iQuartos" value="1" <?php echo set_radio('iQuartos', "1"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>2 Quarto</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iQuartos2" name="iQuartos" value="2" <?php echo set_radio('iQuartos', "2"); ?>>
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><small>3 Quarto</small>
					<input onclick="javascript: frmPesquisa.submit();" type="radio" id="iQuartos3" name="iQuartos" value="3" <?php echo set_radio('iQuartos', "3"); ?>>
				</label>
			</div>
		</div>
	</div>
</div>