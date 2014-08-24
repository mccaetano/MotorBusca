	</div>
	<div class="span8">
		<div class="row-fluid">	
			<div class="span12  pull-center"> 
				<div class="input-prepend input-append">
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">
										<?php echo $tipo_descricao ?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
										<?php
										$base = base_url ();
										if ($tipo != 1) {
											echo "<li><a href=\"" . $base . "pesquisa/imovel\">Imóvel</a></li>" . PHP_EOL;
										}
										if ($tipo != 2) {
											echo "<li><a href=\"" . $base . "pesquisa/auto\">Auto</a></li>" . PHP_EOL;
										}
										if ($tipo != 3) {
											echo "<li><a href=\"" . $base . "pesquisa/emprego\">Emprego</a></li>" . PHP_EOL;
										}
										if ($tipo != 4) {
											echo "<li><a href=\"" . $base . "pesquisa/produto\">Produto</a></li>" . PHP_EOL;
										}
										if ($tipo != 5) {
											echo "<li><a href=\"" . $base . "pesquisa/temporada\">Temporada</a></li>" . PHP_EOL;
										}
										?>
									</ul>
					</div>
					<input type="text" class="input-xxlarge" name="iPesquisa" value="<?php echo set_value('iPesquisa', ''); ?>">
					<button type="submit" class="btn">Buscar</button>
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12">
