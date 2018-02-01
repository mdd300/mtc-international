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
                        <li class="active"><a href="clientes">Clientes</a></li>
                    </ol>
                    <h2 class="title">Clientes</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN-->
    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-news-post-detail" class="section">
                <div class="container">
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="news-detail">
                                    <div class="box clearfix mbxxl">
                                        <?php foreach($clientes as $cliente): ?>
                                            <div class="col-md-3 col-sm-6 mbxxl text-center">
                                                <div class="client-box">
                                                    <?php if($cliente->link): ?>
                                                        <a href="<?php echo $cliente->link ?>" target="_blank">
                                                    <?php endif ?>
                                                        <img src="assets/uploads/clientes/<?php echo $cliente->imagem ?>" alt="<?php echo $cliente->titulo?>" class="img-responsive">
                                                    <?php if($cliente->link): ?>
                                                        </a>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                        
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
</body>
</html>
