<div class="form-group">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo @$tecnologia_detalhes->titulo; ?>" />
</div>

<div class="form-group">
    <label for="texto">Texto: </label>
    <textarea name="texto" id="texto" class="form-control"><?php echo @$tecnologia_detalhes->texto; ?></textarea>
</div>

<div class="form-group">
    <label for="title">Title (meta): </label>
    <input name="title" id="title" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$tecnologia_detalhes->title ?>">
</div>

<div class="form-group">
    <label for="description">Description (meta): </label>
    <input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$tecnologia_detalhes->description ?>">
</div>