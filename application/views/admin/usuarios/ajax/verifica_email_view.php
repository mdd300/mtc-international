<?php
if($resposta == 1)
{
?>
    <label class="field-title" for="usuario_email">
		E-mail <em>*</em>:
	</label>
    <input name="usuario_email" value="" id="usuario_email" class="txtbox-long" onblur="VerificaEmailUsuario(this.value)" />
	<span class="form-error-inline">E-mail já registrado no sistema!</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}elseif($resposta == 0){
?>
    <label class="field-title" for="usuario_email">
		E-mail <em>*</em>:
	</label>
    <input name="usuario_email" value="<?php echo $usuario_email?>" id="usuario_email" class="txtbox-long" onblur="VerificaEmailUsuario(this.value)" />
	<span class="form-confirm-inline">Este email está disponível!</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}else{
?>
    <label class="field-title" for="usuario_email">
		E-mail <em>*</em>:
	</label>
    <input name="usuario_email" value="" id="usuario_email" class="txtbox-long" onblur="VerificaEmailUsuario(this.value)" />
	<span class="form-error-inline">Informe um email válido!</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}
?>