<?php
/******
*PDO
*******/
require_once 'conecta.php';

function listaServicos($conexao){
	$servicos = array();
	$sql = "SELECT s.*,c.nome as categoria FROM servicos s INNER JOIN categorias c ON s.id_categoria = c.id ";
	$resultado = $conexao->query($sql);
	
	if($resultado->rowCount() > 0){
		$servicos = $resultado->fetchAll();
	}

	return $servicos;	 
}
function listaServicosPaginacao($conexao,$offset,$limite){
	$servicos = array();

	$sql = "SELECT s.*,c.nome as categoria FROM servicos s INNER JOIN categorias c on s.id_categoria = c.id LIMIT $offset,$limite";

	$sql = $conexao->query($sql);
	

	if($sql->rowCount() > 0){
		$servicos = $sql->fetchAll();
	}
	return $servicos;
}

function listaServicosCategoria($conexao,$id){
	$servicos = array();
	$sql = "select * from servicos where id_categoria = :id order by nome";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();
	
	if($sql->rowCount() > 0){
		$servicos = $sql->fetchAll();
	}
	return $servicos;
}
function buscaServico($conexao,$id){

	$servico = array();
	$sql = "select s.*,c.nome as categoria from servicos s inner join categorias c on s.id_categoria = c.id where s.id = :id";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();
	
	if($sql->rowCount() > 0){

		$servico = $sql->fetch();
		$servico['imagens'] = array();

		$sql = $conexao->prepare("SELECT * FROM servicos_imagens WHERE id_servico = :id_servico");
		$sql->bindValue(":id_servico",$id);
		$sql->execute();

		if($sql->rowCount() > 0){
			$servico['imagens'] = $sql->fetchAll();
		}
		
	}
	
	return $servico;
}
function inserirServico($conexao,$nome,$descricao,$id_categoria,$fotos){
	$sql_code = "insert into servicos(nome,descricao,id_categoria) values (:nome, :descricao, :id_categoria)";
	$sql_code = $conexao->prepare($sql_code);
	$sql_code->bindValue(":nome",$nome);
	$sql_code->bindValue(":descricao",$descricao);
	$sql_code->bindValue(":id_categoria",$id_categoria);
	$sql_code->execute();
	
	if(count($fotos)>0){
		$id_servico = $conexao->lastInsertId();
		salvarImagem($id_servico,$fotos,$conexao);
	}

	atualizaComServicos($conexao,$id_categoria);
	

}
function atualizarServico($conexao,$nome,$descricao,$id_categoria,$fotos,$id){
	$sql_code = "UPDATE servicos SET nome = :nome, descricao = :descricao, id_categoria = :id_categoria WHERE id = :id";
	$sql_code = $conexao->prepare($sql_code);
	$sql_code->bindValue(":nome",$nome);
	$sql_code->bindValue(":descricao",$descricao);
	$sql_code->bindValue(":id_categoria",$id_categoria);
	$sql_code->bindValue(":id",$id);
	$sql_code->execute();

	if(count($fotos)>0){
		$id_servico = $conexao->lastInsertId();
		salvarImagem($id,$fotos,$conexao);
	}

	atualizaComServicos($conexao,$id_categoria);
}
function deletarServico($conexao,$id){

	deletarImagens($conexao,$id);	

	$sql = "DELETE FROM servicos WHERE id = :id";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();
}
function deletarImagens($conexao,$id_servico){
	$sql = "DELETE FROM servicos_imagens WHERE id_servico = :id_servico";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":id_servico",$id_servico);
	$sql->execute();
}
function salvarImagem($id_servico,$fotos,$conexao){
	for($i=0;$i<count($fotos['tmp_name']);$i++){
		$tipo = $fotos['type'][$i];
		if(in_array($tipo, array('image/jpeg','image/png','image/jpeg'))){
			$nome_foto = md5(time().rand(0,999)).'.jpg';
			$url = "img/servicos/".$nome_foto;

			$sql = $conexao->prepare("INSERT INTO servicos_imagens(url,id_servico) VALUES(:url, :id_servico) ");
			$sql->bindValue(":url",$nome_foto);
			$sql->bindValue(":id_servico",$id_servico);
			$sql->execute();

			move_uploaded_file($fotos['tmp_name'][$i], $url);

			list($largura_original,$altura_original) = getimagesize($url);
			$ratio = $largura_original/$altura_original;

			$largura = 600;
			$altura = 600;

			if(($largura / $altura) > $ratio){
				$largura = $altura * $ratio;
			}
			else{
				$altura = $largura/$ratio;
			}

			$imagem = imagecreatetruecolor($largura, $altura);

			if($tipo == "image/jpeg"){
				$img_original = imagecreatefromjpeg($url);
			}
			else{
				$img_original = imagecreatefrompng($url);
			}	
		}
	}
}

function listaImagensServico($conexao,$id){
	$imagens = array();
	$sql = $conexao->prepare("SELECT * FROM servicos_imagens WHERE id_servico = :id");
	$sql->bindValue(":id",$id);
	$sql->execute();

	if($sql->rowCount() > 0){
		$imagens = $sql->fetchAll();
	}
	return $imagens;
}

function excluirImagem($conexao,$id){

	$sql = $conexao->prepare("SELECT * FROM servicos_imagens WHERE id = :id");
	$sql->bindValue(":id",$id);
	$sql->execute();

	$id_servico = 0;
	if($sql->rowCount() > 0){
		$sql = $sql->fetch();
		$id_servico = $sql['id_servico'];
		$url = "img/servicos/".$sql['url'];
		unlink($url);
	}

	$sql = $conexao->prepare("DELETE FROM servicos_imagens WHERE id = :id");
	$sql->bindValue(":id",$id);
	$sql->execute();

	return $id_servico;
}