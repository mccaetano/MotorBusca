	<div class="span8">
		<hr>
<?php 
	if ($pesquisa_resultado) { 
		$rcount = count($pesquisa_resultado);
		$npg = substr($pg, 1);	
		$rowi = ($npg - 1) * 10;
		$rowf = $rowi + 10;
		if (($rcount-$rowi) < 10) { 
			$rowf = $rcount-$rowi; 
		} 			
		for ($row=$rowi;$row < $rowf; $row++) {
?>
		<a href="<?php echo  base_url() . 'service/urlex/sender/' . base64_encode($pesquisa_resultado[$row]->ac_url); ?>">
<?php 
			if ($pesquisa_resultado[$row]->ac_destaque == 1) {
?>
		<div class="row-fluid" style="background-color: #BCDDE6; border: 1px solid gray;">
			<div class="span10">
<?php 
			} else {	
?>
		<div class="row-fluid" style="background-color: silver; border: 1px solid gray;">
			<div class="span10" style="background-color: #E0E0E0; border: 1px solid gray;">
<?php 
			}
?>
			
				<div class="row-fluid">
					<div class="span12">
						<?php echo $pesquisa_resultado[$row]->ac_title; ?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span6">						
						<?php echo $pesquisa_resultado[$row]->cd_descricao; ?>,&nbsp;
						<?php echo $pesquisa_resultado[$row]->es_descricao; ?>
					</div>
					<div class="span6">
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4" style="text-align: center;">
						<img alt="<?php echo $pesquisa_resultado[$row]->acf_titulo; ?>" src="<?php echo $pesquisa_resultado[$row]->acf_url; ?>" width="150" height="150"><br><br>
					</div>
					<div class="span8">
						<div class="row-fluid">
							<div class="span12">
								<?php echo $pesquisa_resultado[$row]->pt_descricao; ?>,&nbsp;
								<?php echo $pesquisa_resultado[$row]->pct_descricao; ?>,&nbsp; 
								<?php echo $pesquisa_resultado[$row]->ac_quartos; ?> Quartos,&nbsp;
								<?php echo $pesquisa_resultado[$row]->ac_banheiros; ?> Banheiros,&nbsp;
								<?php echo $pesquisa_resultado[$row]->ac_area_construida; ?>&nbsp;								
							</div>
						</div>
						<div class="row-fluid">
							<div class="span12">
								<?php echo $pesquisa_resultado[$row]->ac_descricao; ?>
							</div>
						</div>
					</div>
				</div>				
			</div>
			<div class="span2">
				<br>
				<div class="row-fluid" style="background-color: gray; color: yellow; text-align: center">
					<div class="span12">
						<?php echo $pesquisa_resultado[$row]->ac_preco; ?>
					</div>
				</div>
				<div class="row-fluid" style="text-align: center; font-size: x-small;">
					<div class="span12">
						Atualizado em <?php echo $pesquisa_resultado[$row]->ac_data_inclusao; ?>
					</div>
				</div>
				<div class="row-fluid" style="text-align: center; font-size: x-small;">
					<div class="span12">
						<i class="icon-search"></i>  Ver Fotos.
					</div>
				</div>
				<div class="row-fluid" style="text-align: center; font-size: x-small;">
					<div class="span12">
						<i class="icon-info-sign"></i>  Ver Telefone.
					</div>
				</div>
				<div class="row-fluid" style="text-align: center; font-size: x-small;">
					<div class="span12">
						<div class="btn">Ver Detalhes</div>.
					</div>
				</div>
			</div>
		</div>
		</a>
		<br>
<?php 
		} 
?>
		<hr>
		<div class="pagination">
		  <ul>		    
<?php 
	$total_pag = intval(count($pesquisa_resultado) / 10);
	$pgi = intval($npg / 10);
	if ($pgi == 0) { $pgi = 1;}
	$pgi = $pgi . str_repeat("0", strlen($npg)-1);
	$pgf = $pgi + 10;
	if (($total_pag - $pgf) < 10) { $pgf = $total_pag - $pgf; }	
?>
			<li><a class="btn-link" onclick="pageSubmit(<?php echo $pgi-1 <= 0 ? $pgi : $pgi-1; ?>);">Prev</a></li>
<?php 
	for ($i=$pgi; $i<$pgf; $i++) {
?> 
		    <li><a class="btn-link" onclick="pageSubmit(<?php echo $i; ?>);"><?php echo $i; ?></a></li>
<?php 
	}
?>
		    <li><a class="btn-link" onclick="pageSubmit(<?php echo ($pgf); ?>);">Next</a></li>
		  </ul>
		</div>
		<fieldset>
			<input id="pag" name="pag" type="hidden" value="<?php echo $pg; ?>">
		</fieldset>
		<script>
			function pageSubmit(pag) {
				document.getElementById('pag').value = 'p' + pag;
				document.forms[0].submit();
				return false;				
			}
		</script>
<?php 
	} ?>
	</div>