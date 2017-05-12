<?PHP $tipo = $this->session->userdata('tipo'); ?>

<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/inc/header'); ?>
    <body>
        <div id="header">
            <?php $this->load->view('admin/inc/top') ?>
            <?php $this->load->view('admin/inc/menu') ?>                
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Bem-vindo<?php echo ($this->session->userdata('nome')) ? ", ".$this->session->userdata('nome') : ''; ?></h1>
                    <p>Escolha uma opção:</p>
                    
                    <?php $this->load->view('admin/inc/messages'); ?>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/banners">
                                    <span class="font-lg glyphicon glyphicon-star"></span>
                                    <div class="caption">Banners
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/quem_somos">
                                    <span class="font-lg glyphicon glyphicon-home"></span>
                                    <div class="caption">Quem Somos
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/sustentabilidade">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Sustentabilidade
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/servicos">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Serviços
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/areas_de_atuacao">
                                    <span class="font-lg glyphicon glyphicon-tags"></span>
                                    <div class="caption">Atuação
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/noticias">
                                    <span class="font-lg glyphicon glyphicon-list-alt"></span>
                                    <div class="caption">Notícias
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/clientes">
                                    <span class="font-lg glyphicon glyphicon-user"></span>
                                    <div class="caption">Clientes
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/carreira">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Carreira
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/tecnologia">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Tecnologia
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/qualidade">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Qualidade
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/operacoes">
                                    <span class="font-lg glyphicon glyphicon-heart"></span>
                                    <div class="caption">Operações
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/topos">
                                    <span class="font-lg glyphicon glyphicon glyphicon-list-alt"></span>
                                    <div class="caption">Banners do Topo
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/newsletters">
                                    <span class="font-lg glyphicon glyphicon-envelope"></span>
                                    <div class="caption">Newsletters
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!-- <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/landing_pages">
                                    <span class="font-lg glyphicon glyphicon-fire"></span>
                                    <div class="caption">Landing Pages
                                    </div>
                                </a>
                            </div>
                        </div> -->
                        <div class="col-md-2">
                            <div class="thumbnail text-center">
                                <a href="admin/exportar">
                                    <span class="font-lg glyphicon glyphicon-floppy-save"></span>
                                    <div class="caption">Exportar Contatos
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('admin/inc/footer') ?>
    </body>
</html>


