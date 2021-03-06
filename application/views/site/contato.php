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
                        <li class="active">Contato/Localização</li>
                    </ol>
                    <h2 class="title">Contato/Localização</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN-->
    <div id="main"><!-- CONTENT-->
        <div id="content">
            <div id="section-contact" class="section">
                <div class="container">
                    <div class="section-heading text-center">
                        <div class="title">Contato/Localização</div>
                        <div class="sub-title mbm contact-localization">
                            Se você tiver alguma dúvida ou solicitação, favor preencher o formulário abaixo e responderemos em breve, ou ligue para nós!
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="section-content">
                        <div class="row pb-70">
                            <div class="col-md-7 col-sm-7">
                                <?php $this->load->view('site/form-leads', array('origem' => 'Contato')); ?>                                                                                                                  
                            </div>
                            <div class="col-md-5 col-sm-5">
                                <div class="box mbn">
                                    <div class="box-body">
                                        <div class="contact-infos">
                                            <ul class="list-unstyled contact-info-list">
                                                <li>
                                                    <a href="https://maps.google.com/?q=Rua José Martins Fernandes, 601 CL Imigrantes">
                                                        <i class="fa fa-map-marker fa-fw"></i>
                                                        <div class="contact-info-box">
                                                            <p>
                                                                <strong>MTC International</strong>
                                                                <br>
                                                                Rua José Martins Fernandes, 601
                                                                <br>
                                                                CL Imigrantes – Galpão 15,16,17 e 18.
                                                                <br>
                                                                Bairro Batistini  São Bernardo do Campo
                                                                <br>
                                                                CEP:09843-400
                                                                <br>
                                                                
                                                            </p>
                                                            
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="tel:4810-1174<">
                                                        <i class="fa fa-phone fa-fw"></i>
                                                        <div class="contact-info-box">
                                                            <p><strong>Filial</strong><br/>55 11 4810.1174</p>    
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="mailto:comercial@mtclog.com.br">
                                                        <i class="fa fa-envelope fa-fw"></i>
                                                        <div class="contact-info-box">comercial@mtclog.com.br</div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyBiAcs87EcBa3laFx6_aoXJnJVTvJdv9cU"></script>
                <div style="overflow:hidden;height:505px;width:100%;">
                    <div id="gmap_canvas" style="height:505px;width:100%;"></div>
                    <style>
                    #gmap_canvas img {
                        max-width: none !important;
                        background: none !important
                    }</style>
                </div>
                <script type="text/javascript">
                    function init_map() {
                        var myOptions = {zoom: 12, scrollwheel: false, center: new google.maps.LatLng(-23.772443, -46.590876), mapTypeId: google.maps.MapTypeId.ROADMAP};
                        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                        marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(-23.772443, -46.590876)});
                        infowindow = new google.maps.InfoWindow({content: 
                            "<b>MTC Log</b><br>Rua José Martins Fernandes, 601<br>CL Imigrantes – Galpão 16,17 e 18.<br>Bairro Batistini São Bernardo do Campo"
                        });
                        google.maps.event.addListener(marker, "click", function () {
                            infowindow.open(map, marker);
                        });
                        infowindow.open(map, marker);
                    }
                    google.maps.event.addDomListener(window, 'load', init_map);
                </script>
            </div>
        </div>
    </div>
    <?php $this->load->view('site/inc/footer.php'); ?>
</div>
    <?php $this->load->view('site/inc/scripts.php'); ?>
</body>
</html>
