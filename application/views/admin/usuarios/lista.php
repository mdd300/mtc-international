<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/inc/header') ?>
    <body>
        <div id="header">
            <?php $this->load->view('admin/inc/top') ?>
            <?php $this->load->view('admin/inc/menu') ?>
        </div>

        <div class="container">
            <h1>Usuários</h1>

            <?php $this->load->view('admin/inc/messages') ?>

            <h2 class="h4">Pesquisar</h2>
            <form name="busca" id="busca" action="admin/usuarios" method="post">
                <div class="row">
                    <div class="form-group col-md-5">
                        <label for="texto">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo @$nome ?>">
                        <span class="validate_error"></span>
                        <span class="validate_success"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-default" href="javascript: void(0);" onclick="$('#busca').submit();">
                            Buscar
                        </a>
                        <a class="btn btn-default" href="admin/usuarios/limpar">
                            Cancelar
                        </a>
                    </div>
                </div>
            </form>

            <hr>

            <div id="acoes" class="text-right">
                <a class="btn btn-danger" href="javascript: void(0);" onclick="excluirRegistros('usuarios', 'excluir_selecionados');">
                    Excluir
                </a>
                <a class="btn btn-default" href="admin/usuarios/cria">
                    Incluir
                </a>
            </div>
                
            <table class="table table-striped middle-vertical-align">
                <thead>
                    <tr class="text-center">
                        <td>
                            <input type="checkbox" name="selecionar_todos" onclick="selecionar_todos(this)" id="selecionar_todos" value="">
                        </td>
                        <td>Nome</td>
                        <td>Usuário</td>
                        <td>E-mail</td>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php if ($usuarios): ?>
                        <?php foreach ($usuarios as $key => $usuario): ?>
                            <tr>
                                <td class="selecao"><input type="checkbox" name="" id="" value="<?php echo $usuario->adm_usuarioID ?>"></td>
                                <td align="center"><?php echo $usuario->nome; ?></td>
                                <td align="center"><?php echo $usuario->usuario; ?></td>
                                <td align="center"><?php echo $usuario->email; ?></td>
                                <td><a href="admin/usuarios/editar/<?php echo $usuario->adm_usuarioID; ?>">Modificar</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td class="col-first" colspan="4">Nenhum usuário cadastrado no sistema.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            
            <?php if (isset($links)): ?>
                <div class="pagination">
                    <?php echo $links; ?>
                </div>
            <?php endif ?>
        </div>

        <?php $this->load->view('admin/inc/footer') ?>
    </body>
</html>