$(document).ready(function(){
    $('.exportar-filtros input:radio').change(function(){
        if($(this).attr('id') == 'produtos' || $(this).attr('id') == 'orcamento'){
            $('.lista-produtos').css({'display' : 'block'});
        }else{
            $('.lista-produtos').css({'display' : 'none'});
        }
    });
});

function excluirRegistros(controller, funcao){
    var ids = '';

    $('table tbody input[type=checkbox]:checked').each(function(){
        ids += $(this).val() + ';';
    });
    
    vet_dados = "ids="+ids;
    base_url  = $('base').attr('href')+"admin/"+ controller +"/"+ funcao;
    
    $.ajax({
        type: "POST",
        url: base_url,
        dataType: "JSON",
        data: vet_dados,
        async:false,
        success: function(msg) {
            location.href=window.location;
        },
        error: function(msg) {
            location.reload();
        }
    });
    
}

function selecionar_todos(obj){

    if($(obj).attr('checked')){ // selecionar todos
        $('table input[type=checkbox]').attr('checked', 'checked');
    }else{ //selecionar todos
        $('table input[type=checkbox]').attr('checked', '');
    }
}

$(function() {
    $( "#sortable" ).sortable({
        placeholder: "highlight",

        start: function (event, ui) {
            ui.item.toggleClass('highlight');
        },
        stop: function (event, ui) {
            ui.item.toggleClass('highlight');
        },

        update: function(event, ui) {
            //create the array that hold the positions...
            var order = []; 
            //loop trought each li...
            $('#sortable > tr').each( function(e) {

                //add each li position to the array...     
                // the +1 is for make it start from 1 instead of 0
                order.push( $(this).attr('id')  + '=' + ( $(this).index() + 1 ) );
            });

            // join the array as single variable...
            var positions = order.join(';')

            //pass the array to a hidden input
            $('.new_order_input').val(positions)
            //enable the "save order" button
            $('.reorder_button').attr('disabled', false);
        }
    });
    $('#sortable').disableSelection();
  });