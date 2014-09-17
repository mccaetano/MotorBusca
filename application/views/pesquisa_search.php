<div class="row-fluid">	
	<div class="span12  pull-center">
		<form name="frmPesquisa" id="frmPesquisa" action="<?php echo base_url(); ?>pesquisa/find" method="post"> 
		<div class="input-prepend input-append">
			<div class="btn-group">
				
				<button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $tipo_descricao ?> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
								<?php
								$base = base_url ();
								if ($tipo != 'imovel') {
									echo "<li><a href=\"" . $base . "pesquisa/imovel\">Imóvel</a></li>" . PHP_EOL;
								}
								if ($tipo != 'auto') {
									echo "<li><a href=\"" . $base . "pesquisa/auto\">Auto</a></li>" . PHP_EOL;
								}
								if ($tipo != 'emprego') {
									echo "<li><a href=\"" . $base . "pesquisa/emprego\">Emprego</a></li>" . PHP_EOL;
								}
								if ($tipo != 'produto') {
									echo "<li><a href=\"" . $base . "pesquisa/produto\">Produto</a></li>" . PHP_EOL;
								}
								if ($tipo != 'temporada') {
									echo "<li><a href=\"" . $base . "pesquisa/temporada\">Temporada</a></li>" . PHP_EOL;
								}
								?>
							</ul>
			</div>
			<input type="text" class="input-xxlarge" name="iPesquisa" value="<?php echo $iPesquisa; ?>">
			<button name="btnPesquisa"  id="btnPesquisa" type="submit" class="btn" value="<?php echo $tipo; ?>">Buscar</button>					
		</div>
		</form>
	</div>
</div>
