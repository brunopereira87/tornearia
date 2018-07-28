<?php


require_once 'banco-categoria.php';
require_once 'banco-servicos.php';

if(isset($_GET['id']) && !empty($_GET['id']) ){
	$id = $_GET['id'];
}
else{
	header("Location: servicos.php");
}

$servico = buscaServico($conexao,$id);
$imagens = listaImagensServico($conexao,$id);
$title = $servico['nome'];
$css = '<link rel="stylesheet" type="text/css" href="css/servico.css">';
require_once 'cabecalho.php';
?>
<div class="titulo-servico">
	<div class="conteudo">
		<h2><?=$servico['nome']?></h2>
	</div>
</div>

<div class="conteudo">
	
	<section class="servico">
		<strong>Categoria:</strong><?=$servico['categoria']?>
		<p class="descricao-servico"><?=$servico['descricao']?></p>
		<?php
			for($i=0;$i<count($imagens);$i++) : ?>
			<figure class="imagem-servico" onclick="abreModal(); slideAtual(<?=$i?>)">
				<img src="img/servicos/<?=$imagens[$i]['url']?>">
			</figure>
		<?php
			endfor;
		?>
		<div class="clear"></div>
			
	</section>
	<div class="modal_box" id="myModal">
		<a href="#" id="btn-fechar" onclick="fechaModal()">X</a>
		<div class="conteudo-modal">
			<?php
				for($i=0;$i<count($imagens);$i++) : ?>
					<img src="img/servicos/<?=$imagens[$i]['url']?>" class="img_modal">

			<?php
				endfor;
			?>
			
			<a class="prev" onclick="moveSlide(-1)">&#10094</a>
			<a class="next" onclick="moveSlide(1)">&#10095</a>
		</div>
		
		
		<figure class="miniaturas">
			<?php
				for($i=0;$i<count($imagens);$i++) : ?>
					<img  class="demo" src="img/servicos/<?=$imagens[$i]['url']?>" onclick="slideAtual(<?=$i?>)">
			<?php
				endfor;
			?>
			<div class="clear"></div>
		</figure>
	</div>
</div>
<script type="text/javascript" src="js/galeria.js"></script>
<?php require_once 'rodape.php';?>