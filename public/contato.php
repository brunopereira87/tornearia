<?php

$title = "Contato";
$css = '<link rel="stylesheet" type="text/css" href="css/contato.css">';
require_once 'cabecalho.php';
?>
<div class="titulo">
        <div class="conteudo">
                <h2>Fale conosco</h2>
        </div>
</div>
<div class="conteudo">
    <p class="enunciado">Envie-nos suas mensagens através do formulário de contato abaixo. Você também pode falar conosoco através do nosso e-mail e do nosso telefone</p>
    <?php
        require_once 'alerts.php';
    ?>
    <div class="row formulario-contato">

        <div class="col-sm-8 formulario">
            <form method="POST" action="envia-email.php">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label>Nome*:</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label>Email*:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>		
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label>Telefone*:</label>
                            <input type="text" name="telefone" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="form-group">
                            <label>Empresa:</label>
                            <input type="text" name="empresa" class="form-control" placeholder="(Opcional)">
                        </div>		
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div>
                            <label>Cidade:</label>
                            <input type="text" name="cidade" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-3 col-sm-2">
                        <label>UF:</label>
                        <input type="text" name="uf" class="form-control">	
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Assunto*:</label>
                            <input type="text" name="assunto" class="form-control" required>
                        </div>		
                    </div>
                </div>
                <textarea class="mensagem" name="mensagem" placeholder="Digite sua mensagem"></textarea>
                <button class="btn btn-enviar" type="submit">Enviar</button>				
            </form>

        </div>
        <div class="col-sm-4 col-contato">
                <strong class="lbl-contato">Email:</strong>
                <a href="#">oftornearia@oft.com</a>
                <br>
                <strong class="lbl-contato">Telefone:</strong>
                <a href="#">(15) 3251-1960</a>
                <hr>
                <strong class="lbl-contato">Endereço:</strong>
                <a href="#">Rua Gato a Jato, 162, Centro</a>
                <br>
                <strong class="lbl-contato">Cidade/UF:</strong>
                <a href="#">Townsville/PR</a>
                <hr>
        </div>
    </div>

</div>
<?php
    require_once 'rodape.php';
?>