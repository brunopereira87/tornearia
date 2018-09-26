<?php

require_once 'banco-categoria.php';

if(isset($_POST['categoria']) && !empty($_POST['categoria']) ){
	$nome_categoria = addslashes($_POST['categoria']);

	$id_categoria = insereCategoria($conexao,$nome_categoria);

	$categoria = buscaCategoria($conexao,$id_categoria);
	$_SESSION['tab'] = "categorias";

	echo(json_encode($categoria));

}
