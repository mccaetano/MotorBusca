<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Busca de Carros, Caminhoes, Barcos e Imóveis">
	<meta name="keywords" content="Carros,Caminhão,Moto,Pickupm,Casa,Apartamento,aluguel">
	<meta name="author" content="MCCAETANO Consultoria TI">
    <title><?= lang('title') ?></title>
	
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- Optional theme -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
    	<div class="container-fluid">
    		<div class="row">
				<div class="col-md-6">
					<img alt="Logo Empresa"
						src="<?php echo base_url();?>assets/img/LogoEmpresa.png">
				</div>
				<div class="col-md-6 text-right">
					<a href="<?php echo base_url();?>login">Login</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li class="active">Home</li>
					</ul>
				</div>
			</div>
    	</div>
		<div class="container-fluid">
			<div class="nav nav-pills nav-stacked">
			  <a href="#">
			    <h4 class="list-group-item-heading">Imoveis</h4>
			    <p class="list-group-item-text">...</p>
			  </a>	
			  <a href="#">
			    <h4 class="list-group-item-heading">Carros</h4>
			    <p class="list-group-item-text">...</p>
			  </a>	
			  <a href="#">
			    <h4 class="list-group-item-heading">Motos</h4>
			    <p class="list-group-item-text">...</p>
			  </a>
			</div>
    	</div>
    	<div class="container-fluid">
    		<div class="well">
				<div class="row">
					<div class="col-md-4">
						<p>
							<img alt="Facebook Logo"
								src="<?php echo base_url();?>assets/img/facebook48.png">Siganos
							no facebook <a title="Facebook fanpage"
								hre="http://www.facebook.com/pt/#MotorBusca">#Motorbusca</a>.
						</p>
						<p>
							<img alt="Facebook Logo"
								src="<?php echo base_url();?>assets/img/twitter48.png">Siganos
							no Twitter <a title="Twitter Link"
								hre="http://www.twitter.com/@MotorBusca">@Motorbusca</a>.
						</p>
					</div>
					<div class="col-md-2">
						<div class="divider"></div>
					</div>
					<div class="col-md-4">
						<ul class="nav nav-list">
							<li class="nav-header">List header</li>
							<li><a href="#">Home</a></li>
							<li><a href="#">Library</a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<hr/>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p class="muted credit text-center">
							&copy 2014 Motor - Todos os direitos reservados | 
							<a href="/termos-de-uso.html">Termos de uso</a> |
							<a href="/privacidade.html">Privacidade</a> |
							<a href="http://classificados.bemdireto.com.br" rel="bookmark external" title="Classificados de Imóveis">Classificados de Imóveis</a> |
							<a href="/mapa-do-site/">Mapa do site</a>													
						</p>
						<p class="muted credit text-right">
							<small>Powered by <a href="http://www.mccaetano.com.br">MCCAETANO</a></small>													
						</p>
					</div>
				</div>

			</div>
    	</div>
    	
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript">
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-52052725-1', 'mccaetano.com.br');
		  ga('send', 'pageview');

	</script>
  </body>
</html>
