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
                <h1>Clientes</h1>

                <?php $this->load->view('admin/inc/messages') ?>
                <div id="acoes" class="text-right">
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('clientes', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/clientes/cria">                                    
                        Incluir
                    </a>
                </div>

                <table class="table table-striped middle-vertical-align">
                    <thead>
                        <tr class="text-center">
                            <td>
                                <input type="checkbox" name="selecionar_todos" onclick="selecionar_todos(this)" id="selecionar_todos" value="" />
                            </td>
                            <td>Foto</td>
                            <td>Subir</td>
                            <td>Descer</td>
                            <td>Nome</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php if ($clientes): ?>
                            <?php foreach ($clientes as $key => $cliente): ?>
                                <tr class="odd">

                                    <td class="selecao"><input type="checkbox" name="" id="" value="<?php echo $cliente->clienteID ?>" /></td>
                                    <td>
                                        <?php if ($cliente->imagem): ?>
                                        <a href="<?php echo base_url() ?>admin/clientes/editar/<?php echo $cliente->clienteID ?>">
                                            <img src="<?php echo base_url() . "assets/uploads/clientes/" . $cliente->imagem; ?>" width="200px" />
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td><a href="admin/clientes/subir/<?php echo $cliente->clienteID ?>/<?php echo $cliente->sort; ?>">Subir</a></td>
                                    <td><a href="admin/clientes/descer/<?php echo $cliente->clienteID ?>/<?php echo $cliente->sort; ?>">Descer</a></td>
                                    <td align="center"><?php echo $cliente->titulo; ?></td>
                                    <td align="center">
                                        <?php if ($cliente->habilitado == 1): ?>
                                            Sim
                                        <?php else: ?>
                                            Não
                                        <?php endif ?>
                                    </td>
                                    <td align="center"><a href="admin/clientes/editar/<?php echo $cliente->clienteID ?>">Modificar</a></td>
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
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('clientes', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/clientes/cria">                                    
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