<?php

require_once "../banco-categoria.php";
require_once "../banco-usuario.php";

if(!verificaLogin()){
    header("Location: index.php");
    exit;
}
if(isset($_POST['id']) && !empty($_POST['id'])){
	
	if(!empty($_POST['nome'])){
		$nome = filter_var(addslashes($_POST['nome']));
		alteraCategoria($conexao,$_POST['id'],$nome);
		echo "Dados alterados com sucesso";
	}
	else{
		$_SESSION['erro'] = "O campo categoria está vazio";
		header("location: painel-controle.php#categoria");
		exit;
	}
}