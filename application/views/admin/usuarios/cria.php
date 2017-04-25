<!DOCTYPE html>
<html>
    <?php $this->load->view('admin/inc/header') ?>
    <body>
        
        <div id="header">
            <?php $this->load->view('admin/inc/top') ?>
            <?php $this->load->view('admin/inc/menu') ?>
        </div>

        <div class="container">
            <h1>Novo Usuário</h1>
            <form method="post" action="admin/usuarios/salvar" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>Data de Criação: </label>
                    <p class="help-block"><?= gmdate ("d/m/Y h:ia") ?></p>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo: </label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="1">Administrador</option>
                        <option value="2">Atendente</option>
                    </select>
                    <span class="validate_error"></span>
                    <span class="validate_success"></span>
                </div>

                <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input name="nome" id="nome" type="text" class="form-control">
                    <span class="validate_error"></span>
                    <span class="validate_success"></span>
                </div>

                <div class="form-group">
                    <label for="email">E-mail: </label>
                    <input name="email" id="email" type="email" class="form-control">
                    <span class="validate_error"></span>
                    <span class="validate_success"></span>
                </div>

                <div class="form-group">
                    <label for="usuario">Usuário: </label>
                    <input name="usuario" id="usuario" type="text" class="form-control">
                    <span class="validate_error"></span>
                    <span class="validate_success"></span>
                </div>

                <div class="form-group">
                    <label for="senha">Senha: </label>
                    <input name="senha" id="senha" type="password" class="form-control">
                    <span class="validate_error"></span>
                    <span class="validate_success"></span>
                </div>

                <div id="acoes" class="text-right">
                    <input class="btn btn-default" type="button" onclick="location.href = 'admin/usuarios'" value="Cancelar" />
                    <input class="btn btn-success" type="submit" value="Salvar" />
                </div>
            </form>
        </div>
            
        <?php $this->load->view('admin/inc/footer') ?>
    </body>
</html>