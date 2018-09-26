<?php 
    require_once '../conecta.php';
    require_once '../banco-usuario.php';
    $title = "Atualização de dados do Usuários";
    $css = '<link rel="stylesheet" type="text/css" href="css/cadastra.css">';
    require_once 'cabecalho.php';


    if(isset($_GET['id']) && !empty($_GET['id'])){
        $id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);

        if(getNivel($_SESSION['logado'],$conexao) != 1 && $id != $_SESSION['logado']){
            $id = $_SESSION['logado'];
        }
        $usuario = buscaUsuario($conexao,$id);	
    }
    else{
        header('Location:painel-controle.php#funcionarios');
        exit;
    }

    if(isset($_FILES['arquivo']['tmp_name']) && !empty($_FILES['arquivo']['tmp_name'])){
        switch ($_FILES['arquivo']['type']) {
            case 'image/jpeg':
                $extensao = ".jpg";
                break;
            case 'image/jpg':
                $extensao = ".jpg";
                break;
            case 'image/png':
                $extensao = ".png";
                break;	
            default:
                $_SESSION['erro'] = "Formato de imagem não permitido";
                header("Location: altera-usuario.php?id=".$id);
                exit;
        }
        $novo_nome = md5(time().rand(0,999)).$extensao;
        $diretorio = "img/usuarios/";

        if( $_FILES['arquivo']['size'] > 0){
            $imagem = $diretorio.$novo_nome;
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $imagem);
            unlink($_POST['url']);
        }
        else{
            if(isset($_POST['url'])){
                $imagem =$_POST['url'];	
            }
        }
    }else{
            $imagem = $usuario['imagem'];
    }
    if(isset($_POST['nome']) && !empty($_POST['nome'])){
        $nome = addslashes( $_POST['nome']);
        $username = addslashes($_POST['username']);
        $email = addslashes($_POST['email']);
        if(isset($_POST['senha1']) && (!empty($_POST['senha1']))){//verifica se o usuário digitou uma nova senha
            $senha1 = md5($_POST['senha1']);
            $senha2 = md5($_POST['senha2']);
        }
        else{//se não digitou, reinsere a senha que já estava cadastrada
            $senha1 = $usuario['senha'];
            $senha2 = $usuario['senha'];
        }


        if($senha1==$senha2){
            alterarUsuario($conexao,$nome,$username,$email,$senha1,$imagem,$id);
            $_SESSION['success'] = "Dados atualizados com sucesso!";
            if($usuario['id']==$_SESSION['logado']){
                header("Location: conta-usuario.php");
                exit;
            }
            else{
                header("Location: painel-controle.php");
                exit;
            }

        }
        else{
            $msg = "As duas senhas não estão iguais...";
        }


    }
?>
<div class="conteudo">
     <h2 class="titulo">Atualização de Dados</h2>
     <?php 
            if(!empty($msg)) 
                echo("<p class='alert alert-danger'>$msg</p>");
            if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
                echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
                unset($_SESSION['success']);
            }

            if(isset($_SESSION['erro']) && !empty($_SESSION['erro'])){
                echo "<p class='alert alert-danger'>".$_SESSION['erro']."</p>";
                unset($_SESSION['erro']);
            }
     ?>
    <form  method="post" enctype="multipart/form-data" class="formulario">

        <h3>Dados para cadastro</h3>
        <figure id="preview">
            <img src="<?=$usuario['imagem']?>" id="img_preview">
            <figcaption><a href="javascript:;" id="btnTrocaImagem">Trocar imagem</a></figcaption>
            <input type="file" id="imagem_usuario" onchange="trocarImagem()" name="arquivo">
            <input type="hidden" name="url"  value="<?=$usuario['imagem']?>">
        </figure>

        <fieldset>
            <label>Nome Completo</label>
            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" value="<?=$usuario['nome']?>" required>
            <label>Nome de usuário</label>
            <input type="text" name="username" class="form-control" placeholder="Nome de usuário" value="<?=$usuario['username']?>" required>
            <label>Email</label>
            <input required type="email" name="email" class="form-control" placeholder="Email" value="<?=$usuario['email']?>"></textarea>
            <label>Digite a senha</label>
            <input type="password" name="senha1" class="form-control" placeholder="Digite a senha">
            <label>Digite a senha novamente</label>
            <input type="password" name="senha2" class="form-control" placeholder="Digite a senha novamente">
            <button type="submit" class="btn btn-primary">Alterar</button>
        </fieldset>	
    </form>
 </div>


<?php require_once 'rodape.php';