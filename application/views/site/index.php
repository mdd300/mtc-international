<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('site/inc/head.php'); ?>

<body><!-- THEME SETTINGS--><!-- BACK TO TOP-->
<a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!-- WRAPPER-->
<div id="wrapper"><!-- HEADER-->
    <?php $this->load->view('site/inc/header.php'); ?>

    <!-- SLIDER-->
    <div class="slider-wrapper">
        <div id="slider">
            <div id="banner-sliders" data-ride="carousel" class="carousel slide">
                <div class="carousel-inner">
                    <?php foreach ($banners as $key => $banner): ?>
                        <div class="item <?= $key == 0 ? 'active' : '' ?>">
                            <img src="assets/uploads/banners/<?= $banner->imagem ?>" alt="<?= $banner->titulo ?>"/>

                            <div class="carousel-caption">
                                <div class="heading animated fadeIn delay-2"><?= $banner->titulo ?></div>
                                <div class="sub-heading animated fadeIn delay-3"><?= $banner->subtitulo ?></div>
                                <?php if (!empty($banner->link)): ?>
                                    <a
                                        href="<?php echo (strstr($banner->link,'http')) ? $banner->link : site_url($banner->link); ?>"
                                        <?= $banner->target_blank == 1 ? 'target="_blank"' : '' ?>
                                        class="btn btn-more animated fadeIn delay-4 btn-18"
                                        >
                                        Saiba mais
                                        <i class="fa fa-plus"></i>
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <a href="#banner-sliders" data-slide="prev" class="left carousel-control"><span class="fa fa-arrow-left"></span></a><a href="#banner-sliders" data-slide="next" class="right carousel-control"><span class="fa fa-arrow-right"></span></a></div>
        </div>
    </div>
    <!-- MAIN-->
    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-services" class="section empresas-mtc">
                <div class="container text-center">
                    <div class="section-heading">
                        <div class="title">Empresas do Grupo MTC</div>
                        <div class="line"></div>
                    </div>
                    <div class="section-content">
                        <div class="list-departments">
                            <div class="row">
                                <div class="container">
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="" class="card hovercard alternative">
                                            <div class="cardheader">
                                                <img src="assets/images/groups_mtc/soft.png" alt="MTC Log" class="img-responsive"/>
                                            </div>
                                            <div class="info">
                                                <div class="title">MTC Soft</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="" class="card hovercard alternative">
                                            <div class="cardheader">
                                                <img src="assets/images/groups_mtc/log.png" alt="" class="img-responsive"/>
                                            </div>
                                            <div class="info">
                                                <div class="title">MTC Log</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="" class="card hovercard alternative">
                                            <div class="cardheader">
                                                <img src="assets/images/groups_mtc/tools.png" alt="" class="img-responsive"/>
                                            </div>
                                            <div class="info">
                                                <div class="title">MTC Tools</div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <a href="" class="card hovercard alternative">
                                            <div class="cardheader">
                                                <img src="assets/images/groups_mtc/trat.png" alt="" class="img-responsive"/>
                                            </div>
                                            <div class="info">
                                                <div class="title">MTC Trat</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section-services" class="section servicos-home">
                <div class="container text-center">
                    <div class="section-heading">
                        <div class="title">Serviços</div>
                        <div class="line"></div>
                    </div>
                    <div class="section-content">
                        <div class="list-departments">
                            <div class="row">
                                <div class="container">
                                    <?php
                                        if($servicos){
                                            foreach ($servicos as $key => $servico){ ?>
                                                <div class="col-md-4 col-sm-6 col-xs-6">
                                                    <a href="servicos/<?= $servico->slug ?>" class="card hovercard alternative">
                                                        <div class="cardheader">
                                                            <img src="<?php echo base_url('assets/uploads/servicos/'.$servico->imagem); ?>" alt="" class="img-responsive"/>
                                                        </div>
                                                        <div class="info">
                                                            <div class="title"><?= $servico->titulo ?></div>
                                                        </div>
                                                    </a>
                                                </div>
                                    <?php 
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-heading">
                        <a href="servicos" class="btn btn-outlined btn-primary areas-de-atuacao">Ver Todos os Serviços</a>
                    </div>
                </div>
            </div>
            <div id="section-latest-news" class="section news-home">
                <div class="container text-center">
                    <div class="section-heading">
                        <div class="title">Notícias</div>
                        <div class="line"></div>
                    </div>
                    <div class="section-content">
                        <div class="row">
                            <?php foreach ($noticias as $key => $noticia): ?>
                                <div class="col-md-6">
                                    <div class="box">
                                        <div class="thumb">
                                            <img src="assets/uploads/noticias/<?= $noticia->imagem ?>" alt="<?= $noticia->titulo ?>" class="img-responsive"/>
                                            <div class="ribbon">
                                                <span><?= format_day_mysql($noticia->data_criacao) ?></span>
                                                <span><?= format_month_mysql($noticia->data_criacao) ?></span>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <div class="title"><a href="noticias/<?= $noticia->slug ?>"><?= $noticia->titulo ?></a></div>
                                            <div class="desc"><?= $noticia->resumo ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="section-meet-our-doctor" class="section">
        <div class="container">
            <div class="section-heading text-center">
                <div class="title">Clientes</div>
                <div class="line"></div>
            </div>
            <div class="section-content">
                <div id="marcas-carousel" data-ride="carousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php foreach ($clientes as $key => $cliente_group): ?>
                            <div class="item <?= $key == 0 ? 'active' : '' ?>">
                                 <div class="row man">
                                    <?php foreach ($cliente_group as $key => $cliente): ?>
                                         <div class="col-md-3 col-sm-3 col-xs-6">
                                            <div class="thumb">
                                                <?php if ($cliente->link): ?>
                                                    <a href="<?= $cliente->link ?>" target="_blank">
                                                <?php endif ?>
                                                    <img src="assets/uploads/clientes/<?= $cliente->imagem ?>" alt="<?= $cliente->titulo ?>" class="img-responsive"/>
                                                <?php if ($cliente->link): ?>
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                 </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <a href="#marcas-carousel" data-slide="prev" class="left carousel-control"><span class="fa fa-arrow-left"></span></a><a href="#marcas-carousel" data-slide="next" class="right carousel-control"><span class="fa fa-arrow-right"></span></a>
    </div>

    <section class="facebook-area">
        <div class="container">
            <div class="row">                
                <div class="col-md-4 col-md-offset-7">
                    <h3>
                        <small>CURTA NOSSA</small>
                        <br>
                        FAN PAGE
                    </h3>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-page" data-href="https://www.facebook.com/Grupo-MTC-268424656942036/?hc_ref=SEARCH&fref=nf" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-height="400px"><blockquote cite="https://www.facebook.com/Grupo-MTC-268424656942036/?hc_ref=SEARCH&fref=nf" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Grupo-MTC-268424656942036/?hc_ref=SEARCH&fref=nf">MTC Log</a></blockquote></div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('site/inc/footer.php'); ?>
</div>
    <?php $this->load->view('site/inc/scripts.php'); ?>
</body>
</html>
