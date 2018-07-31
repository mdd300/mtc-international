<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('site/inc/head.php'); ?>

<body><!-- THEME SETTINGS--><!-- BACK TO TOP-->
<a id="totop" href="#"><i class="fa fa-angle-up"></i></a><!-- WRAPPER-->
<div id="wrapper"><!-- HEADER-->
    <?php $this->load->view('site/inc/header.php'); ?>

    <!-- HEADER BACKGROUND-->
    <div class="header-bg-wrapper">
        <div id="header-bg" <?= isset($topo) ? 'style="background-image: url(assets/uploads/topos/'.$topo.')"' : '' ?>>
            <div class="container">
                <div class="header-bg-content">
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li class="active">Notícias</li>
                    </ol>
                    <h2 class="title">Notícias</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN-->
    <!-- MAIN-->
    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-news" class="section">
                <div class="container">
                    <div class="section-content">
                        <div class="row pb-70">
                            <div class="col-md-9 col-sm-9">
                                <nav class="list-latest-news">
                                    <ul class="list-unstyled">
                                        <?php foreach ($noticias as $key => $noticia): ?>
                                            <li>
                                                <div class="box">
                                                    <div class="thumb">
                                                        <img src="assets/uploads/noticias/<?= $noticia->imagem2 ?>" alt="<?= $noticia->titulo ?>" class="img-responsive">
                                                        <div class="date"><strong><?= format_day_mysql($noticia->data_criacao) ?></strong> <?= format_month_mysql($noticia->data_criacao) ?></div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="title"><a href="noticias/<?= $noticia->slug ?>"><?= $noticia->titulo ?></a></div>
                                                        <div class="desc">
                                                            <p><?= $noticia->resumo ?></p>
                                                        <div class="more">
                                                            <div class="pull-right">
                                                                <span class="read-more"><a href="noticias/<?= $noticia->slug ?>" class="btn btn-outlined btn-primary">Saiba mais<i class="fa fa-plus"></i></a></span>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>

                                    <?php if (isset($links)): ?>
                                        <div class="text-center">
                                            <?= $links; ?>
                                        </div>
                                    <?php endif; ?>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('site/inc/footer.php'); ?>
</div>
    <?php $this->load->view('site/inc/scripts_not.php'); ?>
</body>
</html>