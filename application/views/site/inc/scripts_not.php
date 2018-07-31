<script src="assets/js/jquery-1.11.2.min.js"></script>
<script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/libs/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js"></script>
<script src="assets/js/html5shiv.js"></script>
<script src="assets/js/respond.min.js"></script>
<script src="assets/js/layout.js"></script>

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

<script>
    $(document).ready(function(){

        // Fill in your MailChimp popup settings below.
    // These can be found in the original popup script from MailChimp.
    var mailchimpConfig = {
        baseUrl: 'mc.us12.list-manage.com',
        uuid: '51b7183d29e9bafa8875af40b',
        lid: '862e5062ea'
    };

    // No edits below this line are required
    var chimpPopupLoader = document.createElement("script");
    chimpPopupLoader.src = '//s3.amazonaws.com/downloads.mailchimp.com/js/signup-forms/popup/embed.js';
    chimpPopupLoader.setAttribute('data-dojo-config', 'usePlainJson: true, isDebug: false');

    var chimpPopup = document.createElement("script");
    chimpPopup.appendChild(document.createTextNode('require(["mojo/signup-forms/Loader"], function (L) { L.start({"baseUrl": "' +  mailchimpConfig.baseUrl + '", "uuid": "' + mailchimpConfig.uuid + '", "lid": "' + mailchimpConfig.lid + '"})});'));

    jQuery(function ($) {
        document.body.appendChild(chimpPopupLoader);

        $(window).load(function () {
            document.body.appendChild(chimpPopup);
        });
    });

    });
</script>
<script type="text/javascript">
    $(document).ready(function(){


        //Contact Form
        $('.submit-contact-form').click(function(event){
            event.preventDefault();

            var button = $(this);

            var lastUrlPart = document.URL.split('/').pop();
            var virtualPage = 'success-' + lastUrlPart;

            if(lastUrlPart === '') {
                virtualPage = 'success-home';
            }

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
                                if(button.closest('form').attr('id') == 'contact-form'){
                                    button.val('Enviar').css({'color' : '#000', 'background-color' : '#ffffff', 'border-color' :'#000'}).removeAttr('disabled');
                                }else{
                                    button.val('Enviar').css({'color' : '#000', 'background-color' : 'transparent', 'border-color' :'#000'}).removeAttr('disabled');
                                }
                            }, 5000);
                        }
                    }else{
                        if(button.closest('form').attr('id') == 'contact-form'){
                            gtag('config', 'UA-102326112-1', {'page_path': virtualPage});
                            button.val(response.message).css({'color' : '#000', 'background-color' : '#ffffff', 'border-color' :'#000'}).attr('disabled', 'disabled');
                        }else if(button.closest('form').attr('id') == 'form-newsletter'){
                            $('#message_newsletter').text(response.message);
                            gtag('config', 'UA-102326112-1', {'page_path': 'news-' + virtualPage});
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

        //Work Here Form
        $('.submit-work-form').click(function(event){
            event.preventDefault();

            var button = $(this);

            var form = $('#form-contato-trabalho').get(0);

            $.ajax({
                url: button.closest('form').attr('action'),
                type: 'POST',
                data: new FormData(form),
                async: false,
                cache: false,
                contentType: false,
                processData: false,
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
                                if(button.closest('form').attr('id') == 'contact-form'){
                                    button.val('Enviar').css({'color' : '#000', 'background-color' : '#ffffff', 'border-color' :'#000'}).removeAttr('disabled');
                                }else{
                                    button.val('Enviar').css({'color' : '#000', 'background-color' : 'transparent', 'border-color' :'#000'}).removeAttr('disabled');
                                }
                            }, 5000);
                        }
                    }else{
                        if(button.closest('form').attr('id') == 'contact-form'){
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-102326112-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-102326112-1');
</script>


