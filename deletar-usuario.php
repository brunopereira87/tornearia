<?php
$title = "Exclusão de Conta";
$css = "";
require_once 'cabecalho.php';
require_once 'banco-usuario.php';

if(!isset($_SESSION['logado']) || empty($_SESSION['logado']) ){
   header("Location: index.php");
   exit; 
}
if(getNivel($_SESSION['logado'], $conexao) != 1){
    header("Location: painel-controle.php");
    exit; 
}
if(isset($_GET['id']) && !empty($_GET['id'])){
    
    $id = $_GET['id'];
    deletarUsuario($conexao,$id);
    header("Location: login.php");
    exit;
}

?>
