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
                <h1>Banners</h1>

                <?php $this->load->view('admin/inc/messages') ?>
                <div id="acoes" class="text-right">
                    <form action="admin/banners/salvar_ordem" method="POST" class="pull-left">
                        <input type="hidden" value="" name="new_order_array" class="new_order_input">
                        <button class="btn btn-success reorder_button" disabled>
                            Salvar Ordem
                        </button>
                    </form>
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('banners', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/banners/cria">                                    
                        Incluir
                    </a>
                </div>

                <table class="table table-striped middle-vertical-align">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <td>
                                <input type="checkbox" name="selecionar_todos" onclick="selecionar_todos(this)" id="selecionar_todos" value="" />
                            </td>
                            <td>Foto</td>
                            <td>Nome</td>
                            <td>Ativo</td>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="sortable">
                        <?php if ($banners): ?>
                            <?php foreach ($banners as $key => $banner): ?>
                                <tr id="<?php echo $banner->id ?>">
                                    <td>
                                        <span class="ui-icon ui-icon-arrowthick-2-n-s"></span>  
                                    </td>
                                    <td class="selecao"><input type="checkbox" name="" id="" value="<?php echo $banner->id ?>" /></td>
                                    <td>
                                        <?php if ($banner->imagem): ?>
                                        <a href="<?php echo base_url() ?>admin/banners/editar/<?php echo $banner->id ?>">
                                            <img src="<?php echo base_url() . "assets/uploads/banners/" . $banner->imagem; ?>" width="200px" />
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center"><?php echo $banner->titulo; ?></td>
                                    <td align="center">
                                        <?php if ($banner->habilitado == 1): ?>
                                            Sim
                                        <?php else: ?>
                                            Não
                                        <?php endif ?>
                                    </td>
                                    <td align="center"><a href="admin/banners/editar/<?php echo $banner->id ?>">Modificar</a></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr class="odd">
                                <td class="col-first" colspan="4">Nenhum item cadastrado no sistema.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

                <div id="acoes" class="text-right">
                    <form action="admin/banners/salvar_ordem" method="POST" class="pull-left">
                        <input type="hidden" value="" name="new_order_array" class="new_order_input">
                        <button class="btn btn-success reorder_button" disabled>
                            Salvar Ordem
                        </button>
                    </form>
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('banners', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/banners/cria">                                    
                        Incluir
                    </a>
                </div>
            </div>
        </div>
        <!-- End of bgwrap -->

        <!-- Footer -->
        <?php $this->load->view('admin/inc/footer') ?>
        <!-- End of Footer -->
    </body>
</html>