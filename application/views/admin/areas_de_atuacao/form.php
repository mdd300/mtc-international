<div class="form-group">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo @$areas_de_atuacao_detalhes->titulo; ?>" />
</div>

<div class="form-group">
    <label for="texto">Texto: </label>
    <textarea name="texto" id="texto" class="form-control"><?php echo @$areas_de_atuacao_detalhes->texto; ?></textarea>
</div>

<div class="form-group">
    <label for="description">Description (meta): </label>
    <input name="description" id="description" type="text" class="form-control" placeholder="Entre 150 e 160 caracteres" maxlength="160" value="<?= @$areas_de_atuacao_detalhes->description ?>">
</div>