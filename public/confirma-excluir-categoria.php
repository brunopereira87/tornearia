<?php
    require_once '../banco-categoria.php';
    require_once '../banco-usuario.php';
    $title = "Confirmar exclusão de serviço";
    $css = '<link rel="stylesheet" type="text/css" href="css/servico.css">';
    require_once 'cabecalho.php';
    
    if(!verificaLogin()){
        header("Location: index.php");
        exit;
    }
    if(isset($_GET['id_categoria']) && !empty($_GET['id_categoria'])){
	$id = filter_input(INPUT_GET,'id_categoria',FILTER_VALIDATE_INT);
    }
    
    $categoria = buscaCategoria($conexao,$id);
    
    if(!isset($categoria) || empty($categoria)){
        $_SESSION['erro'] = 'Categoria não encontrada em nossa base de dados';
        header('Location:painel-controle.php');
        exit;
    }
?>
<div class="conteudo">
    <section class="confirma-exclusao">
        <p>Tem certeza que deseja excluir o serviço escolhido?</p>
        <a href="../excluir-servico.php?id_servico=<?=$id?>" class="btn btn-warning">Sim</a>
    <a href="painel-controle.php" class="btn btn-primary">Não</a>
    </section>
    
</div>
<?php require_once 'rodape.php';

