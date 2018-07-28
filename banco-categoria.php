<?php 

require_once 'conecta.php';

function listaCategorias($conexao){
	$categorias = array();
	$sql = "Select * from categorias order by nome";
	$resultado = $conexao->query($sql);
	
	if($resultado->rowCount() > 0){
		foreach($resultado->fetchAll() as $categoria){
			array_push($categorias, $categoria);
		}
	}
	else{
		echo "Sem categorias retornadas";
	}
	return $categorias;
}

function listaCategoriasPaginacao($conexao,$offset,$limite){
	$categorias = array();
	$sql = "SELECT * from categorias ORDER BY nome LIMIT $offset,$limite";
	$resultado = $conexao->query($sql);
	
	if($resultado->rowCount() > 0){
		foreach($resultado->fetchAll() as $categoria){
			array_push($categorias, $categoria);
		}
	}
	else{
		echo "Sem categorias retornadas";
	}
	return $categorias;
}
function listaCategoriasComServicos($conexao){
	$categorias = array();
	$sql = "Select * from categorias where com_servicos = 1 order by nome";
	$resultado = $conexao->query($sql);
	
	if($resultado->rowCount() > 0){
		foreach($resultado->fetchAll() as $categoria){
			array_push($categorias, $categoria);
		}
	}
	else{
		echo "Sem categorias retornadas";
	}
	return $categorias;
}

function buscaCategoria($conexao,$id){

	$sql = "SELECT * FROM categorias WHERE id = :id";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();
	if($sql->rowCount() > 0){
		return $sql->fetch();
	}
}
function atualizaComServicos($conexao,$id){
	$sql = $conexao->prepare("UPDATE categorias SET com_servicos = 1 WHERE id = :id");
	$sql->bindValue(":id",$id);
	$sql->execute();
}

function insereCategoria($conexao,$nome){
	$sql = "INSERT INTO categorias SET nome = :nome";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":nome",$nome);
	$sql->execute();
	return $conexao->lastInsertId();
}

function alteraCategoria($conexao,$id,$nome){
	$sql = "UPDATE categorias SET nome = :nome WHERE id = :id";
	$sql = $conexao->prepare($sql);
	$sql->bindValue(":nome",$nome);
	$sql->bindValue(":id",$id);
	$sql->execute();
}

function deletarCategoria($conexao,$id){
	$sql = "DELETE FROM categorias WHERE id = :id";
	$sql = $conexao->prepare($sql);

	$sql->bindValue(":id",$id);
	$sql->execute();
}