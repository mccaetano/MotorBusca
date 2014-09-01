<div class="clear"></div>
<div class="row text-center">
	<div class="span12"><h1>Seu Alerta</h1></div>
</div>
<hr>
<div class="well">
<form action="<?php echo base_url();?>alerta/cadastro" method="post">
<fieldset>
<div class="row text-center">
	<div class="span12">
		<input type="text" id="iPesquisa" name="iPesquisa" class="span10" placeholder="Titulo do Alerta">
	</div>
</div>
<div class="row text-center">
	<div class="span12">Tipo de Aleta</div>
</div>
<div class="row text-center">
	<div class="span12">
		<div class="tabbable">
		<ul class="nav nav-tabs">
			<li <?php echo $tipoalerta == 1 ? "class=\"active\"" : ""; ?>>
				<a href="<?php echo base_url();?>alerta/cadastro/1">Imóvel</a>
			</li>
			<li <?php echo $tipoalerta == 2 ? "class=\"active\"" : ""; ?>><a href="<?php echo base_url();?>alerta/cadastro/2">Auto</a></li>
			<li <?php echo $tipoalerta == 3 ? "class=\"active\"" : ""; ?>><a href="<?php echo base_url();?>alerta/cadastro/3">Emprego</a></li>
			<li <?php echo $tipoalerta == 4 ? "class=\"active\"" : ""; ?>><a href="<?php echo base_url();?>alerta/cadastro/4">Produto</a></li>
			<li <?php echo $tipoalerta == 5 ? "class=\"active\"" : ""; ?>><a href="<?php echo base_url();?>alerta/cadastro/5">Temporada</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane <?php echo $tipoalerta == 1 ? "class=\"active\"" : ""; ?>" id="1">
				<p>panel1</p>
			</div>
			<div class="tab-pane <?php echo $tipoalerta == 1 ? "class=\"active\"" : ""; ?>" id="2">
				<p>panel2</p>
			</div>
			<div class="tab-pane <?php echo $tipoalerta == 1 ? "class=\"active\"" : ""; ?>" id="3">
				<p>panel3</p>
			</div>
		</div>
		</div>
	</div>
</div>
</fieldset>
</form>
</div>