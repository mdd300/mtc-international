<div class="form-group">
    <label>Habilitado: </label>
    <div class="radio">
        <label for="habilitado">
            <input type="radio" name="habilitado" id="habilitado" value="1" <?php if (empty($topo)) { echo "checked"; } ?> <?php if (@$topo->habilitado == '1'): ?> checked <?php endif ?>>
            Sim
        </label>
    </div>
    <div class="radio">
        <label for="desabilitado">
            <input type="radio" name="habilitado" id="desabilitado" value="0" <?php if (@$topo->habilitado == '0'): ?> checked <?php endif ?>>
            Não
        </label>
    </div>
</div>


<?php if (!empty($topo->imagem)): ?>
    <div class="form-group">
        <b>Imagem</b>
        <b class="help-block">Imagem atual:</b>
        <img src="<?php echo base_url(); ?>assets/uploads/topos/<?php echo @$topo->imagem; ?>" width="250px" />
        <span class="validate_error"></span>
        <span class="validate_success"></span>
    </div>
<?php endif ?>
<div class="form-group">
    <label for="imagem">Imagem (1903x169px): </label>
    <input name="imagem" id="imagem" type="file" />
</div>