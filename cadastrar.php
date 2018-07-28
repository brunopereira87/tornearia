<?php 
	require_once 'conecta.php';
	require_once 'banco-usuario.php';
	$title = "Cadastro de Usuários";
	$css = '<link rel="stylesheet" type="text/css" href="css/cadastra.css">';
	require_once 'cabecalho.php';

	if(isset($_FILES['arquivo'])){

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
				header("Location: cadastrar.php");
				exit;
		}
		$novo_nome = md5(time()).$extensao;
		$diretorio = "img/usuarios";
		$imagem = $diretorio.$novo_nome;
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $imagem);	
	}else{
		$imagem = "img/photo.png";
	}
	if(isset($_POST['nome']) && !empty($_POST['nome'])){
		$nome = addslashes( $_POST['nome']);
		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$senha1 = md5($_POST['senha1']);
		$senha2 = md5($_POST['senha2']);

		if($senha1==$senha2){
			inserirUsuario($conexao,$nome,$username,$email,$senha1,$imagem);
			header("Location: login.php");
		}
		else{
			$msg = "As duas senhas não estão iguais...";
		}

	}
 ?>
 <div class="conteudo">
 	 <h2 class="titulo">Cadastro de Usuário</h2>
	 <?php 
	 	if(!empty($msg)) {
	 		echo("<p class='alert alert-danger'>$msg</p>");
	 	}

	 	if(isset($_SESSION['erro'])){
	 		
	 	}
	 ?>
	<form  method="post" enctype="multipart/form-data" class="formulario">
		
			<h3>Dados para cadastro</h3>
			<figure id="preview">
				<img src="img/photo" id="img_preview">
				<figcaption><a href="javascript:;" id="btnTrocaImagem">Trocar imagem</a></figcaption>
				<input type="file" id="imagem_usuario" onchange="trocarImagem()" name="arquivo">
			</figure>
			
			<fieldset>
				<label>Nome Completo</label>
				<input type="text" name="nome" class="form-control" placeholder="Nome Completo" required>
				<label>Nome de usuário</label>
				<input type="text" name="username" class="form-control" placeholder="Nome de usuário" required>
				<label>Email</label>
				<input required type="email" name="email" class="form-control" placeholder="Email"></textarea>
				<label>Digite a senha</label>
				<input type="password" name="senha1" class="form-control" placeholder="Digite a senha" required>
				<label>Digite a senha novamente</label>
				<input type="password" name="senha2" class="form-control" placeholder="Digite a senha novamente" required>
				<button type="submit" class="btn btn-primary">Cadastrar</button>
		</fieldset>	
	</form>
 </div>


<?php require_once 'rodape.php';