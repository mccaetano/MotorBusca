<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>	
		<a class="btn-link" href="<?php echo base_url();?>pesquisa/emprego/p1"><i class="icon-remove"></i><?php echo $iPesquisa; ?></a><br>	
<?php 
	}
	if ($iContrato) {
?>
		<input type="hidden" id="iContrato" name="iContrato" value="<?php echo $iContrato; ?>">
		<a class="btn-link" onclick="removeItem('iContrato');"><i class="icon-remove"></i><?php echo $iContrato_descricao; ?></a><br>		
<?php 
	}
	if ($iCategoria) {
?>
		<input type="hidden" id="iCategoria"  name="iCategoria" value="<?php echo $iCategoria; ?>">
		<a class="btn-link" onclick="removeItem('iCategoria');"><i class="icon-remove"></i><?php echo $iCategoria_descricao; ?></a><br>
<?php 
	}
	if ($iPeriodo) {
?>
		<input type="hidden" id="iPeriodo"  name="iPeriodo" value="<?php echo $iPeriodo; ?>">
		<a class="btn-link" onclick="removeItem('iPeriodo');"><i class="icon-remove"></i><?php echo $iPeriodo_descricao; ?></a><br>
<?php 
	}
	if ($iPais) {
?>
		<input type="hidden" id="iPais"  name="iPais" value="<?php echo $iPais; ?>">
		<a class="btn-link" onclick="removeItem('iPais');"><i class="icon-remove"></i><?php echo $iPais_descricao; ?></a><br>
<?php 
	}
	if ($iEstado) {
?>
		<input type="hidden" id="iEstado"  name="iEstado" value="<?php echo $iEstado; ?>">
		<a class="btn-link" onclick="removeItem('iEstado');"><i class="icon-remove"></i><?php echo $iEstado_descricao; ?></a><br>
<?php 
	}
	if ($iCidade) {
?>
		<input type="hidden" id="iCidade"  name="iCidade" value="<?php echo $iCidade; ?>">
		<a class="btn-link" onclick="removeItem('iCidade');"><i class="icon-remove"></i><?php echo $iCidade_descricao; ?></a><br>
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
 				<input type="radio" name="iContrato" id="iContrato_<?php echo $row->emc_id; ?>" value="<?php echo $row->emc_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->emc_descricao; ?></small>
			</label>
<?php 
		}
?>
		</select>
		</fieldset>
	</div>
<?php 
	} 
	if ($lista_categoria) { 
?>
	<div class="well">		
		<p><strong>Categoria</strong></p>
		<fieldset>
<?php 
		foreach ($lista_categoria as $row) {
?>
			<label>
 				<input type="radio" name="iCategoria" id="iCategoria_<?php echo $row->ect_id; ?>" value="<?php echo $row->ect_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->ect_descricao; ?></small>
			</label>
<?php 
		}?>		
		</fieldset>
	</div>
<?php 
	}
	if ($lista_periodo) { 
?>
	<div class="well">		
		<p><strong>Período</strong></p>
		<fieldset>
<?php 
		foreach ($lista_periodo as $row) {
?>
			<label>
 				<input type="radio" name="iPeriodo" id=""iPeriodo"_<?php echo $row->emp_id; ?>" value="<?php echo $row->emp_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->emp_descricao; ?></small>
			</label>
<?php 
		}?>		
		</fieldset>
	</div>
<?php 
	}
	if ($lista_pais) { 
?>
	<div class="well">		
		<p><strong>Pais</strong></p>
		<fieldset>
<?php 
		foreach ($lista_pais as $row) {
?>
			<label>
 				<input type="radio" name="iPais" id="iPais_<?php echo $row->ps_id; ?>" value="<?php echo $row->ps_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->ps_descricao; ?></small>
			</label>
<?php 
		}
?>		
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
				<small><?php echo $row->es_descricao; ?></small>
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
				<small><?php echo $row->cd_descricao; ?></small>
			</label>
<?php 
		}
?>		
		</fieldset>
	</div>
<?php 
	}  
?>
</div>

