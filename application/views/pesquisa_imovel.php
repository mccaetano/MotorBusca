<div class="span2">
	<div class="well">
		<p>Tipo Contrato</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="icasaTipo1" name="icasaTipo" value="">
				</label>
			</div>
		</div>
		<?php if ($pesquisa_tipo_casa) { foreach ($pesquisa_tipo_casa as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><?php echo mb_convert_encoding($row->pct_descricao, "ISO-8859-1", "auto"); ?>
					<input type="radio" id="icasaTipo<?php echo $row->pct_id; ?>" name="icasaTipo" value="<?php echo $row->pct_id; ?>">
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p>Tipo de Imóvel</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="ivalor1" name="ivalor" value="">
				</label>
			</div>
		</div>		
		<?php if ($tipo_imovel) { foreach ($tipo_imovel as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><?php echo mb_convert_encoding($row->pt_descricao, "ISO-8859-1", "auto"); ?>
					<input type="radio" id="icasaTipo<?php echo $row->pt_id; ?>" name="icasaTipo" value="<?php echo $row->pt_id; ?>">
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p>Estado</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="ivalor1" name="ivalor" value="">
				</label>
			</div>
		</div>				
		<?php if ($estado) { foreach ($estado as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><?php echo mb_convert_encoding($row->es_descricao, "ISO-8859-1", "auto"); ?>
					<input type="radio" id="icasaTipo<?php echo $row->es_id; ?>" name="icasaTipo" value="<?php echo $row->es_id; ?>">
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p>Cidade</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="ivalor1" name="ivalor" value="">
				</label>
			</div>
		</div>			
		<?php if ($cidade) { foreach ($cidade as $row) {?>
		<div class="control-group">
			<div class="controls">
				<label class="radio"><?php echo mb_convert_encoding($row->cd_descricao, "ISO-8859-1", "auto"); ?>
					<input type="radio" id="icasaTipo<?php echo $row->cd_id; ?>" name="icasaTipo" value="<?php echo $row->cd_id; ?>">
				</label>
			</div>
		</div>
		<?php }} ?>
	</div>
	<div class="well">		
		<p>Valor</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="ivalor1" name="ivalor" value="">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">10.000 - 80.000
					<input type="radio" id="ivalor2" name="ivalor" value="10000,80000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">80.000 - 100.000
					<input type="radio" id="ivalor2" name="ivalor" value="80000,100000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">100.000 - 200.000
					<input type="radio" id="ivalors" name="ivalor" value="100000,200000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">200.000 - 300.000
					<input type="radio" id="ivalors" name="ivalor" value="200000,300000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">300.000 - 400.000
					<input type="radio" id="ivalors" name="ivalor" value="300000,400000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">400.000 - 500.000
					<input type="radio" id="ivalors" name="ivalor" value="400000,500000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">500.000 - 700.000
					<input type="radio" id="ivalors" name="ivalor" value="500000,700000">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">700.000 - 1.000.000
					<input type="radio" id="ivalors" name="ivalor" value="700000,1000000">
				</label>
			</div>
		</div>
	</div>
	<div class="well">		
		<p>Quartos</p>
		<div class="control-group">
			<div class="controls">
				<label class="radio">Indiferente
					<input type="radio" id="iquartos1" name="iquartos" value="">
				</label>
			</div>		
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">1 Quarto
					<input type="radio" id="iquartos2" name="iquartos" value="1">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">2 Quarto
					<input type="radio" id="iquartos2" name="iquartos" value="2">
				</label>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<label class="radio">3 Quarto
					<input type="radio" id="iquartos" name="iquartos" value="3">
				</label>
			</div>
		</div>
	</div>
</div>