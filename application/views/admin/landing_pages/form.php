<div class="form-group">
	<label>Data de Criação: </label>
	<br>
	<p class="help-block"><?= gmdate ("d/m/Y h:ia",strtotime(@$landing_page->data_criacao)) ?></p>
</div>

<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($landing_page)) { echo "checked"; } ?> <?php if (@$landing_page->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$landing_page->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>

<div class="form-group">
    <label>Mostrar no menu lateral: </label>
    <div class="radio">
        <label for="mostrar">
            <input type="radio" name="menu_lateral" id="mostrar" value="1" <?php if (empty($landing_page)) { echo "checked"; } ?> <?php if (@$landing_page->menu_lateral == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="esconder">
            <input type="radio" name="menu_lateral" id="esconder" value="0" <?php if (@$landing_page->menu_lateral == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>

<div class="form-group">
    <label for="title">Title (meta): </label>
    <input name="title" id="title" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$landing_page->title ?>">
</div>

<div class="form-group">
	<label for="description">Description (meta): </label>
	<input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$landing_page->description ?>">
</div>

<div class="form-group">
	<label for="keywords">Keywords: </label>
	<input name="keywords" id="keywords" type="text" class="form-control" placeholder="Máximo de 100 caracteres, lembre que todas as keywors inseridas aqui devem estar no conteúdo da landing page" maxlength="100" value="<?= @$landing_page->keywords ?>">
</div>

<div class="form-group">
	<label for="titulo">Titulo: </label>
	<input name="titulo" id="titulo" type="text" class="form-control" value="<?= @$landing_page->titulo ?>">
</div>

<div class="form-group">
	<label for="descricao">Descrição: </label>
	<textarea id="descricao" name="descricao"><?= @$landing_page->descricao ?></textarea>
</div>

<?php if (!empty($landing_page->imagem)): ?>
	<div class="form-group">
		<img src="<?= base_url(); ?>assets/uploads/landing_pages/<?= @$landing_page->imagem; ?>" width="300px">
	</div>
<?php endif ?>

<div class="form-group">
	<label for="imagem">Imagem para redes sociais (1200 x 630 | 1.91:1): </label>
	<input name="imagem" id="imagem" type="file">
</div>