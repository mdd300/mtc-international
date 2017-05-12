<div class="form-group">
	<label>Data de Criação: </label>
	<br>
	<p class="help-block"><?= gmdate ("d/m/Y h:ia",strtotime(@$noticia->data_criacao)) ?></p>
</div>

<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($noticia)) { echo "checked"; } ?> <?php if (@$noticia->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$noticia->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>

<?php if (@$noticia->visualizacoes): ?>
	<div class="form-group">
		<label>Visualizações: </label>
		<br>
		<p class="help-block"><?= @$noticia->visualizacoes ?></p>
	</div>
<?php endif ?>

<div class="form-group">
    <label for="tipo">Destaque? </label>
    <select name="tipo" id="tipo" class="form-control">
        <option <?php echo (@$noticia->tipo == 'nenhum') ? 'selected="selected"' : ''; ?> value="nenhum">Não</option>
        <option <?php echo (@$noticia->tipo == 'projetos') ? 'selected="selected"' : ''; ?> value="projetos">Projeto em Destaque</option>
        <option <?php echo (@$noticia->tipo == 'inspiracao') ? 'selected="selected"' : ''; ?> value="inspiracao">Inovação e Inspiração</option>
    </select>
</div>

<div class="form-group">
	<label for="titulo">Titulo: </label>
	<input name="titulo" id="titulo" type="text" class="form-control" value="<?= @$noticia->titulo ?>">
</div>

<div class="form-group">
	<label for="lf">Resumo: </label>
	<textarea name="resumo" id="resumo" class="form-control" rows="3"><?= @$noticia->resumo ?></textarea>
</div>

<div class="form-group">
	<label for="descricao">Descrição: </label>
	<textarea id="descricao" name="descricao"><?= @$noticia->descricao ?></textarea>
</div>

<div class="form-group">
	<label for="description">Description: </label>
	<input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$noticia->description ?>">
</div>

<div class="row">
	<div class="col-md-6">
		<?php if (!empty($noticia->imagem)): ?>
			<div class="form-group">
				<img src="<?= base_url(); ?>assets/uploads/noticias/<?= @$noticia->imagem; ?>" width="300px">
			</div>
		<?php endif ?>

		<div class="form-group">
			<label for="imagem">Thumb (499x499px): </label>
			<input name="imagem" id="imagem" type="file">
		</div>
	</div>

	<div class="col-md-6">
		<?php if (!empty($noticia->imagem2)): ?>
			<div class="form-group">
				<img src="<?= base_url(); ?>assets/uploads/noticias/<?= @$noticia->imagem2; ?>" width="300px">
			</div>
		<?php endif ?>

		<div class="form-group">
			<label for="imagem2">Imagem Principal (869x499px): </label>
			<input name="imagem2" id="imagem2" type="file">
		</div>
	</div>
</div>