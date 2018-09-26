<?php

session_start();
if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
    header("Location: index.php");
    exit;
}
require_once 'banco-categoria.php';

if(!empty($_GET['id_categoria'])){
    $id = addslashes($_GET['id_categoria']);
    deletarCategoria($conexao,$id);
    $_SESSION['success'] = "Categoria excluída com sucesso";
}
else{
    $_SESSION['erro'] = "Categoria não encontrada";
}
header("Location: painel-controle.php#categorias");
exit;
