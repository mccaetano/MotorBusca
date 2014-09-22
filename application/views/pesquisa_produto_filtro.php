<div class="span2">
	<div class="well">
<?php 
	if ($iPesquisa) {
?>	
		<a class="btn-link" href="<?php echo base_url();?>pesquisa/produto/p1"><i class="icon-remove"></i><?php echo $iPesquisa; ?></a><br>	
<?php 
	}
	if ($iCategoria) {
?>
		<input type="hidden" id="iCategoria" name="iCategoria" value="<?php echo $iCategoria; ?>">
		<a class="btn-link" onclick="removeItem('iCategoria');"><i class="icon-remove"></i><?php echo $iCategoria; ?></a><br>		
<?php 
	}
	if ($iMarca) {
?>
		<input type="hidden" id="iMarca"  name="iMarca" value="<?php echo $iMarca; ?>">
		<a class="btn-link" onclick="removeItem('iMarca');"><i class="icon-remove"></i><?php echo $iMarca_descricao; ?></a><br>
<?php 
	}
	if ($iModelo) {
?>
		<input type="hidden" id="iModelo"  name="iModelo" value="<?php echo $iModelo; ?>">
		<a class="btn-link" onclick="removeItem('iModelo');"><i class="icon-remove"></i><?php echo $iModelo_descricao; ?></a><br>
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
	if ($lista_categoria) {
?>
	<div class="well">
		<p><strong>Categoiao</strong></p>
		<fieldset>		
 <?php
 		foreach ($lista_categoria as $row) {
 ?>
			<label>
 				<input type="radio" name="iCategoria" id="iCategoria_<?php echo $row->prc_id; ?>" value="<?php echo $row->prc_id; ?>"
 				onclick="document.forms[0].submit();">
				<small><?php echo $row->prc_descricao; ?></small>
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
		 				<input type="radio" name="iMarca" id="iMarca_<?php echo $row->pmr_id; ?>" value="<?php echo $row->pmr_id; ?>"
		 				onclick="document.forms[0].submit();">
						<small><?php echo $row->pmr_descricao; ?></small>
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
		 				<input type="radio" name="iModelo" id="iModelo_<?php echo $row->pmd_id; ?>" value="<?php echo $row->pmd_id; ?>"
		 				onclick="document.forms[0].submit();">
						<small><?php echo $row->pmd_descricao; ?></small>
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
?>
</div>

