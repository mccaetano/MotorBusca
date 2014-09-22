<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>	
		<a class="btn-link" href="<?php echo base_url();?>pesquisa/auto/p1"><i class="icon-remove"></i><?php echo $iPesquisa; ?></a><br>	
<?php 
	}
	if ($iCarroTipo) {
?>
		<input type="hidden" id="iCarroTipo" name="iCarroTipo" value="<?php echo $iCarroTipo; ?>">
		<a class="btn-link" onclick="removeItem('iCarroTipo');"><i class="icon-remove"></i><?php echo $iCarroTipo_descricao; ?></a><br>		
<?php 
	}
	if ($iCarroMarca) {
?>
		<input type="hidden" id="iCarroMarca"  name="iCarroMarca" value="<?php echo $iCarroMarca; ?>">
		<a class="btn-link" onclick="removeItem('iCarroMarca');"><i class="icon-remove"></i><?php echo $iCarroMarca_descricao; ?></a><br>
<?php 
	}
	if ($iCarroModelo) {
?>
		<input type="hidden" id="iCarroModelo"  name="iCarroModelo" value="<?php echo $iCarroModelo; ?>">
		<a class="btn-link" onclick="removeItem('iCarroModelo');"><i class="icon-remove"></i><?php echo $iCarroModelo_descricao; ?></a><br>
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
	if ($iNovo) {
?>
		<input type="hidden" id="iNovo"  name="iNovo" value="<?php echo $iNovo; ?>">
		<a class="btn-link" onclick="removeItem('iNovo');"><i class="icon-remove"></i><?php echo $iNovo_descricao; ?></a><br>
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
	if ($lista_tipocarro) {
?>
	<div class="well">
		<p><strong>Tipo Auto</strong></p>
		<fieldset>		
 <?php
 		foreach ($lista_tipocarro as $row) {
 ?>
			<label>
 				<input type="radio" name="iCarroTipo" id="iCarroTipo_<?php echo $row->crt_id; ?>" value="<?php echo $row->crt_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->crt_descricao; ?></small>
			</label>
<?php 
		}
?>
		</select>
		</fieldset>
	</div>
<?php 
	} 
	if ($lista_marca) {
		?>
		<div class="well">
			<p><strong>Marca</strong></p>
			<fieldset>		
	 <?php
	 		foreach ($lista_marca as $row) {
	 ?>
				<label>
	 				<input type="radio" name="iCarroMarca" id="iCarroMarca_<?php echo $row->cmr_id; ?>" value="<?php echo $row->cmr_id; ?>"
	 				onclick="document.forms[0].submit();">
					<small><?php echo $row->cmr_descricao; ?></small>
				</label>
	<?php 
			}
	?>
			</select>
			</fieldset>
		</div>
	<?php 
	} 
	if ($lista_modelo) {
		?>
		<div class="well">
			<p><strong>Marca</strong></p>
			<fieldset>		
	 <?php
	 		foreach ($lista_modelo as $row) {
	 ?>
				<label>
	 				<input type="radio" name="iCarroModelo" id="iCarroModelo_<?php echo $row->cmd_id; ?>" value="<?php echo $row->cmd_id; ?>"
	 				onclick="document.forms[0].submit();">
					<small><?php echo $row->cmd_descricao; ?></small>
				</label>
	<?php 
			}
	?>
			</select>
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
	if ($lista_novo) {
		?>
		<div class="well">		
			<p><strong>0 KM</strong></p>
			<fieldset>
	<?php 
			foreach ($lista_novo as $row) {
	?>
				<label>
	 				<input type="radio" name="iNovo" id="iNovo_<?php echo $row['nv_id']; ?>" value="<?php echo $row['nv_id']; ?>"
	 				onclick="document.forms[0].submit();">
					<small><?php echo $row['nv_descricao']; ?></small>
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
	