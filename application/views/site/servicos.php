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
                        <li><a href="#">Home</a></li>
                        <li class="active">O que fazemos</li>
                    </ol>
                    <h2 class="title">O que fazemos</h2>
                </div>
            </div>
        </div>
    </div>

    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-services" class="section lista-servicos">
                <div class="container">
                    <div class="section-content">
                        <div class="col-md-9 row pb-92">
                            <?php foreach ($servicos as $key => $servico): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card hovercard">
                                        <div class="overlay"></div>
                                        <div class="cardheader"><img src="<?php echo base_url('assets/uploads/servicos/'.$servico->imagem); ?>" alt="" class="img-responsive"/></div>
                                        <div class="info">
                                            <div class="title"><a href="o-que-fazemos/<?= $servico->slug ?>"><?= $servico->titulo ?></a></div>
                                            <div class="desc"><?= $servico->resumo ?></div>
                                            <div class="read-more"><a href="o-que-fazemos/<?= $servico->slug ?>" class="btn btn-outlined">Saiba mais<i class="fa fa-plus mls"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>                        
                        <div class="col-md-3 row pb-92 form-especialidades-listagem">
                            <?php $this->load->view('site/form-leads', array('origem' => 'O que fazemos')); ?>
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