<div class="page-header">
	<h1>Feeds</h1>
</div>
<div class="row">
	<div class="col-md-4">
		<div class="panel-default">
			<div class="panel-heading"><h4>Feeds (Anúncios)</h4></div>
			<div class="panel-body">
				<ul class="nav nav-pills  nav-stacked">
					<li class="active"><a href="<?php echo base_url(); ?>feeds">Feeds</a></li>
					<li><a href="<?php echo base_url(); ?>feeds/imoveis">Imóveis</a></li>
					<li><a href="<?php echo base_url(); ?>feeds/carros">Carros</a></li>
					<li><a href="<?php echo base_url(); ?>feeds/motos">Motos</a></li>
					<li><a href="<?php echo base_url(); ?>feeds/caminhoes">Caminhoes</a></li>
					<li><a href="<?php echo base_url(); ?>feeds/nautica">Náutica</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<h3>Feeds Motor Busca</h3>
		<p>Caso tenha um site de classificados com mais de 100 anúncios, inclua seus anúncios no MotorBusca. É muito simples.
		</p>
		<p>Nosso motor pode ser utilizado com duas tecnologias, Json e XML. Essas tecnologias de transferencia de dados são as mais utilizadas pelo mercado.		
		</p>
		<p>É muito facil utilizar nosso feed. Preencha o formulário de cadastro de feed e mande o link onde iremos buscar os dados para incluir seus anúncios.<br/>
		É possívem enviar varios anúncios num mesmo feed veja o exemplo:</p>
		<div class="well text-center">
			http://www.seudominou/motorbusca.xml <span class="text-muted">ou</span> http://www.seudominou/motorbusca.json
		</div>
		<p>Você poderá incluir, alterar e cancelar seus anúncios. Para isso basta envia dentro anúncio a inofrmação <strong>acao</strong>.</p>
		<h3>XML Feed</h3>
		<p>Para XML feed os dados devem estar com o formato texto UTF-8, então deve enviar o cabeçalho XML:</p>
		<div class="well text-center">
			&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;
		</div>
		<p>Todo os campos do XML são formatados para aceitar todos os tipos de caracters para isso sempre envie com marcação generíca</p>
		<div class="well text-center">
			&lt;titulo&gt;&lt;![CDATA[<span class="text-muted">Meu titulo do anuncio</span>]]&gt;&gt;&lt;/titulo&gt;
		</div>
		 
	</div>
</div>