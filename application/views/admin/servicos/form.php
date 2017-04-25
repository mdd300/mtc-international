<div class="form-group">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo @$servicos_detalhes->titulo; ?>" />
</div>

<div class="form-group">
    <label for="texto">Texto: </label>
    <textarea name="texto" id="texto" class="form-control"><?php echo @$servicos_detalhes->texto; ?></textarea>
</div>

<div class="form-group">
    <label for="description">Description: </label>
    <input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$servicos_detalhes->description ?>">
</div>