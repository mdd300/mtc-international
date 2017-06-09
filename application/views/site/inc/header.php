<header class="header-wrapper">
    <div class="top-header">
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
                        <!-- <a href="https://twitter.com/liscorp" target="_blank"><i class="fa fa-instagram"></i></a> -->
                        <a href="https://www.linkedin.com/company/grupomtc" target="_blank"><i class="fa fa-linkedin"></i></a>
                        <!-- <a href=""><i class="fa fa-youtube" target="_blank"></i></a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="logo"><a href="<?= base_url() ?>"><img src="assets/images/logo.png" alt="" class="img-responsive"/></a></div>
            <nav class="menu">
                <ul class="list-unstyled list-inline">
                    <!-- use active class on li to mark itens on menu as active -->
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="quem-somos">Sobre Nós</a></li>
                    <li>
                        <a
                            href="<?php echo site_url('o-que-fazemos'); ?>"
                            data-hover="dropdown"
                            class="data-toggle">
                                O que fazemos<span class="arrow fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <?php
                                if($servicos_menu){ 
                                    foreach ($servicos_menu as $key => $servico){ ?>
                                        <li><a href="o-que-fazemos/<?= $servico->slug ?>"><?= $servico->titulo ?></a></li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </li>
                    <li><a href="noticias">Notícias</a></li>
                    <li><a href="qualidade">Qualidade</a></li>
                    <li><a href="tecnologia">Tecnologia</a></li>
                    <li><a href="operacoes">Operações</a></li>
                    <li><a href="areas-de-atuacao">Áreas de Atuação</a></li>
                    <li><a href="carreira">Carreira</a></li>
                    <li><a href="sustentabilidade">Sustentabilidade</a></li>
                    <li><a href="contato">Contato</a></li>
                </ul>
            </nav>
            <div class="menu-responsive"><span class="fa fa-bars"></span></div>
            <div class="clearfix"></div>
        </div>
    </div>
</header>