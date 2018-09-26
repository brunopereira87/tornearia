<?php 
	require_once '../conecta.php';
	require_once '../banco-categoria.php';
	require_once '../banco-servicos.php';
	require_once '../banco-usuario.php';
	$title = "Cadastro de Servicos";
	$css = '<link rel="stylesheet" type="text/css" href="css/adiciona.css">';
	require_once 'cabecalho.php';

	if(!verificaLogin()){
            header("Location: index.php");
            exit;
	}
	if(isset($_GET['id_servico']) && !empty($_GET['id_servico'])){
		$id = $_GET['id_servico'];
	}
	else{
		header("Location: painel-controle.php");
		$_SESSION['erro'] = 'Serviço não encontrado';
		exit;
	}
	
	$servico = buscaServico($conexao,$id);
	if(!isset($servico) || empty($servico)){
		header("Location: painel-controle.php");
		$_SESSION['erro'] = 'Serviço não encontrado';
		exit;
	}
	
	if(isset($_POST['nome']) && !empty($_POST['nome'])){
		$nome = addslashes( $_POST['nome']);
		$nome = filter_var($nome,FILTER_SANITIZE_STRING);
		
		$descricao = addslashes($_POST['descricao']);
		$descricao = filter_var($descricao,FILTER_SANITIZE_STRING);
		
		$id_categoria = addslashes($_POST['categoria']);
		$id_categoria = filter_var($id_categoria,FILTER_VALIDATE_INT);
		
		if(isset($_FILES['fotos'])){
			$fotos = $_FILES['fotos'];
		}
		else{
			$fotos = array();
		}

		atualizarServico($conexao,$nome,$descricao,$id_categoria,$fotos,$id);
		$_SESSION['success'] = "Serviço atualizado com sucesso...";
	}
	$categorias = listaCategorias($conexao);
	
	
 ?>
 <div class="conteudo">
        <h2 class="titulo">Atualizar Servico</h2>
        <div class="row formulario">
               <div class="col-sm-12">
                       <?php 
                               if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
                                       echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
                                       unset($_SESSION['success']);
                               }
                       ?>
                       <form  method="post" enctype="multipart/form-data" >
                               <fieldset>
                                       <label for="nome">Nome do Serviço</label>
                                       <input type="text" name="nome" class="form-control" value="<?=$servico['nome']?>"  required>

                                       <label>Categoria</label>
                                       <select class="form-control" name="categoria" id="select_categoria">
                                               <?php
                                                       foreach($categorias as $categoria) :?>
                                                       <option value="<?=$categoria['id']?>" <?=($servico['id_categoria'] == $categoria['id']) ? 'selected="selected"':""?>><?=$categoria['nome']?></option>
                                               <?php 
                                                       endforeach;
                                               ?>

                                       </select>
                                       <a class="btn btn-padrao" id="btn_add_categoria">Nova categoria</a>
                                       <label>Descrição do Serviço</label>
                                       <textarea required name="descricao" class="form-control" ><?=$servico['descricao']?></textarea>

                                       <div class="form-group">
                                           <label for="fotos">Fotos</label><br>
                                           <input type="file" name="fotos[]" multiple>
                                           <div class="panel panel-default">
                                               <div class="panel-heading">Imagens</div>
                                               <div class="panel-body">
                                                   <?php
                                                       foreach($servico['imagens'] as $imagem) : ?>

                                                       <figure class="foto_item">
                                                           <img src="img/servicos/<?=$imagem['url']?>" class="img-thumbnail">
                                                           <a href="../excluir-imagem.php?id=<?=$imagem['id']?>" class="btn btn-default">Excluir imagem</a>
                                                       </figure>
                                                   <?php
                                                       endforeach;
                                                   ?>
                                               </div>
                                           </div>
                                       </div>

                                       <button type="submit" class="btn btn-success btn-padrao">Enviar</button>
                               </fieldset>	
                       </form>
               </div>
        </div>
	
 </div>


<?php require_once 'rodape.php';