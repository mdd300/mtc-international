<?php $messages = $this->session->flashdata('messages'); ?>
<?php $errors = $this->session->flashdata('errors'); ?>
<?php $avisos = $this->session->flashdata('avisos'); ?>
<?php if ($messages || $errors || $avisos): ?>
<div id="box_msg">
    <?php if($messages){ ?>
	<div id="messages" class="alert alert-success alert-dismissible fade in">
		<span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span> <?php echo $messages ?>
	</div>
    <?php } ?>
    <?php if($avisos){ ?>
	<div id="avisos" class="message warning close">
		<?php echo $avisos ?>
	</div>
    <?php } ?>
    <?php if($errors){ ?>
	<div class="message error close">
		<?php echo $errors ?>
	</div>
    <?php } ?>
</div>
<script type="text/javascript">
    setTimeout(function(){ $("#box_msg").slideUp() }, 5000);
</script>
<?php endif ?>
<hr />