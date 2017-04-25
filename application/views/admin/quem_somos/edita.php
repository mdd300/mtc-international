<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/inc/header') ?>
    <body>
        <div id="header">
            <!-- Top -->
            <?php $this->load->view('admin/inc/top') ?>
            <!-- End of Top-->

            <!-- The navigation bar -->
            <?php $this->load->view('admin/inc/menu') ?>
            <!-- End of navigation bar" -->
        </div>
        
        <!-- Main Content -->
        <div class="container">
            <h1>Quem Somos</h1>
            <?php $this->load->view('admin/inc/messages') ?>

            <form method="post" action="admin/quem_somos/atualizar" id="form_quem_somos" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $quem_somos_detalhes->id; ?>" />
                <div id="acoes" class="text-right">
                    <input class="btn btn-default" type="button" onclick="location.href = 'admin/quem_somos'" value="Cancelar" />
                    <input class="btn btn-success" type="submit" value="Salvar" />
                </div>
                
                <?php include 'form.php' ?>

                <div id="acoes" class="text-right">
                    <input class="btn btn-default" type="button" onclick="location.href = 'admin/quem_somos'" value="Cancelar" />
                    <input class="btn btn-success" type="submit" value="Salvar" />
                </div>
            </form>
        </div>
        <!-- End of Main Content -->
            
        <?php $this->load->view('admin/inc/footer') ?>
        <script>CKEDITOR.replace('texto')</script>
    </body>