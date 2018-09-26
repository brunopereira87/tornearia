<?php
session_start();
if(isset($_POST['email']) && !empty($_POST['email'])){
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$telefone = $_POST['telefone'];
	$assunto = $_POST['assunto'];
	$mensagem = $_POST['mensagem'];

	if(isset($_POST['empresa'])){
            $empresa = $_POST['empresa'];
	}
	else{
            $empresa = "";
	}
	if(isset($_POST['cidade'])){
            $cidade = $_POST['cidade'];
	}
	else{
            $cidade = "";
            $estado = "";
	}

	if(isset($_POST['estado'])){
            $estado = $_POST['estado'];
	}
	else{
            $estado = "";
	}

	$para = "bruno_emanuel87@hotmail.com";
	$corpo = "Nome: ".$nome." - Email".$email."\n\nMensagem:".$mensagem;
	$cabecalho = "From: ".$email."\r\n".
                "Reply-To:"."\r\n";
                "X-Mailer: PHP/".phpversion();

	mail($para, $assunto, $corpo,$cabecalho);
	$_SESSION['success'] = 'Email enviado com sucesso!';
}
else{
    $_SESSION['erro'] = "Preencha todos os dados obrigatórios";

}

header("Location: contato.php");
exit;