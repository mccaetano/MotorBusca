<div class="masthead">
	<div class="pull-center">
		<img align="middle" alt="Logo da empresa"
			src="<?php echo base_url();?>assets/img/LogoEmpresa.png">
	</div>
	<hr>
</div>
<div class="hero-unit">
	<div class="row-fluid">
		<div class="span2 pull-center">
			<a href="<?php echo base_url();?>pesquisa/imovel"> <img alt="Casa"
				src="<?php echo base_url();?>assets/img/Imoveis.jpg">
				<p>Imóvel</p>
			</a>
		</div>
		<div class="span2 pull-center">
			<a href="<?php echo base_url();?>pesquisa/auto"> <img alt="Auto"
				src="<?php echo base_url();?>assets/img/Carros.jpg">
				<p>Autos</p>
			</a>
		</div>
		<div class="span2 pull-center">
			<a href="<?php echo base_url();?>pesquisa/emprego"> <img
				alt="Emprego" src="<?php echo base_url();?>assets/img/Empregos.jpg">
				<p>Emprego</p>
			</a>
		</div>
		<div class="span2 pull-center">
			<a href="<?php echo base_url();?>pesquisa/produto"> <img
				alt="Produto" src="<?php echo base_url();?>assets/img/Produtos.jpg">
				<p>Produto</p>
			</a>
		</div>
		<div class="span2 pull-center">
			<a href="<?php echo base_url();?>pesquisa/temporada"> <img
				alt="Temporada"
				src="<?php echo base_url();?>assets/img/Temporadas.jpg">
				<p>Temporada</p>
			</a>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="row">
	<div class="span5 offset3">
		<div class="well">
			<h4><i class="icon-envelope"></i>Receba seus Anuncios no seu email, grátis</h4>
			<form action="<?php base_url();?>alerta/cadastro" method="post"   class="form-inline">
				<input class="input-xlarge" type="text" name="iEmail" id="iEmail" placeholder="Prencha o seu email aqui">
				<button class="btn btn-success">Criar Alerta</button>
			</form>
		</div>
	</div>
</div>