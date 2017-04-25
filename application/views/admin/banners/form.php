<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($banner)) { echo "checked"; } ?> <?php if (@$banner->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$banner->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>


<div class="form-group">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo @$banner->titulo; ?>" />
</div>

<div class="form-group">
    <label for="subtitulo">Subtitulo: </label>
    <input type="text" name="subtitulo" id="subtitulo" class="form-control" value="<?php echo @$banner->subtitulo; ?>" />
</div>

<div class="form-group">
    <label for="link">Link: </label>
    <input type="text" name="link" id="link" class="form-control" value="<?php echo @$banner->link; ?>" />
</div>

<div class="form-group">
    <label for="target_blank">Abrir link em nova aba?: </label>
    <select name="target_blank" id="target_blank" class="form-control">
        <?php if (@$banner->target_blank == 0): ?>
            <option value="0" selected="selected">Não</option>
            <option value="1">Sim</option>
        <?php else: ?>
            <option value="0">Não</option>
            <option value="1" selected="selected">Sim</option>
        <?php endif ?>
    </select>
</div>

<?php if (!empty($banner->imagem)): ?>
    <div class="form-group">
        <b>Imagem</b>
        <b class="help-block">Imagem atual:</b>
        <img src="<?php echo base_url(); ?>assets/uploads/banners/<?php echo @$banner->imagem; ?>" width="250px" />
        <span class="validate_error"></span>
        <span class="validate_success"></span>
    </div>
<?php endif ?>
<div class="form-group">
    <label for="imagem">Imagem (1920x1000px): </label>
    <input name="imagem" id="imagem" type="file" />
</div>