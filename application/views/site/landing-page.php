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
                        <li class="active"><?php echo $landing_page->titulo; ?></li>
                    </ol>
                    <h2 class="title"><?php echo $landing_page->titulo; ?></h2>
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
                                                <div class="content">
                                                    <div class="title"><a href="<?= $landing_page->slug ?>"><?= $landing_page->titulo ?></a></div>
                                                    <div class="desc">
                                                        <p><?php echo $landing_page->descricao; ?></p>
                                                    </div>
                                                    <div class="links-cloud">
                                                    <?php
                                                        foreach ($landing_pages as $key => $lp_links){ 
                                                    ?>
                                                            <a class="main-button button green" href="<?= $lp_links->slug ?>"><?= $lp_links->titulo ?></a>
                                                    <?php 
                                                        } 
                                                    ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="col-md-3">
                                <div class="box">
                                    <div class="row margin-bottom-md form-especialidades-listagem">                                 
                                        <?php $this->load->view('site/form-leads', array('origem' => 'Landing Page: ' . $landing_page->titulo)); ?>                                                                                                                  
                                    </div> 
                                    <div class="box-heading">Outros Links</div>
                                    <div class="box-body">
                                        <div class="box-body">
                                            <nav class="list-most-commented">

                                                <?php 
                                                    foreach ($landing_page_links as $key => $landing_page_link){
                                                ?>
                                                        <div class="media">
                                                            <div class="media-body">
                                                                <div class="media-heading">
                                                                    <a href="
                                                                        <?= $landing_page_link->link ?>"
                                                                        <?= $landing_page_link->target_blank == 1 ? 'target="_blank"' : '' ?>
                                                                       class="title">
                                                                       <?= $landing_page_link->titulo ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php  
                                                    }
                                                    foreach ($landing_pages as $key => $item_landing_page){
                                                        if($item_landing_page->menu_lateral == 1){
                                                ?>
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <div class="media-heading">
                                                                        <a href="<?= $item_landing_page->slug ?>" class="title"><?= $item_landing_page->titulo ?></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                <?php
                                                        }
                                                    }
                                                ?>
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
</body>
</html>
