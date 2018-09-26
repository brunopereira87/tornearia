$(".btn-menu").click(function(event) {
	$(this).hide();
	$(".menu-navegacao").show();
	$(".btn-fechar").show();
});

$(".btn-fechar").click(function(event) {
	$($(this)).hide();
	$(".menu-navegacao").hide();
	$(".btn-menu").show();
});
/*
setInterval(seletor).animate({propriedade},tempo,callback)
*/
$(function () {
	var largura = 300;
	var velocidadeAnimacao = 1000;
	var pausa = 3000;
	var $slider = $("#slider");
	var $slideImagem = $slider.find('.slide-imagem');
	var $slides = $slideImagem.find('.slide');
	var slideAtual = 1;

	var intervalo;

	function iniciaSlide(){
		intervalo = setInterval(function(){
			$slideImagem.animate({'margin-left':'-='+largura+'px'}, velocidadeAnimacao, function(){
				slideAtual++;
				if(slideAtual===$slides.length){
					slideAtual = 1;
					$slideImagem.css('margin-left',0);
				}
			});
		},pausa);
	}

	function paraSlide(){
		clearInterval(intervalo);
	}

	$slideImagem.on('mouseenter',paraSlide).on('mouseleave',iniciaSlide);
	iniciaSlide();
});

var largura = window.screen.width;

if(largura>=1000){
	insereElementos();
}



function insereElementos(){
	var classe;

	if(largura >= 1000){
		classe = ".empresa .conteudo";
	}
	else{
		classe = ".imagens";
	}
	console.log("Tamanho da tela:"+largura);
	insereImagem(classe);
	insereClear(classe);
}
function insereImagem(classe){
	$(classe).append('<figure class="img_pecas"><img src="img/imagem2.png"></figure>');

}
function insereClear(classe){
	$(classe).append('<div class="clear"></div>');
}

$("#btnTrocaImagem").on("click",function(){
	$("#imagem_usuario").trigger('click');
});

function trocarImagem(){
	if(typeof (FileReader) != "undefined"){
		var imagem_preview = $("#img_preview");
		

		var reader = new FileReader();
		reader.onload = function(e){
			imagem_preview.attr("src",e.target.result);
		}
		reader.readAsDataURL($("#imagem_usuario")[0].files[0]);
	}
	else{
		alert("Este navegador não suporta FileReader.");
	}
}

$('#btn_add_categoria').on("click", function(e){

	e.preventDefault();
	var categoria = prompt("Digite a categoria:");

	$.ajax({
		url: "insere-categoria.php",
		type: "POST",
		dataType: "json",
		data: {categoria:categoria},
		success:function(dados){
			alert("Categoria adicionada com sucesso");
			console.log(dados);
			console.log(categoria);
			if($('#select_categoria').length > 0){
				$('#select_categoria').append('<option value="'+dados.id+'">'+dados.nome+'</option>');
			}
			else{
				location.reload();
				window.location.href = "painel-controle.php#categorias";
			}
		}
	});
});

function alteraCategoria(id, nome){
	var categoria = prompt("Digite o novo nome da categoria:",nome);
	 if(categoria!=null){
	 	console.log("ID:"+id);
		console.log("nome:"+nome);
		$.ajax({
			url: "altera-categoria.php",
			type: "POST",
			data: {
				id:id,nome:categoria
			},
			success:function(resposta){
				if(resposta!=""){
					alert(resposta);
					window.location.href = "painel-controle.php";
				}
				
			}
		});
	 }
	
}
$(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
        console.log(location.hash);
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
    	var url = window.location.href;
    	location.hash = this.getAttribute("href");
    	
    	if(url.includes("?p")){//verifica se a paginação foi ativada na aba clicada
    		var novaUrl = url.replace(url.slice(url.indexOf("?p")), "");
    		window.location.href = novaUrl+location.hash;
    		console.log(novaUrl);
    	}
    	
        location.hash = this.getAttribute("href");
        
        console.log(location.hash);
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");

    $("a[href='" + anchor + "']").tab("show");
});

/*function myFunction() {
    var str = "http://localhost/tornearia/painel-controle.php?p=1#categorias"; 
    var res = str.replace(str.substr(str.indexOf("?")), "");
    document.getElementById("demo").innerHTML = res;



}*/