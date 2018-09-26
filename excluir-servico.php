<?php

session_start();
require_once '../banco-servicos.php';

if(!empty($_GET['id_servico'])){
    $id = addslashes($_GET['id_servico']);
    deletarServico($conexao,$id);
    $_SESSION['success'] = "Serviço excluído com sucesso";
}
else{
    $_SESSION['erro'] = "Serviço não encontrado";
}
header("Location: painel-controle.php");
exit;
