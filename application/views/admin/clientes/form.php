<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($cliente)) { echo "checked"; } ?> <?php if (@$cliente->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$cliente->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>


<div class="form-group">
    <label for="titulo">Título: </label>
    <input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo @$cliente->titulo; ?>" />
</div>

<div class="form-group">
    <label for="link">Link: </label>
    <input type="text" name="link" id="link" class="form-control" value="<?php echo @$cliente->link; ?>" />
</div>

<?php if (!empty($cliente->imagem)): ?>
    <div class="form-group">
        <b>Imagem</b>
        <b class="help-block">Imagem atual:</b>
        <img src="<?php echo base_url(); ?>assets/uploads/clientes/<?php echo @$cliente->imagem; ?>" width="250px" />
    </div>
<?php endif ?>
<div class="form-group">
    <label for="imagem">Imagem (270x170px): </label>
    <input name="imagem" id="imagem" type="file" />
</div>