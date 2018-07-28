<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<?php if (isset($css) && !empty($css)) {
		print($css);
	}
?>
	<title><?php print($title)?></title>
</head>
	<body>
		<header>

			<div class="conteudo">
				<div class="topo">
					<a href="index.php">
						<h1 class="logo">OF Tornearia</h1>
					</a>
					<div class="icones">
						<button class="btn-fechar"><i class="fa fa-times"></i></button>
						<button class="btn-menu"><img src="img/list.png"></button>
						<div class="clear"></div>
					</div>
				</div>
				<div class="topo-direita">
					<form class="pesquisar">
						<label class="sr-only">Pesquisar</label>
						<input type="search" name="pesquisar" placeholder="Pesquisar" class="form-control">
						<button class="btn btn-default btn-pesquisar" type="submit">Pesquisar</button>
						<div class="clear"></div>
					</form>						
				</div>
			</div>
			<div class="clear"></div>
			<div class="menu-navegacao-out">
				<div class="conteudo">
					<nav class="menu-navegacao">			
						<ul class="menu-esquerdo">
							<li><a href="index.php">Home</a></li>
							<li><a href="empresa.php">Empresa</a></li>
							<li><a href="servicos.php">Serviços</a></li>					
							<li><a href="contato.php">Contato</a></li>
						</ul>							
							<?php
								require_once 'banco-usuario.php';

								if(verificaLogin()) : ?>
									<ul class="menu-direito logado">
										<li><a href="conta-usuario.php">Minha Conta</a></li>
										<li><a href="painel-controle.php">Painel de Controle</a></li>
										<li><a href="logout.php">Sair</a></li>
							<?php
								else : ?>
									<ul class="menu-direito deslogado">	
										<li><a href="login.php">Login</a></li>
							<?php
								endif;
							?>
							
							
						</ul>
						
					</nav>
				</div>
			</div>		
		</header>
		<main>