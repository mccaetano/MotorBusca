<!DOCTYPE html>
<html lang="pt-BR">
<head>
<title>Adminsitração do Motor de Busca</title>
<meta name="description" content="Administração do Motor de Busca">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="robots" content="index,follow">
<!-- Bootstrap -->
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css"
	rel="stylesheet" media="screen">
<style type="text/css">

/* Sticky footer styles
      -------------------------------------------------- */
html,body {
	height: 100%;
	/* The html and body elements cannot have any padding or margin. */
}

/* Wrapper for page content to push down footer */
#wrap {
	min-height: 100%;
	height: auto !important;
	height: 100%;
	/* Negative indent footer by it's height */
	margin: 0 auto -60px;
}

/* Set the fixed height of the footer here */
#push,#footer {
	height: 60px;
}

#footer {
	background-color: #f5f5f5;
}

/* Lastly, apply responsive CSS fixes as necessary */
@media ( max-width : 1200px) {
	#footer {
		margin-left: -20px;
		margin-right: -20px;
		padding-left: 20px;
		padding-right: 20px;
	}
}

/* Custom page CSS
      -------------------------------------------------- */
/* Not required for template or sticky footer method. */
.container {
	width: auto;
	max-width: 680px;
}

.container .credit {
	margin: 20px 0;
}
</style>

<link href="<?php echo base_url();?>assets/css/bootstrap-responsive.css"
	rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="<?php echo base_url();?>assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="<?php echo base_url();?>assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="<?php echo base_url();?>assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="<?php echo base_url();?>assets/ico/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon"
	href="<?php echo base_url();?>assets/ico/favicon.png">
</head>
<body>
	<div id="wrap">
		<div class="container">
			<div class="masthead">
				<h3 class="muted">Administração do Motor de Busca</h3>
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<ul class="nav">
								<li <?php echo  $ativo == "home" ? "class=\"active\"" : "" ?>><a href="<?php echo base_url();?>admin">Home</a></li>
								<li <?php echo  $ativo == "perfil" ? "class=\"active\"" : "" ?>><a href="<?php echo base_url();?>admin/perfil/lista">Perfil</a></li>
								<li <?php echo  $ativo == "feeds" ? "class=\"active\"" : "" ?>><a href="#">Feeds</a></li>
								<li <?php echo  $ativo == "alertas" ? "class=\"active\"" : "" ?>><a href="#">Alertas</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>