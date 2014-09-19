<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>	
		<a class="btn-link" href="<?php echo base_url();?>pesquisa/imovel/p1"><i class="icon-remove"></i><?php echo $iPesquisa; ?></a><br>	
<?php 
	}
	if ($iContratoTipo) {
?>
		<input type="hidden" id="iContratoTipo" name="iContratoTipo" value="<?php echo $iContratoTipo; ?>">
		<a class="btn-link" onclick="removeItem('iContratoTipo');"><i class="icon-remove"></i><?php echo $iContratoTipo_descricao; ?></a><br>		
<?php 
	}
	if ($iCasaTipo) {
?>
		<input type="hidden" id="iCasaTipo"  name="iCasaTipo" value="<?php echo $iCasaTipo; ?>">
		<a class="btn-link" onclick="removeItem('iCasaTipo');"><i class="icon-remove"></i><?php echo $iCasaTipo_descricao; ?></a><br>
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
	if ($iPreco) {
?>
		<input type="hidden" id="iPreco"  name="iPreco" value="<?php echo $iPreco; ?>">
		<a class="btn-link" class="btn-link" onclick="removeItem('iPreco');"><i class="icon-remove"></i><?php echo $iPreco_descricao; ?></a><br>
<?php 
	}		 		 		 
	if ($iQuarto) {
?>
		<input type="hidden" id="iQuarto"  name="iQuarto" value="<?php echo $iQuarto; ?>">
		<a class="btn-link" onclick="removeItem('iQuarto');"><i class="icon-remove"></i><?php echo $iQuarto_descricao; ?></a><br>
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
				<small><?php echo $row->pct_descricao; ?></small>
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
		<p><strong>Tipo de Imóvel</strong></p>
		<fieldset>
<?php 
		foreach ($lista_tipoimovel as $row) {
?>
			<label>
 				<input type="radio" name="iCasaTipo" id="iCasaTipo_<?php echo $row->pt_id; ?>" value="<?php echo $row->pt_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->pt_descricao; ?></small>
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

	if ($lista_preco) { 
?>
	<div class="well">		
		<p><strong>Preço</strong></p>
		<fieldset>
<?php 
		foreach ($lista_preco as $row) {
?>
			<label>
 				<input type="radio" name="iPreco" id="iPreco_<?php echo $row['prc_id']; ?>" value="<?php echo $row['prc_id']; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row['prc_descricao']; ?></small>
			</label>
<?php 
		}
?>		
		</fieldset>
	</div>
<?php 
	} 
	if ($lista_quarto) {
		?>
		<div class="well">		
			<p><strong>Quartos</strong></p>
			<fieldset>
	<?php 
			foreach ($lista_quarto as $row) {
	?>
				<label>
	 				<input type="radio" name="iQuarto" id="iQuarto_<?php echo $row['qrt_id']; ?>" value="<?php echo $row['qrt_id']; ?>"
	 				onclick="document.forms[0].submit();">
					<small><?php echo $row['qrt_descricao']; ?></small>
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
