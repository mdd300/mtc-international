<!DOCTYPE html>
<html>
	<?php $this->load->view('admin/inc/header') ?>

	<body>
		<div id="header">
			<?php $this->load->view('admin/inc/top') ?>
			<?php $this->load->view('admin/inc/menu') ?>
		</div>
		
		<div class="container">
			<h1>Landing Pages</h1>
			<?php $this->load->view('admin/inc/messages') ?>

			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#lp" aria-controls="lp" role="tab" data-toggle="tab">Landing Page</a></li>
				<li role="presentation"><a id="links_tab" href="#lp_links" aria-controls="lp_links" role="tab" data-toggle="tab">Links</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="lp">
					<form method="post" action="admin/landing_pages/atualizar" id="form_novidades" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?= $landing_page->id ?>">
							
						<div id="acoes" class="text-right">
							<input class="btn btn-default" type="button" onclick="location.href = 'admin/landing_pages'" value="Cancelar">
							<input class="btn btn-success" type="submit" value="Salvar">
						</div>
						
						<?php include 'form.php'; ?>

						<div id="acoes" class="text-right">
							<input class="btn btn-default" type="button" onclick="location.href = 'admin/landing_pages'" value="Cancelar">
							<input class="btn btn-success" type="submit" value="Salvar">
						</div>
					   
						<!-- End of fieldset -->
					</form>
				</div>
				
				<div role="tabpanel" class="tab-pane" id="lp_links">
					<form method="post" action="admin/landing_pages/inserir_link" >
						<input type="hidden" name="landing_page_id" value="<?= $landing_page->id ?>">
							
						<div id="acoes" class="text-right">
							<input class="btn btn-default" type="button" onclick="location.href = 'admin/landing_pages'" value="Cancelar">
							<input class="btn btn-success" type="submit" value="Adicionar">
						</div>
						
						<?php include 'form-links.php'; ?>
					   
						<!-- End of fieldset -->
					</form>
				</div>
			</div>
		</div>
		
		<?php $this->load->view('admin/inc/footer') ?>
		
		<script>
			CKEDITOR.replace('descricao');
			
			<?php $links = $this->session->flashdata('links') ?>

			<?php if ($links == 'true'): ?>
				$('#links_tab').tab('show');
			<?php endif ?>
		</script>
	</body>
</html>