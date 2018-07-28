<?php
$title = "Exclusão de Conta";
$css = "";
require_once 'cabecalho.php';
require_once 'banco-usuario.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	deletarUsuario($conexao,$id);
	session_destroy();
	header("Location: login.php");
	exit;
}

?>
