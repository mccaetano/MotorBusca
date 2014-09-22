<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>	
		<a class="btn-link" href="<?php echo base_url();?>pesquisa/temporada/p1"><i class="icon-remove"></i><?php echo $iPesquisa; ?></a><br>	
<?php 
	}
	if ($iTipoImovel) {
?>
		<input type="hidden" id="iTipoImovel" name="iTipoImovel" value="<?php echo $iTipoImovel; ?>">
		<a class="btn-link" onclick="removeItem('iTipoImovel');"><i class="icon-remove"></i><?php echo $iTipoImovel_descricao; ?></a><br>		
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
	if ($lista_tipoimovel) {
?>
	<div class="well">
		<p><strong>Tipo Imóvel</strong></p>
		<fieldset>		
 <?php
 		foreach ($lista_tipoimovel as $row) {
 ?>
			<label>
 				<input type="radio" name="iTipoImovel" id="iTipoImovel_<?php echo $row->tpi_id; ?>" value="<?php echo $row->tpi_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->tpi_descricao; ?></small>
			</label>
<?php 
		}
?>
		</select>
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


