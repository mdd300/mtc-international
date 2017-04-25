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
                                        href="<?= $banner->link ?>"
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
            <div id="section-services" class="section">
                <div class="container text-center">
                    <div class="section-heading">
                        <div class="title">MTC Group</div>
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
                                                <div class="title">MTC Log</div>
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
                                                <div class="title">MTC Log</div>
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
            <div id="section-services" class="section">
                <div class="container text-center">
                    <div class="section-heading">
                        <div class="title">ÁREAS DE ATUAÇÃO</div>
                        <div class="line"></div>
                    </div>
                    <div class="section-content">
                        <div class="list-departments">
                            <div class="row">
                                <div class="container">
                                    <?php
                                        if($areas_de_atuacao){
                                            foreach ($areas_de_atuacao as $key => $area){ ?>
                                                <div class="col-md-4 col-sm-6 col-xs-6">
                                                    <a href="areas-de-atuacao/<?= $area->slug ?>" class="card hovercard alternative">
                                                        <div class="cardheader">
                                                            <img src="<?php echo base_url('assets/uploads/areas_de_atuacao/'.$area->imagem); ?>" alt="" class="img-responsive"/>
                                                        </div>
                                                        <div class="info">
                                                            <div class="title"><?= $area->titulo ?></div>
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
                        <a href="areas_de_atuacao" class="btn btn-outlined btn-primary areas-de-atuacao">Ver Todas as Áreas de Atuação</a>
                    </div>
                </div>
            </div>
        </div>
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
                    <div class="fb-page" data-href="https://www.facebook.com/lislightingyourideas" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-height="400px"><blockquote cite="https://www.facebook.com/lislightingyourideas" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/lislightingyourideas">MTC Log</a></blockquote></div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('site/inc/footer.php'); ?>
</div>
    <?php $this->load->view('site/inc/scripts.php'); ?>
</body>
</html>
