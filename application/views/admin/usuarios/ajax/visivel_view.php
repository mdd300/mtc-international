<?if($usuario_visivel == 0)
{
?>
   <span id="ativo_<?php echo $usuario_id?>"><a href="javascript:;" onclick="ativa_item('<?php echo $usuario_id?>','1','usuario_id','usuario_visivel','usuarios');" title="Clique aqui para ativar o usuário."><img border="0" src="assets/images/admin/icones/lock.png"/></a></span>
<?
}else{
?>
    <span id="ativo_<?php echo $usuario_id?>"><a href="javascript:;" onclick="ativa_item('<?php echo $usuario_id?>','0','usuario_id','usuario_visivel','usuarios');" title="Clique aqui para desativar o usuário."><img border="0" src="assets/images/admin/icones/unlock.png"/></a></span>
<?
}
?>