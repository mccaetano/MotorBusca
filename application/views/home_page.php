<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description"
	content="Busca de Carros, Caminhoes, Barcos e Imóveis">
<meta name="keywords"
	content="Carros,Caminhão,Moto,Pickupm,Casa,Apartamento,aluguel">
<meta name="author" content="MCCAETANO Consultoria TI">
<title><?= lang('title') ?></title>

<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet">
<style type="text/css">
div#Imovel {
	background-image:
		"<?php echo base_url();?>assets/img/imoveis-a-venda-na-planta.jpg";
}
</style>
<!-- responsive -->
<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css"
	rel="stylesheet">

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="../assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="../assets/ico/favicon.png">


<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">
		<header>
			<div class="row">
				<div class="span6">
					<img alt="Logo Empresa"
						src="<?php echo base_url();?>assets/img/LogoEmpresa.png">
				</div>
				<div class="span6 text-right">
					<a href="<?php echo base_url();?>login">Login</a>
				</div>
			</div>
			<ul class="breadcrumb">
				<li class="active">Home</li>
			</ul>
		</header>
		<div class="container">
			<ul class="nav nav-tabs nav-stacked">
				<li><a href="#">
						<div class="row-fluid  Imovel">
							<div class="span4">
								<h1><img src="<?php echo base_url();?>assets/img/HomeHouse.png"> Imóveis</h1>
							</div>
							<div class="span8 text-right">
								<?php form_open("#")?>
									<fieldset>
										<div class="input-append">
										<input class="input-large" name="busca" type="text" placeholder="Preencha aqui o tipo de imóvel você procura">
										<button class="btn">Buscar</button> 
										</div>
									</fieldset>
								<?php form_close()?>
							</div>
						</div>
				</a></li>
				<li><a href="#">
						<div class="row-fluid">
							<div class="span6">
								<h1><img src="<?php echo base_url();?>assets/img/HomeCar.png"> Carros</h1>
							</div>
							<div class="span6 text-right">
								<?php form_open("#")?>
									<fieldset>
										<div class="input-append">
										<input class="input-large" name="busca" type="text" placeholder="Preencha aqui o tipo de Carro você procura">
										<button class="btn">Buscar</button> 
										</div>
									</fieldset>
								<?php form_close()?>
							</div>
						</div>
				</a></li>
				<li><a href="#">
						<div class="row-fluid">
							<div class="span6">
								<h1><img src="<?php echo base_url();?>assets/img/HomeCargo.png"> Caminhões</h1>
							</div>
							<div class="span6 text-right">
								<?php form_open("#")?>
									<fieldset>
										<div class="input-append">
										<input class="input-large" name="busca" type="text" placeholder="Preencha aqui o tipo de Caminhão você procura">
										<button class="btn">Buscar</button> 
										</div>
									</fieldset>
								<?php form_close()?>
							</div>
						</div>
				</a></li>
				<li><a href="#">
						<div class="row-fluid">
							<div class="span6">
								<h1><img src="<?php echo base_url();?>assets/img/HomeMoto.png"></i> Motos</h1>
							</div>
							<div class="span6 text-right">
								<?php form_open("#")?>
									<fieldset>
										<div class="input-append">
										<input class="input-large" name="busca" type="text" placeholder="Preencha aqui o tipo de Moto você procura">
										<button class="btn">Buscar</button> 
										</div>
									</fieldset>
								<?php form_close()?>
							</div>
						</div>
				</a></li>
				<li><a href="#">
						<div class="row-fluid">
							<div class="span6">
								<h1><img src="<?php echo base_url();?>assets/img/HomeBoat.png"></i> Nautica</h1>
							</div>
							<div class="span6 text-right">
								<?php form_open("#")?>
									<fieldset>
										<div class="input-append">
										<input class="input-large" name="busca" type="text" placeholder="Preencha aqui o tipo de Barco você procura">
										<button class="btn">Buscar</button> 
										</div>
									</fieldset>
								<?php form_close()?>
							</div>
						</div>
				</a></li>
			</ul>
		</div>
		<footer>
			<div class="well">
				<div class="row-fluid">
					<div class="span4">
						<p>
							<img alt="Facebook Logo"
								src="<?php echo base_url();?>assets/img/facebook48.png">Siga-nos
							no facebook <a title="Facebook fanpage"
								hre="http://www.facebook.com/pt/#MotorBusca">#Motorbusca</a>.
						</p>
						<p>
							<img alt="Facebook Logo"
								src="<?php echo base_url();?>assets/img/twitter48.png">Siga-nos
							no Twitter <a title="Twitter Link"
								hre="http://www.twitter.com/@MotorBusca">@Motorbusca</a>.
						</p>
					</div>
					<div class="span2">
						<div class="divider"></div>
					</div>
					<div class="span2">
						<p>
							<a href="#">Sobre</a><br/>
						 	<a href="#">Ajuda</a><br/>
						 	<a href="#">Contato</a>
						 </p>
					</div>
					<div class="span2">
						<p>
							<a href="#">Alerta</a><br/>
						 	<a href="#">FAQ</a>
						 </p>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<hr/>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<p class="muted credit text-center">
							© 2013 MCCAETANO - Todos os direitos reservados | <a href="#">Termos de uso</a> | <a href="#">Privacidade</a> | <a href="#">Mapa do site</a>
						</p>
					</div>
				</div>

			</div>
		</footer>
	</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://code.jquery.com/jquery.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
</body>
</html>