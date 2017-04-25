jQuery(document).ready(function($) {
	
    $("#form_linhas").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome.", 
                    "required,marca,Informe a marca.", 
                    "required,familia,Informe a família."
            ]
    });

    $("#form_familias").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome."
            ]
    });

    $("#form_cadastros").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome.",
                    "required,perfil,Informe o perfil.",
                    "required,email,Informe o email.",
                    "valid_email,email,Informe um e-mail válido.",
                    "required,telefone,Informe o telefone.", 
                    "required,estado,Informe o estado.",
                    "required,cidade,Informe a cidade.",
                    "required,rua,Informe o endereço.",
                    "required,numero,Informe o numero.",
                    "required,bairro,Informe o bairro.",
                    "function,valida_marcas,marca"           
                    ]
    });
    
    $("#form_representantes").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome.",
                    "required,email,Informe um e-mail.",
                    "valid_email,email,Informe um e-mail válido.",
                    "required,contato,Informe o contato.", 
                    "function,valida_estados,estado"           
                    ]
    });

    $("#form_novidades").RSV({
            displayType: "display-html",
            customBeforeValidation: function() {atualizaFCK('descricao')},
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,titulo,Informe o título.",
                    "required,descricao,Informe a descrição.",
                    "function,validaExtensaoImagem,imagem"
            ]
    });
    
    $("#form_produtos").RSV({
            displayType: "display-html",
            customBeforeValidation: function() {atualizaFCK('diferenciais')},
            customBeforeValidation: function() {atualizaFCK('caracteristicas')},
            customBeforeValidation: function() {atualizaFCK('funcao')},
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,marca,Informe a Marca.",
                    "required,familia,Informe a família.",
                    "required,linha,Informe a Linha.",
                    "required,nome,Informe o nome.",
                    "required,referencia,Informe a referencia.",
                    
            ]
    });

    $("#form_produto_imagem").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,imagem,Informe a imagem.",
                    "function,validaExtensaoImagem,imagem"
            ]
    });
    
    $("#form_produto_loja").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,loja,Digite o nome da Loja.",
                    "required,url,Digite a URL."
            ]
    });

    $("#form_noticia_arquivo").RSV({
            displayType: "display-html",
            customBeforeValidation: function() {atualizaFCK('descricao')},
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome.",
                    "required,arquivo,Informe o arquivo."
            ]
    });

    $("#form_novidade_link").RSV({
            displayType: "display-html",
            onCompleteHandler: myOnComplete,
            customErrorHandler: myOnError,
            rules: [
                    "required,nome,Informe o nome para o link.",
                    "required,url,Informe a url para o link."
            ]
    });
	
});

function atualizaFCK(fckInstances)
{
	fckInstances = fckInstances.split(',');
	for (i = 0; i < fckInstances.length; i++) {
		FCKeditorAPI.GetInstance(fckInstances[i]).UpdateLinkedField();
	}
}

function carregaCidades(idEstado)
{
	$.post("admin/endereco/ajax_cidades", {id:idEstado}, function (data)
    {
		var option = new Option('Selecione a Cidade', '');
		
		$("#cidade").empty();
		$("#cidade").append(option);
		
		$.each(data, function()
		{
		       $("#cidade").append("<option value='" + this.id + "'>" + this.nome + "</option>");
		});
		
   }, 'json');
}

function ve_datas(data_inicial,data_final){

    var data_inicial = document.getElementById(data_inicial);
    var data_final = document.getElementById(data_final);

    if (data_inicial == null)
        alert('Não achou campo ' + data_inicial)

    if (data_final == null)
        alert('Não achou campo ' + data_final)

    if (Compara_Datas(data_inicial,data_final))
        return true;

    var field = data_final;

    return [[field, "Extensão inválida."]];
}

function valida_estados (campo)
{
    var field = document.getElementById(campo);
    
    var ids;
    
	$.each($("input[name='estado[]']:checked"), function() {
		ids += (ids?',':'') + $(this).attr('value');
	});  
	  
    if(ids){
    	return true
    }else{
    	return [[field, "Selecione um estado para o representante."]];
    }
}

function valida_marcas (campo)
{
    var field = document.getElementById(campo);
    
    var ids;
    
	$.each($("input[name='marca[]']:checked"), function() {
		ids += (ids?',':'') + $(this).attr('value');
	});  
	  
    if(ids){
    	return true
    }else{
    	return [[field, "Selecione uma marca."]];
    }
}

function valida_marcas2 (campo)
{
    var field = document.getElementById(campo);
    
    var ids;
    
	$.each($("input[name='marcas[]']:checked"), function() {
		ids += (ids?',':'') + $(this).attr('value');
	});  
	  
    if(ids){
    	return true
    }else{
    	return [[field, "Selecione uma marca."]];
    }
}