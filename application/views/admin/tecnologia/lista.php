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
            <div id="main">
                <h1>Tecnologia</h1>

                <?php $this->load->view('admin/inc/messages') ?>
                <table class="table table-striped middle-vertical-align">
                    <thead>
                        <tr class="text-center">
                            <td>Nome</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php if ($tecnologia): ?>
                            <?php foreach ($tecnologia as $key => $tecnologia_detalhes): ?>
                                <tr class="odd">
                                    <td align="center"><?php echo $tecnologia_detalhes->titulo; ?></td>
                                    <td align="center"><a href="admin/tecnologia/editar/<?php echo $tecnologia_detalhes->id ?>">Modificar</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="odd">
                                <td class="col-first" colspan="4">Nenhum item cadastrado no sistema.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- End of bgwrap -->

        <!-- Footer -->
        <?php $this->load->view('admin/inc/footer') ?>
        <!-- End of Footer -->
    </body>
</html>