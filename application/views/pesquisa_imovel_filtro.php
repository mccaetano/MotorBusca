<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>		
		<button type="button" class="btn btn-link" name="iPesquisa" value="<?php echo $iPesquisa; ?>" onclick="javascript: document.forms[0].submit();"><i class="icon-remove"></i><?php echo $iPesquisa; ?></button><br>		
<?php 
	}
	if ($iContratoTipo) {
?>
		<input type="hidden" id="iContratoTipo" name="iContratoTipo" value="<?php echo $iContratoTipo; ?>">
		<button type="button" class="btn btn-link" onclick="removeItem('iContratoTipo');"><i class="icon-remove"></i><?php echo $iContratoTipo; ?></button><br>		
<?php 
	}
	if ($iCasaTipo) {
?>
		<input type="hidden" id="iCasaTipo"  name="iCasaTipo" value="<?php echo $iCasaTipo; ?>">
		<button type="button" class="btn btn-link" onclick="removeItem('iCasaTipo');"><i class="icon-remove" ></i><?php echo $iCasaTipo; ?></button><br>		
<?php 
	}
	if ($iEstado) {
?>
		<input type="hidden" id="iEstado"  name="iEstado" value="<?php echo $iEstado; ?>">
		<button type="button" class="btn btn-link" onclick="removeItem('iEstado');"><i class="icon-remove" ></i><?php echo $iEstado; ?></button><br>
<?php 
	}
	if ($iCidade) {
?>
		<input type="hidden" id="iCidade"  name="iCidade" value="<?php echo $iEstado; ?>">
		<button type="button" class="btn btn-link" onclick="removeItem('iCidade');"><i class="icon-remove" ></i><?php echo $iCidade; ?></button><br>
<?php 
	}		 		 		 
?>
	</div>
	<script>
		function removeItem(item) {
			document.getElementById(item).removeAttribute('value'); 
			document.forms[0].submit();
			return false;
		}
	</script>
<?php 
	if ($lista_contrato) {
?>
	<div class="well">
		<p><strong>Tipo Contrato</strong></p>
		<fieldset>		
 <?php
 		foreach ($lista_contrato as $row) {
 ?>
			<label>
 				<input type="radio" name="iContratoTipo" id="iContratoTipo_<?php echo $row->pct_id; ?>" value="<?php echo $row->pct_id; ?>"
 				onclick="document.forms[0].submit();">
				<?php echo $row->pct_descricao; ?>
			</label>
<?php 
		}
?>
		</select>
		</fieldset>
	</div>
<?php 
	} 
	if ($lista_tipoimovel) { 
?>
	<div class="well">		
		<p><strong>Tipo de Im�vel</strong></p>
		<fieldset>
<?php 
		foreach ($lista_tipoimovel as $row) {
?>
			<label>
 				<input type="radio" name="iCasaTipo" id="iCasaTipo_<?php echo $row->pt_id; ?>" value="<?php echo $row->pt_id; ?>"
 				onclick="document.forms[0].submit();">
				<?php echo $row->pt_descricao; ?>
			</label>
<?php 
		}?>		
		</fieldset>
	</div>
<?php 
	} 
	if ($lista_estado) { 
?>
	<div class="well">		
		<p><strong>Estado</strong></p>
		<fieldset>
<?php 
		foreach ($lista_estado as $row) {
?>
			<label>
 				<input type="radio" name="iEstado" id="iEstado_<?php echo $row->es_id; ?>" value="<?php echo $row->es_id; ?>"
 				onclick="document.forms[0].submit();">
				<?php echo $row->es_descricao; ?>
			</label>
<?php 
		}
?>		
		</fieldset>		
	</div>
<?php 
	} 
	if ($lista_cidade) { 
?>
	<div class="well">		
		<p><strong>Cidade</strong></p>
		<fieldset>
<?php 
		foreach ($lista_cidade as $row) {
?>
			<label>
 				<input type="radio" name="iCidade" id="iCidade_<?php echo $row->cd_id; ?>" value="<?php echo $row->cd_id; ?>"
 				onclick="document.forms[0].submit();">
				<?php echo $row->cd_descricao; ?>
			</label>
<?php 
		}
?>		
		</fieldset>
	</div>
<?php 
	} 
?>
	<div class="well">		
		<p><strong>Pre�o</strong></p>
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