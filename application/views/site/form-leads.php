<div class="box mbn">
    <div class="box-heading">Fale Conosco</div>
    <div class="box-body">
        <form action="<?php echo site_url('contato/send_contact'); ?>" id="contact-form" name="form_contato" class="form-contact">
            <input type="hidden" name="origem" value="<?php echo $origem; ?>"/>
            <div class="form-group"><label class="control-label mll">Nome <span class="required">*</span></label><input type="text" name="name" class="form-control" required="true"/></div>
            <div class="form-group"><label class="control-label mll">Email <span class="required">*</span></label><input type="text" name="email" class="form-control" required="true"/></div>
            <div class="form-group"><label class="control-label mll">Assunto <span class="required">*</span></label><input type="text" name="subject" class="form-control" required="true"/></div>
            <div class="form-group"><label class="control-label mll">Mensagem <span class="required">*</span></label><textarea rows="8" name="message" class="form-control" required="true"></textarea></div>
            <div class="form-group checkbox">
                <label for="opt_in">
                    <input type="checkbox" name="opt_in" id="opt_in" checked> Desejo receber os informativos da MTC Log
                </label>
            </div>
            <div class="form-group submit">
                <input type="submit" value="Enviar" class="btn btn-outlined btn-primary submit-contact-form"/>
            </div>
        </form>
    </div>
</div>
