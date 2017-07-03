<div class="form-group">
	<label>Data de Criação: </label>
	<br>
	<p class="help-block"><?= gmdate ("d/m/Y h:ia",strtotime(@$operacao->data_criacao)) ?></p>
</div>

<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($operacao)) { echo "checked"; } ?> <?php if (@$operacao->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$operacao->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>

<?php if (@$operacao->visualizacoes): ?>
	<div class="form-group">
		<label>Visualizações: </label>
		<br>
		<p class="help-block"><?= @$operacao->visualizacoes ?></p>
	</div>
<?php endif ?>

<div class="form-group">
	<label for="titulo">Titulo: </label>
	<input name="titulo" id="titulo" type="text" class="form-control" value="<?= @$operacao->titulo ?>">
</div>

<div class="form-group">
	<label for="descricao">Descrição: </label>
	<textarea id="descricao" name="descricao"><?= @$operacao->descricao ?></textarea>
</div>

<div class="row">
	<div class="col-md-6">
		<?php if (!empty($operacao->imagem)): ?>
			<div class="form-group">
				<img src="<?= base_url(); ?>assets/uploads/operacoes/<?= @$operacao->imagem; ?>" width="300px">
			</div>
		<?php endif ?>

		<div class="form-group">
			<label for="imagem">Thumb (368x269px): </label>
			<input name="imagem" id="imagem" type="file">
		</div>
	</div>
</div>