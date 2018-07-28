<?php


require_once 'banco-usuario.php';
require_once 'banco-servicos.php';

if(!verificaLogin()){
	$_SESSION['erro'] = "Área de acesso restrita!";
	header("Location: login.php");
	exit;
}
if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$id_servico = excluirImagem($conexao,$id);
}
else{
	header("Location: index.php");
	exit;
}

if(isset($id_servico) && $id_servico !==0 ){
	header("Location: altera-servico.php?id_servico=".$id_servico);
	exit();
}
else{
	header("Location: painel-controle.php");
	exit();	
}

