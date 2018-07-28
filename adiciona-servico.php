<?php 
	require_once 'conecta.php';
	require_once 'banco-categoria.php';
	require_once 'banco-servicos.php';
	$title = "Cadastro de Servicos";
	$css = '<link rel="stylesheet" type="text/css" href="css/adiciona.css">';
	require_once 'cabecalho.php';

	$categorias = listaCategorias($conexao);
	
	if(isset($_FILES['arquivo'])){
		$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));//pega a extensão
		$novo_nome = md5(time()).$extensao;
		$diretorio = "upload/";
		$imagem = $diretorio.$novo_nome;
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $imagem);

		
	}else{
		$imagem = "img/photo.png";
	}
	if(isset($_POST['nome']) && !empty($_POST['nome'])){
		$nome = addslashes( $_POST['nome']);
		$descricao = addslashes($_POST['descricao']);
		$id_categoria = addslashes($_POST['categoria']);
		
		if(isset($_FILES['fotos'])){
			$fotos = $_FILES['fotos'];
		}
		else{
			$fotos = array();
		}

		inserirServico($conexao,$nome,$descricao,$id_categoria,$fotos);
		$_SESSION['success'] = "Serviço cadastrado com sucesso...";
	}
	/*else{
		$msg = "Erro ao cadastrar servico...";
	}
	
	/*if(mysqli_query($conexao, $sql_code))
		$msg = "Arquivo salvo com sucesso...";
	else
		$msg = "Erro ao salvar arquivo...".mysqli_error($conexao);*/
 ?>
 <div class="conteudo">
 	 <h2 class="titulo">Adicionar Servico</h2>
 	 <?php 
	 	if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
	 		echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
	 		unset($_SESSION['success']);
	 	}
	 ?>
 	 <div class="row formulario">
 	 	<div class="col-sm-12">
 	 		<?php 
 	 		 	if(!empty($msg)) echo("<p>$msg</p>");
 		 	?>
			<form  method="post" enctype="multipart/form-data" >
				<fieldset>
					<label for="nome">Nome do Serviço</label>
					<input type="text" name="nome" class="form-control"  required>
					
					<label>Categoria</label>
					<select class="form-control" name="categoria" id="select_categoria">
						<?php
							for($i=0; $i < count($categorias);$i++) :?>
							<option value="<?=$categorias[$i]['id']?>"><?=$categorias[$i]['nome']?></option>
						<?php 
							endfor;
						?>
						
					</select>
					<a class="btn btn-padrao" id="btn_add_categoria">Nova categoria</a>
					<label>Descrição do Serviço</label>
					<textarea required name="descricao" class="form-control" ></textarea>
					<div class="form-group">
						<label for="fotos">Fotos</label><br>
						<input type="file" name="fotos[]" multiple>
					</div>
					
					<button type="submit" class="btn btn-success btn-padrao">Enviar</button>
				</fieldset>	
			</form>
 	 	</div>
 	 </div>
	
 </div>


<?php require_once 'rodape.php';