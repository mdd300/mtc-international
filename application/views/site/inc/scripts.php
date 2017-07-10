<script src="assets/js/jquery-1.11.2.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="assets/js/html5shiv.js"></script>
<script src="assets/js/respond.min.js"></script>
<script src="assets/js/layout.js"></script>

<?php if ($active == 'home'): ?>
	<script src="assets/plugins/jquery.dotdotdot.min.js"></script>
    <!--LOADING SCRIPTS FOR PAGE-->
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/js/pages/index.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.destaque-resumo').each(function(){
				$(this).dotdotdot({
					ellipsis	: '... ',
					wrap		: 'word',
					height		: 80,
				});
			});
			$( ".carousel-highlights .item.active" ).each(function( index ) {
			    if(index != 0){
			        $(this).removeClass('active');
			    }
			});
		});
	</script>
<?php endif ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropdown a').unbind();


        $('.submit-contact-form').click(function(event){
            event.preventDefault();

            var button = $(this);

            $.ajax({
                url: button.closest('form').attr('action'),
                type: 'POST',
                data: button.closest('form').serialize(),
                dataType: 'JSON',
                beforeSend: function(){
                    button.val('Enviando...');
			    },
                success: function(response){
                	if(!response.status){
	                    if(button.closest('form').attr('id') == 'form-newsletter'){
		                    button.attr('disabled', 'disabled');
                			$('#message_newsletter').text(response.message);
							setTimeout(function(){
			                    button.val('Enviar').removeAttr('disabled');
	                			$('#message_newsletter').text('');
							}, 2000);
                		}else{
		                    button.val(response.message).css({'color' : '#fff', 'background-color' : '#F85B5B', 'border-color' :'#F85B5B'}).attr('disabled', 'disabled');

							setTimeout(function(){
		                		if(button.closest('form').attr('id') == 'form-consulta'){
				                    button.val('Enviar').css({'color' : '#000', 'background-color' : '#ffffff', 'border-color' :'#000'}).removeAttr('disabled');
		                		}else{
				                    button.val('Enviar').css({'color' : '#000', 'background-color' : 'transparent', 'border-color' :'#000'}).removeAttr('disabled');
		                		}
							}, 5000);
                		}
                	}else{
                		if(button.closest('form').attr('id') == 'form-consulta'){
		                    button.val(response.message).css({'color' : '#000', 'background-color' : '#ffffff', 'border-color' :'#000'}).attr('disabled', 'disabled');
                		}else if(button.closest('form').attr('id') == 'form-newsletter'){
                			$('#message_newsletter').text(response.message);
							setTimeout(function(){
			                    button.val('Enviar').removeAttr('disabled');
	                			$('#message_newsletter').text('');
							}, 5000);
                		}else{
		                    button.val(response.message).css({'color' : '#000', 'background-color' : 'transparent', 'border-color' :'#000'}).attr('disabled', 'disabled');
                		}
                	}
                },
                error: function(response){
                    button.val('Ocorreu um erro no envio. Tente novamente mais tarde.').css({'color' : '#fff', 'background-color' : '#F85B5B', 'border-color' :'#F85B5B'}).attr('disabled', 'disabled');
                }
            });
        });
    });
</script>

<!--CORE JAVASCRIPT-->
<script src="assets/js/main.js"></script>
<script src="assets/js/layout.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102326112-1', 'auto');
  ga('send', 'pageview');

</script>