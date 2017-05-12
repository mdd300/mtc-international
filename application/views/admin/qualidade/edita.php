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
            <h1>Qualidade</h1>
            <?php $this->load->view('admin/inc/messages') ?>

            <form method="post" action="admin/qualidade/atualizar" id="form_qualidade" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $qualidade_detalhes->id; ?>" />
                <div id="acoes" class="text-right">
                    <input class="btn btn-default" type="button" onclick="location.href = 'admin/qualidade'" value="Cancelar" />
                    <input class="btn btn-success" type="submit" value="Salvar" />
                </div>
                
                <?php include 'form.php' ?>

                <div id="acoes" class="text-right">
                    <input class="btn btn-default" type="button" onclick="location.href = 'admin/qualidade'" value="Cancelar" />
                    <input class="btn btn-success" type="submit" value="Salvar" />
                </div>
            </form>
        </div>
        <!-- End of Main Content -->
            
        <?php $this->load->view('admin/inc/footer') ?>
        <script>CKEDITOR.replace('texto')</script>
    </body>