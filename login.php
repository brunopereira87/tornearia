<?php

$title = "Login de Usuário";
$css = '<link rel="stylesheet" type="text/css" href="css/login.css">';

require_once 'cabecalho.php';
require_once 'banco-usuario.php';

if(isset($_POST['email']) && !empty($_POST['email'])){
	$email = addslashes($_POST['email']);
	$senha = md5($_POST['senha']);
	logarUsuario($email,$senha,$conexao);
}

?>
<div class="conteudo">
	<h2 class="titulo">Login de Usuário</h2>
	<?php 
		if(isset($_SESSION['erro'])){
			echo "<p class='alert alert-danger'>".$_SESSION['erro'];
			unset($_SESSION['erro']);
		}
	?>
	<form method="POST" class="formulario">
	<div class="form-group">
		<label for="email" class="sr-only">Digite seu email</label>
		<input  id="email" type="email" name="email" class="form-control" placeholder="Digite seu email">
	</div>
	<div class="form-group">
		<label for="senha" class="sr-only">Digite sua senha</label>
		<input  id="senha" type="password" name="senha" class="form-control" placeholder="Digite sua senha">
	</div>
	<button type="submit" class="btn btn-primary">Login</button>
	
</form>

</div>


<?php require_once 'rodape.php';?>
