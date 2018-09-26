<?php

session_start();
require_once 'conecta.php';

function logarUsuario($email,$senha,$pdo){

	$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":email",$email);
	$sql->bindValue(":senha",$senha);

	$sql->execute();

	if ($sql->rowCount() > 0) {
		$sql = $sql->fetch();
		$_SESSION['logado'] = $sql['id'];
		
		header("Location:painel-controle.php");
		exit;
	}
	else{
		$_SESSION['erro'] = "Login ou senha inválidos...";
	}
}
function deslogar(){
	unset($_SESSION['logado']);
}
function getNivel($id,$pdo){

	$sql = "SELECT nivel_usuario_id FROM usuarios WHERE id = :id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();

	if($sql->rowCount() > 0){
		$nivel = $sql->fetch();
		return $nivel['nivel_usuario_id'];
	}
	else{
		$_SESSION['erro'] = "Usuário não encontrado";
	}
}
function verificaLogin(){
    if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
        return true;
    }

    return false;
}
function inserirUsuario($pdo,$nome,$username,$email,$senha,$imagem){
    $sql = "INSERT INTO usuarios (nivel_usuario_id,nome,username, email, senha,imagem) VALUES (2,:nome,:username,:email,:senha,:imagem)";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":nome",$nome);
    $sql->bindValue(":username",$username);
    $sql->bindValue(":email",$email);
    $sql->bindValue(":senha",$senha);
    $sql->bindValue(":imagem",$imagem);

    $sql->execute();
}
function alterarUsuario($pdo,$nome,$username,$email,$senha,$imagem,$id){
	$sql = "UPDATE usuarios SET nome = :nome,username = :username , email = :email, senha = :senha ,imagem = :imagem WHERE id = :id ";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":nome",$nome);
	$sql->bindValue(":username",$username);
	$sql->bindValue(":email",$email);
	$sql->bindValue(":senha",$senha);
	$sql->bindValue(":imagem",$imagem);
	$sql->bindValue(":id",$id);

	$sql->execute();
}
function listaFuncionarios($pdo){
	$sql = "SELECT * FROM usuarios WHERE nivel_usuario_id = 2";
	$sql = $pdo->query($sql);
	
	$sql->execute();

	if($sql->rowCount() > 0){
		return $sql->fetchAll();
	}
	else{
		$_SESSION['erro'] = "Não há nenhum funcionário cadastrado!";
		header("Location: painel-controle.php");
		exit;
	}
}
function buscaUsuario($pdo,$id){
	$sql = "SELECT * FROM usuarios WHERE id = :id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();

	if($sql->rowCount() > 0){
		return $sql->fetch();
	}
	else{
            $_SESSION['erro'] = "Você não tem permissão para acessar essa página!";
            header("Location: login.php");
            exit;
	}
}
function deletarUsuario($pdo,$id){
	$sql = "DELETE FROM usuarios WHERE id = :id";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":id",$id);
	$sql->execute();
}

function autorizaAdmin($pdo){
    if(!verificaLogin()){
        header('Location:index.php');
        exit;
    }
    if(getNivel($_SESSION['logado'], $pdo) != 1){
        header('Location:painel-controle.php');
        exit;
    }
}