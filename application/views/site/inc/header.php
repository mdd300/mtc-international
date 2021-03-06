<header class="header-wrapper">
    <!-- <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <address>
                        <ul>
                            <li>Rua Serra da Borborema 168, Jardim Maria Tereza – São Paulo / SP – CEP: 09930-580 </li>
                            <li>55 11 4092.7712 | 55 11 4092.7716</li>
                            <li>contato@grupomtc.com.br</li>
                        </ul>
                    </address>
                </div>
                <div class="col-md-2">
                    <div class="social">
                        <a href="https://www.facebook.com/Grupo-MTC-268424656942036/?hc_ref=SEARCH&fref=nf" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="https://www.linkedin.com/company/grupomtc" target="_blank"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div id="header">
        <div class="container">
            <div class="logo"><a href="<?= base_url() ?>"><img src="assets/images/logo.png" alt="MTC Tools" class="img-responsive"/></a></div>
            <nav class="menu">
                <ul class="list-unstyled list-inline">
                    <!-- use active class on li to mark itens on menu as active -->
                    <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i></a></li>
<!--                    <li class="dropdown">-->
<!--                        <a-->
<!--                            href="--><?php //echo site_url('quem-somos'); ?><!--"-->
<!--                            data-hover="dropdown"-->
<!--                            class="data-toggle">-->
<!--                                Sobre Nós<span class="arrow fa fa-angle-down"></span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a href="quem-somos">Quem somos</a></li>-->
<!--                            <li><a href="missao-visao">Missão e Valores</a></li>-->
<!--                            <li><a href="sustentabilidade">Sustentabilidade</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown">
                        <a
                            href="<?php echo site_url('servicos'); ?>"
                            data-hover="dropdown"
                            class="data-toggle">
                                Sobre nós<span class="arrow fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                if($servicos_menu){
                                    foreach ($servicos_menu as $key => $servico){ ?>
                                        <li><a href="servicos/<?= $servico->slug ?>"><?= $servico->titulo ?></a></li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </li>
<!--                    <li><a href="tecnologia">Tecnologia</a></li>-->
<!--                    <li><a href="operacoes">Operações</a></li>-->
<!--                    <!-- <li><a href="areas-de-atuacao">Áreas de Atuação</a></li> -->
<!--                    <li><a href="clientes">Clientes</a></li>-->
                    <li><a href="noticias">Notícias</a></li>
<!--                    <li class="hidden-sm">-->
<!--                        <a-->
<!--                            data-hover="dropdown"-->
<!--                            class="data-toggle">-->
<!--                            Informações<span class="arrow fa fa-angle-down"></span>-->
<!--                        </a>-->
<!--                        <ul class="dropdown-menu mega-menu">-->
<!--                            --><?php //foreach ($landing_pages_menu as $item): ?>
<!--                            <li><a href="--><?php // echo $item->slug ?><!--">--><?php //echo $item->titulo ?><!--</a></li>-->
<!--                            --><?php //endforeach; ?>
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown">
                        <a href="#" data-hover="dropdown" class="data-toggle">Contato<span class="arrow fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu multi-level">
                            <li><a href="contato">Contato/Localização</a></li>
                            <li><a href="trabalhe-conosco">Trabalhe Conosco</a></li>
                            <li><a href="area-cliente">Área do Cliente</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="social">
                <a href="https://www.facebook.com/Grupo-MTC-268424656942036/?hc_ref=SEARCH&fref=nf" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="https://www.linkedin.com/company/grupomtc" target="_blank"><i class="fa fa-linkedin"></i></a>
                <a href="https://www.instagram.com/mtcgrupo/" target="_blank"><i class="fa fa-instagram"></i></a>
            </div>
            <div class="menu-responsive"><span class="fa fa-bars"></span></div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>
