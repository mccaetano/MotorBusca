<div class="masthead">
	<div class="pull-center">
		<img align="middle" alt="Logo da empresa"
			src="<?php echo base_url();?>assets/img/LogoEmpresa.png">
	</div>
	<hr>
</div>

<form action="#" method="post">
	<fieldset>
		<div class="row-fluid">
			<div class="span2"></div>
			<div class="span8 pull-center">
				<div class="input-prepend input-append">
					<div class="btn-group">
						<button class="btn dropdown-toggle" data-toggle="dropdown">
							<?php echo $tipo_descricao ?> <span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<?php
								$base = base_url();
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
					<input type="text" class="input-xxlarge">
					<button type="submit" class="btn">Buscar</button>
				</div>
			</div>
			<div class="span2 pesquisa_google">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- responsive_homepage -->
				<ins class="adsbygoogle"
				    style="display:block"
				    data-ad-client="ca-pub-9502373842331841"
				    data-ad-slot="6462951553"
				    data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>			
			</div>
		</div>

	</fieldset>
</form>