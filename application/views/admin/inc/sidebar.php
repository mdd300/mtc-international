<?
$info = $this->home_model->get_dados_secao($this->session->userdata('session_id'));
$user = $this->home_model->get_dados_user($this->session->userdata('usuario_id'));

//FORMATA A DATA PARA PEGAR O DIA DA SEMANA
if($user->ultimo_acesso != ''){
    $vet_data = explode(' ',$user->ultimo_acesso);
    
    $vet_hora = explode(':',$vet_data[1]);
            
    $dia_semana = $this->home_model->diasemana($vet_data[0]);
    
    $vet_data = explode('-',$vet_data[0]);
    
    $mes = '';

    switch ($vet_data[1]) {
            case "01":    $mes = 'Janeiro';     break;
            case "02":    $mes = 'Fevereiro';   break;
            case "03":    $mes = 'Março';       break;
            case "04":    $mes = 'Abril';       break;
            case "05":    $mes = 'Maio';        break;
            case "06":    $mes = 'Junho';       break;
            case "07":    $mes = 'Julho';       break;
            case "08":    $mes = 'Agosto';      break;
            case "09":    $mes = 'Setembro';    break;
            case "10":    $mes = 'Outubro';     break;
            case "11":    $mes = 'Novembro';    break;
            case "12":    $mes = 'Dezembro';    break; 
     }     
    
     $dia    = $vet_data[2];
     $ano    = $vet_data[0];
     $hora   = $vet_hora[0];
     $minuto = $vet_hora[1];
} 

?>

<div id="sidebar">
	<!-- Statistics -->
	<h2>Seu último acesso foi:</h2>
    <? if($user->ultimo_acesso != ''){ ?>
	<p><b>Hora:</b> <?php echo $hora?>:<?php echo $minuto?></p>
	<p><b>Dia:</b> <?php echo $dia?></p>
    <p><b>Mês:</b> <?php echo $mes?></p>
	<p><b>Ano:</b> <?php echo $ano?></p>
    <p><b>Dia da Semana:</b> <?php echo $dia_semana?></p>
    <? } else { ?>
    <p><b>Este é seu primeiro acesso!</b></p>
    <? } ?>
	<!-- End of Statistics -->
    <!-- Seu site -->
	<h2>Veja seu Site</h2>
	<p><b><a href="site" target="_blank">Acessar</a></b></p>
	<!-- End of seu site -->
    <!-- Infos -->
	<h2>Informações Gerais</h2>
	<p><b>Número de Acessos:</b> <?php echo $user->num_acessos?></p>
    <p><b>Seu Endereço IP:</b> <?php echo $info->session_ip_address?></p>
    <p><b>Seu Navegador:</b> <?php echo $info->session_user_agent?></p>
	<!-- End of infos -->
</div>