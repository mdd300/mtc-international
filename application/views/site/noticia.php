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
                            <div class="col-md-9">
                                <nav class="list-latest-news">
                                    <ul class="list-unstyled">
                                        <li>
                                            <div class="box">
                                                <div class="thumb">
                                                    <img src="assets/uploads/noticias/<?= $noticia->imagem2 ?>" alt="<?= $noticia->titulo ?>" class="img-responsive">
                                                    <div class="date"><strong><?= format_day_mysql($noticia->data_criacao) ?></strong> <?= format_month_mysql($noticia->data_criacao) ?></div>
                                                </div>
                                                <div class="content">
                                                    <div class="title"><a href="noticias/<?= $noticia->slug ?>"><?= $noticia->titulo ?></a></div>
                                                    <div class="desc">
                                                        <p><?= $noticia->descricao ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="box-heading">Outras Notícias</div>
                                    <div class="box-body">
                                        <div class="box-body">
                                            <nav class="list-most-commented">
                                                <?php foreach ($mais_noticias as $key => $aside_noticia): ?>
                                                    <div class="media">
                                                        <div class="media-left">
                                                            <a href="#">
                                                                <img src="assets/uploads/noticias/<?= $aside_noticia->imagem2 ?>" alt="<?= $aside_noticia->titulo ?>" class="media-object" width="90">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <div class="media-heading">
                                                                <a href="noticias/<?= $aside_noticia->slug ?>" class="title"><?= $aside_noticia->titulo ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('site/inc/footer.php'); ?>
</div>
    <?php $this->load->view('site/inc/scripts.php'); ?>
<script>
    // Fill in your MailChimp popup settings below.
    // These can be found in the original popup script from MailChimp.
    var mailchimpConfig = {
        baseUrl: 'mc.us12.list-manage.com',
        uuid: '51b7183d29e9bafa8875af40b',
        lid: '862e5062ea'
    };

    // No edits below this line are required
    var chimpPopupLoader = document.createElement("script");
    chimpPopupLoader.src = '//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js';
    chimpPopupLoader.setAttribute('data-dojo-config', 'usePlainJson: true, isDebug: false');

    var chimpPopup = document.createElement("script");
    chimpPopup.appendChild(document.createTextNode('require(["mojo/signup-forms/Loader"], function (L) { L.start({"baseUrl": "' +  mailchimpConfig.baseUrl + '", "uuid": "' + mailchimpConfig.uuid + '", "lid": "' + mailchimpConfig.lid + '"})});'));

    jQuery(function ($) {
        document.body.appendChild(chimpPopupLoader);

        $(window).load(function () {
            document.body.appendChild(chimpPopup);
        });

    });
</script>
</body>
</html>