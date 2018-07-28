<?php $title = "Home";
$css = '<link rel="stylesheet" type="text/css" href="css/home.css">';

require_once 'banco-servicos.php';

$servicos = listaServicos($conexao);

?>
<?php require_once "cabecalho.php";?>

	<section class="empresa">
		<div class="conteudo">
			<article class="conteudo-home">
				<h2>Torno - Serralheria - Calhas - Serviços em Geral</h2>
				<p>Isso é um parágrafo nada mais que um parágrafo copiei e cole Isso é um parágrafo nada mais que um parágrafo copiei e coleii Isso é um parágrafo nada mais que um parágrafo copiei e colei Isso é um parágrafo nada mais que um parágrafo copiei e colei Isso é um parágrafo nada mais que um parágrafo copiei e colei Isso é um parágrafo nada mais que um parágrafo copiei e colei Isso é um parágrafo nada mais que um parágrafo copiei e colei Isso é um parágrafo nada mais que um parágrafo copiei e colei</p>
				<a class="mais" href="#">leia mais</a>
			</article>
		</div>

	</section>
	<section class="servicos">
		<div class="conteudo">	
			<article class="imagens">
				<div id="slider">
					<div class="slide-imagem">
						<figure class="slide">
							<img src="img/imagem1.jpg" >
						</figure>
						<figure class="slide">
							<img src="img/imagem2.png">
						</figure>
						<figure class="slide">
							<img src="img/imagem3.png">
						</figure>
						<figure class="slide">
							<img src="img/imagem2.png">
						</figure>
						<figure class="slide">
							<img src="img/imagem1.jpg" >
						</figure>
					</div>
				</div>
				
			</article>

			<article class="conteudo-home">
				<h2>Faça o orçamento para o seu serviços</h2>
				<h3>Serviços</h3>
				<ul class="servico">
					<?php
						for($i=0;$i<4 ;$i++) : ?>
							<li><a href="servico.php?id=<?=$servicos[$i]['id']?>">
									<i class="fa fa-gear" style="font-size: 20px"></i><?=$servicos[$i]['nome']?> 
								</a>	
							</li>
					<?php
						endfor;
					?>
				</ul>
			</article>
				<div class="clear"></div>
		</div>
	</section>
        

<?php require_once "rodape.php";?>