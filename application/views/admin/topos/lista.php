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
                <h1>topos</h1>

                <?php $this->load->view('admin/inc/messages') ?>
                

                <table class="table table-striped middle-vertical-align">
                    <thead>
                        <tr class="text-center">
                            <td>Foto</td>
                            <td>Página</td>
                            <td>Habilitado</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php if ($topos): ?>
                            <?php foreach ($topos as $key => $topo): ?>
                                <tr class="odd">
                                    <td>
                                        <?php if ($topo->imagem): ?>
                                        <a href="<?php echo base_url() ?>admin/topos/editar/<?php echo $topo->id ?>">
                                            <img src="<?php echo base_url() . "assets/uploads/topos/" . $topo->imagem; ?>" width="200px" />
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center"><?php echo $topo->pagina; ?></td>
                                    <td align="center">
                                        <?php if ($topo->habilitado == 1): ?>
                                            Sim
                                        <?php else: ?>
                                            Não
                                        <?php endif ?>
                                    </td>
                                    <td align="center"><a href="admin/topos/editar/<?php echo $topo->id ?>">Modificar</a></td>
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