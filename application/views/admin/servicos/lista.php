<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/inc/header') ?>
    <body>
    <div id="header">
        <?php $this->load->view('admin/inc/top') ?>
        <?php $this->load->view('admin/inc/menu') ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Serviços</h1>

                <?php $this->load->view('admin/inc/messages') ?>

                <h2 class="h4">Pesquisar</h2>
                <form name="busca" id="busca" action="admin/servicos" method="post">
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="texto">Texto:</label>
                            <input type="text" class="form-control" name="texto" id="texto" value="<?php echo @$texto ?>">
                            <span class="validate_error"></span>
                            <span class="validate_success"></span>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-default" href="javascript: void(0);" onclick="$('#busca').submit();">
                                Buscar
                            </a>
                            <a class="btn btn-default" href="admin/servicos/limpar">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </form>

                <hr>

                <div id="acoes" class="text-right">
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('servicos', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/servicos/cria">                                    
                        Incluir
                    </a>
                </div>
                <!-- <legend>Resultado</legend> -->
                <table class="table table-striped middle-vertical-align">
                    <thead>
                        <tr class="text-center">
                            <td>
                                <input type="checkbox" name="selecionar_todos" onclick="selecionar_todos(this)" id="selecionar_todos" value="" />
                            </td>
                            <td>Foto</td>
                            <td>Título</td>
                            <td>Data de Publicação</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($servicos): ?>
                            <?php foreach ($servicos as $key => $servico): ?>
                                <tr>
                                    <td class="selecao text-center">
                                        <input type="checkbox" name="" id="" value="<?php echo $servico->id ?>" />
                                    </td>
                                    <td align="center" >
                                        <?php if ($servico->imagem): ?><img src="assets/uploads/servicos/<?php echo $servico->imagem; ?>" width="100px" /><?php endif; ?>
                                    </td>
                                    <td align="center" >
                                        <?php echo $servico->titulo; ?>
                                    </td>
                                    <td align="center" >
                                        <?php echo $servico->data_criacao; ?>
                                    </td>
                                    <td align="center">
                                        <a href="admin/servicos/editar/<?php echo $servico->id; ?>">Modificar</a>
                                    </td>
                                </tr>        
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td class="col-first" colspan="4">Nenhum item cadastrado no sistema.</td>
                            </tr>     
                        <?php endif ?>
                    </tbody>
                </table>

                <div id="acoes" class="text-right">
                    <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('servicos', 'excluir_selecionados');">
                        Excluir
                    </a>
                    <a class="btn btn-default" href="admin/servicos/cria">                                    
                        Incluir
                    </a>
                </div>

                <?PHP if (isset($links)): ?>
                    <!-- Page-ination -->
                    <div class="pagination">
                        <?php echo $links; ?>
                    </div>
                    <!-- End Page-ination -->
                <?PHP endif; ?>

            </div>
        </div>
    </div>

        <?php $this->load->view('admin/inc/footer') ?>
    </body>
</html>