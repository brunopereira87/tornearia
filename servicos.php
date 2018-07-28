<?php

$title = "Serviços";
$css = '<link rel="stylesheet" type="text/css" href="css/servicos.css">';
require_once 'cabecalho.php'; 

require_once 'banco-categoria.php';
require_once 'banco-servicos.php';
require_once 'banco-usuario.php';
$categorias = listaCategoriasComServicos($conexao);
$totalCategorias = count($categorias);
$categoriasColuna = ceil($totalCategorias/2);
?>

<div class="titulo">
	<div class="conteudo">
		<h2>Serviços</h2>
	</div>
</div>
<div class="conteudo">
	<section class="painel">
		<div class="servicos">
			<?php

				for($i=0;$i<$totalCategorias;$i++) : ?>
					<article class="servico">
						<h3><?=$categorias[$i]['nome']?></h3>
						<?php
							$servicos = listaServicosCategoria($conexao,$categorias[$i]['id']);

							foreach($servicos as $servico) :?>
								<a href="servico.php?id=<?=$servico['id']?>">
									<i class="fa fa-gear" style="font-size: 20px"></i><?=$servico['nome']?> 
								</a>	
						<?php
							endforeach;
						?>
					</article>
			<?php
				endfor;
			?>
		</div>
		
		
	</section>
	
</div>



<?php include 'rodape.php';?>
