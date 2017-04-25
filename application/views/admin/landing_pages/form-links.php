<div class="form-group">
	<label for="link">Link: </label>
	<input name="link" id="link" type="text" class="form-control" placeholder="Se o link for externo, não esqueça de começar com http:// ou https://" maxlength="70" value="<?= @$landing_page->link ?>">

</div>

<div class="form-group">
	<label for="titulo">Título: </label>
	<input name="titulo" id="titulo" type="text" class="form-control" placeholder="Título do link" maxlength="70" value="">
</div>

<div class="form-group">
	<label for="target_blank">Abrir em uma nova aba? </label>
	<select class="form-control" name="target_blank" id="target_blank">
		<option value="0">Não</option>
		<option value="1">Sim</option>
	</select>
</div>

<h3>Links Ativos</h3>

<table class="table table-striped middle-vertical-align">
    <thead>
        <tr class="text-center">
            <td>Título</td>
            <td>Link</td>
            <td>Ação</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($landing_page_links): ?>
            <?php foreach ($landing_page_links as $key => $landing_page_link): ?>
                <tr>
                    <td align="center" >
                        <?= $landing_page_link->titulo; ?>
                    </td>
                    <td align="center" >
                        <?= $landing_page_link->link; ?>
                    </td>
                    <td align="center" >
                        <a href="admin/landing_pages/excluir_link/<?= $landing_page_link->id; ?>">Excluir</a>
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