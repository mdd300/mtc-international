<?php
$tipo = $this->session->userdata('tipo');
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
            <span class="sr-only">Navegação</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- <a class="navbar-brand" href="admin/home">MTC Log</a> -->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-nav">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Home <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="admin/banners">Banners (Home)</a></li>
                <li><a href="admin/clientes">Clientes</a></li>
              </ul>
            </li>
            <li><a href="admin/quem_somos">Quem Somos</a></li>
            <li><a href="admin/areas_de_atuacao">Atuação</a></li>
            <li><a href="admin/noticias">Notícias</a></li>
            <li><a href="admin/carreira">Carreira</a></li>
            <li><a href="admin/qualidade">Qualidade</a></li>
            <li><a href="admin/tecnologia">Tecnologia</a></li>
            <li><a href="admin/sustentabilidade">Sustentabilidade</a></li>
            <li><a href="admin/servicos">Serviços</a></li>
            <li><a href="admin/topos">Banners(topo)</a></li>
            <li><a href="admin/newsletters">Newsletters</a></li>
            <!-- <li><a href="admin/landing_pages">Landing Pages</a></li> -->
            <li><a href="admin/exportar">Exp. Contatos</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog"></span> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="admin/usuarios"><span class="glyphicon glyphicon-user"></span> Usuários</a></li>
                <li><a href="admin/home/sair"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
              </ul>
            </li>
          </ul>
          
        </div><!-- /.navbar-collapse -->
      </div>
    </div>
  </div><!-- /.container-fluid -->
</nav>