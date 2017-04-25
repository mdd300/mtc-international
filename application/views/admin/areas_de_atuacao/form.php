<div class="form-group">
	<label>Data de Criação: </label>
	<br>
	<p class="help-block"><?= gmdate ("d/m/Y h:ia",strtotime(@$area_de_atuacao->data_criacao)) ?></p>
</div>

<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($area_de_atuacao)) { echo "checked"; } ?> <?php if (@$area_de_atuacao->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$area_de_atuacao->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>

<?php if (@$area_de_atuacao->visualizacoes): ?>
	<div class="form-group">
		<label>Visualizações: </label>
		<br>
		<p class="help-block"><?= @$area_de_atuacao->visualizacoes ?></p>
	</div>
<?php endif ?>

<div class="form-group">
	<label for="titulo">Titulo: </label>
	<input name="titulo" id="titulo" type="text" class="form-control" value="<?= @$area_de_atuacao->titulo ?>">
</div>

<div class="form-group">
	<label for="lf">Resumo: </label>
	<textarea name="resumo" id="resumo" class="form-control" rows="3"><?= @$area_de_atuacao->resumo ?></textarea>
</div>

<div class="form-group">
	<label for="descricao">Descrição: </label>
	<textarea id="descricao" name="descricao"><?= @$area_de_atuacao->descricao ?></textarea>
</div>

<div class="form-group">
	<label for="description">Description: </label>
	<input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$area_de_atuacao->description ?>">
</div>

<div class="row">
	<div class="col-md-6">
		<?php if (!empty($area_de_atuacao->imagem)): ?>
			<div class="form-group">
				<img src="<?= base_url(); ?>assets/uploads/areas_de_atuacao/<?= @$area_de_atuacao->imagem; ?>" width="300px">
			</div>
		<?php endif ?>

		<div class="form-group">
			<label for="imagem">Thumb (368x269px): </label>
			<input name="imagem" id="imagem" type="file">
		</div>
	</div>

	<div class="col-md-6">
		<?php if (!empty($area_de_atuacao->imagem2)): ?>
			<div class="form-group">
				<img src="<?= base_url(); ?>assets/uploads/areas_de_atuacao/<?= @$area_de_atuacao->imagem2; ?>" width="300px">
			</div>
		<?php endif ?>

		<div class="form-group">
			<label for="imagem2">Imagem Principal (846x368px): </label>
			<input name="imagem2" id="imagem2" type="file">
		</div>
	</div>
</div>