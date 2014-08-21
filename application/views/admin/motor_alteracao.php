<div class="row-fluid">
	<div class="span8"><h1>Novo Feeds</h1></div>
	<div class="span2 pull-right"><a  class="btn btn-inverse" href="<?php echo base_url();?>admin/motorfeeds/lista">voltar</a>
	</div>
</div>
<div class="clear"></div>

<hr>

<div class="well">
	<form action="<?php echo base_url();?>admin/motorfeeds/alteracao/<?php echo $anuncio->man_id; ?>" class="form-horizontal" method="post">	
		<fieldset>
			<div class="control-group">
			    <label class="control-label" for="iDescricao">Descrica��o:</label>
			    <div class="controls">
			      <input type="text" id="iDescricao" name="iDescricao" placeholder="Preencha a descri��o do Feeds" value="<?php echo $anuncio->man_descricao; ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iAnunciante">Anunciante:</label>
			    <div class="controls">
			      <input type="text" id="iAnunciante" name="iAnunciante" placeholder="Preencha os nome do anunciante" value="<?php echo $anuncio->man_anunciante; ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iURL">URL Arquivo:</label>
			    <div class="controls">
			      <input type="url" id="iURL" name="iURL" placeholder="URL de arquivo XML" value="<?php echo $anuncio->man_url_carga; ?>">
			    </div>
		  	</div>
		  	<div class="control-group">
			    <label class="control-label" for="iTipoAnuncio">Tipo Anuncio:</label>
			    <div class="controls">
			    	<select id="iTipoAnuncio" name="iTipoAnuncio">
			    		<?php if ($tipoanuncio) { foreach ($tipoanuncio as $tipo) {?>
			    		<option value="<?php echo $tipo->tan_id; ?>" <?php echo set_select('iTipoAnuncio', $anuncio->tan_id) ?>><?php echo $tipo->tan_descricao; ?></option>
			    		<?php }} ?>
			    	</select>
			    </div>
		  	</div>
		  	
		  	<div class="control-group">
			    <div class="controls">
			    	<button class="btn btn-primary" type="submit">Salvar</button>
			    </div>
		  	</div>
		</fieldset>
	</form>
</div>

