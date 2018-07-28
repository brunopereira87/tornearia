<?php 
	require_once 'conecta.php';
	require_once 'banco-usuario.php';
	$title = "Atualização de dados do Usuários";
	$css = '<link rel="stylesheet" type="text/css" href="css/adiciona.css">';
	require_once 'cabecalho.php';

	if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
		$id = $_SESSION['logado'];	
		header("Location: altera-usuario.php?id=".$id);
		exit;
	}
	else{
		header("Location: login.php");
		exit;
	}
	
	?>
	<ul>
		<li><a href="altera-usuario.php?id=<?=$id?>">Alterar Dados</a></li>
		<li><a href="deletar-usuario.php?id=<?=$id?>">Excluir conta</a></li>
		<li><li><a href="logout.php?id=<?=$id?>">Sair</a></li></li>	
	</ul>
	