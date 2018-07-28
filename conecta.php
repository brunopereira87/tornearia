<?php

//$conexao = mysqli_connect('localhost','root','','tornearia');

try{
	$host = "localhost";
	$dbname = "tornearia";
	$dbuser = "root";
	$dbpass = "";
	$conexao = new PDO("mysql:dbname=".$dbname.";host=".$host,$dbuser,$dbpass);
	$conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	die($e->getMessage());
}

