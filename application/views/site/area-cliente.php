<!DOCTYPE html>
<html>
    <head>
        <!-- Meta -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <base href="<?php echo base_url(); ?>" /> 
        <!-- End of Meta -->
        <!-- Page title -->
        <title>Área do Cliente - MTC Log</title>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="assets/admin/css/styles.css">

        <?php if (@$msg): ?>
            <script>
                abrir("<?php echo $msg ?>");
            </script>
        <?php endif ?>

    </head>
    <body class="area-cliente">
      <div class="wrapper">
        <form id="login-cliente" class="form-signin" action="<?php echo site_url('login-cliente'); ?>" method="POST">       
          <div class="text-center"><a href="<?= base_url() ?>"><img src="assets/images/logo.png" alt=""/></a></div>
          <h2 class="form-signin-heading text-center">Área do Cliente</h2>
          <p>Acesso restrito à clientes. Acesse e acompanhe o status do seu serviço.</p>
          <input type="text" class="form-control" name="usuario" placeholder="Usuário" required autofocus>
          <input type="password" class="form-control" name="senha" placeholder="Senha" required>      
          <div class="alert alert-danger text-center"  style="display: none" role="alert">
            Acesso Negado!
          </div>
          <button class="btn btn-lg btn-primary btn-block" disabled type="submit">Login</button>   
        </form>
      </div>       
      <script>
      $(document).ready(function() {
        $('#login-cliente button').prop({
          disabled: false
        })
        $('#login-cliente button').on('click', function(event) {
          event.preventDefault();
          $('#login-cliente .alert').show();
          setTimeout(function(){
              $('#login-cliente .alert').hide()
          }, 3000);
        });
      });
      </script>
    </body>
</html>