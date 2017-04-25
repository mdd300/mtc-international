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
                        <li><a href="areas-de-atuacao">Áreas de Atuação</a></li>
                        <li class="active"><?= $area_de_atuacao->titulo ?></li>
                    </ol>
                    <h2 class="title"><?= $area_de_atuacao->titulo ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN-->
    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-action-areas" class="section">
                <div class="container">
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-9 col-sm-9">
                                <div class="news-detail">
                                    <div class="box">
                                        <div class="title action-area"><a><?= $area_de_atuacao->titulo ?></a></div>
                                        <div class="thumb action-area">
                                            <img src="assets/uploads/areas_de_atuacao/<?= $area_de_atuacao->imagem2 ?>" alt="<?= $area_de_atuacao->titulo ?>" class="img-responsive"/>
                                        </div>
                                        <div class="content">
                                            <div class="desc">
                                                <?= $area_de_atuacao->descricao ?>
                                            </div>
                                        </div>
                                        <a href="areas-de-atuacao" class="btn btn-outlined btn-primary ">Ver Todas as Áreas de Atuação</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <div class="box">
                                    <?php if (!empty($areas_de_atuacao)): ?>
                                    <div class="box">
                                        <div class="box-heading">Áreas de Atuação</div>
                                        <div class="box-body">
                                            <nav class="list-most-commented">
                                                <?php foreach ($areas_de_atuacao as $key => $area_de_atuacao_aside): ?>
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="areas-de-atuacao/<?= $area_de_atuacao_aside->slug ?>">
                                                            <img width="80" src="<?php echo base_url('assets/uploads/areas_de_atuacao/'.$area_de_atuacao_aside->imagem); ?>" alt="<?= $area_de_atuacao->titulo ?>" alt="<?= $area_de_atuacao_aside->titulo ?>" class="media-object">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading"><a href="areas-de-atuacao/<?= $area_de_atuacao_aside->slug ?>" class="title"><?= $area_de_atuacao_aside->titulo ?></a></div>
                                                    </div>
                                                </div>
                                                <?php endforeach ?>
                                            </nav>
                                        </div>
                                    </div>
                                    <?php endif ?>
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
</body>
</html>