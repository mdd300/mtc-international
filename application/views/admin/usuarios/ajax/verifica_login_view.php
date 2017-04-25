<?php 
if($resposta == 1)
{
?>
    <label class="field-title" for="usuario_login">
		Login <em>*</em>:
	</label>
    <input name="usuario_login" id="usuario_login" class="txtbox-long" onblur="VerificaLoginUsuario(this.value)" />
	<span class="form-error-inline">Já existe um usuário com este login.</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}elseif($resposta == 0){
?>
    <label class="field-title" for="usuario_login">
		Login <em>*</em>:
	</label>
    <input value="<?php echo $usuario_login?>" name="usuario_login" id="usuario_login" class="txtbox-long" onblur="VerificaLoginUsuario(this.value)" />
	<span class="form-confirm-inline">Este login está disponível!</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}else{
?>
    <label class="field-title" for="usuario_login">
		Login <em>*</em>:
	</label>
    <input name="usuario_login" id="usuario_login" class="txtbox-long" onblur="VerificaLoginUsuario(this.value)" />
	<span class="form-error-inline">Informe um login para validar seu cadastro!</span>
	<span class="clearFix">&nbsp;</span>
<?PHP
}
?>