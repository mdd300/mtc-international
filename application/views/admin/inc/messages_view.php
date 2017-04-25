            <?php $messages = $this->session->flashdata('messages'); ?>
            <?php if ($messages): ?>
                <div class="box" id="messages">
                    <h4 class="light-grey">Mensagem</h4>
                    <div class="box-container" align="center">
                        <span class="form-confirm-inline"><?php echo $messages; ?></span>
                    </div>
                    <!-- end of div.box-container -->
                </div>
                <!-- end of div.box -->
                <script type="text/javascript">
                    setTimeout(function(){ $("#messages").slideUp() }, 5000);
                </script>
            <?php endif; ?>

            <?php $errors = $this->session->flashdata('errors'); ?>
            <?php if ($errors): ?>
                <div class="box" id="errors">
                    <h4 class="light-grey">Erros</h4>
                    <div class="box-container" align="center">
                        <span class="form-error-inline"><?php echo $errors; ?></span>
                    </div>
                    <!-- end of div.box-container -->
                </div>
                <!-- end of div.box -->
                <script type="text/javascript">
                    setTimeout(function(){ $("#errors").slideUp() }, 10000);
                </script>
            <?php endif; ?> 
