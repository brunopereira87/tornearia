<?php
	$css = '<link rel="stylesheet" type="text/css" href="css/painel.css">';
	$title = "Painel de Controle";
	require_once 'cabecalho.php';
	require_once 'conecta.php';
	require_once 'banco-servicos.php';

	$servicos = listaServicos($conexao);

?>
	<div class="conteudo">
		<h1>Serviços</h1>
		<a href="adiciona-servico.php" class="btn btn-adiciona">Adicionar Serviço</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Descrição</th>
					<th>Categoria</th>
					<th>Ações</th>
				</tr>
				
			</thead>
			<tbody>
				<?php
					foreach($servicos as $servico) : ?>
					<tr>
						<td><?=$servico['nome']?></td>
						<td><?=$servico['descricao']?></td>
						<td><?=$servico['categoria']?></td>
						<td>
							<div class="acoes">
								<a href="altera-servico.php?id_servico=<?=$servico['id']?>" class="btn btn-editar">Editar</a>
								<a href="excluir-servico.php?id_servico=<?=$servico['id']?>" class="btn btn-excluir">Excluir</a>
							</div>
							
						</td>
						
					</tr>
				<?php
					endforeach;
				?>
				
			</tbody>			
		</table>
	</div>
<?php
	require_once 'rodape.php';
?>