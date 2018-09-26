<?php
    require_once '../banco-funcionario.php';
    $title = "Confirmar exclusão de serviço";
    $css = '<link rel="stylesheet" type="text/css" href="css/servico.css">';
    require_once 'cabecalho.php';
    
    autorizaAdmin($conexao);
    
    if(isset($_GET['id_funcionario']) && !empty($_GET['id_funcionario'])){
	$id = filter_input(INPUT_GET,'id_funcionario',FILTER_VALIDATE_INT);
    }
    
    $funcionario = buscaUsuario($conexao,$id);
    
    if(!isset($funcionario) || empty($funcionario)){
        $_SESSION['erro'] = 'Funcionário não encontrado em nossa base de dados';
        header('Location:painel-controle.php');
        exit;
    }
?>
<div class="conteudo">
    <section class="confirma-exclusao">
        <p>Tem certeza que deseja excluir o funcionário escolhido?</p>
        <a href="../deletar-usuario.php?id_funcionario=<?=$id?>" class="btn btn-warning">Sim</a>
    <a href="painel-controle.php" class="btn btn-primary">Não</a>
    </section>
    
</div>
<?php require_once 'rodape.php';

