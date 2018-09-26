<?php

    $css = '<link rel="stylesheet" type="text/css" href="css/painel.css">';
    $title = "Painel de Controle";
    require_once 'cabecalho.php';
    require_once '../conecta.php';
    require_once '../banco-servicos.php';
    require_once '../banco-usuario.php';
    require_once '../banco-categoria.php';

    if(!isset($_SESSION['logado']) || empty($_SESSION['logado'])){
        header("location: index.php");
        exit;
    }

    if(isset($_GET['p']) && $_GET['p'] > 0){
        $pagina = intval($_GET['p']);
    }
    else{
        $pagina = 1;
    }
    $limite = 10;
    $offset = ($pagina*$limite) - $limite;

    $quantidade_servicos = count(listaServicos($conexao));
    $total_paginas_servicos = ceil($quantidade_servicos/$limite);
    $servicos = listaServicosPaginacao($conexao,$offset,$limite) ;

    $quantidade_categorias = count(listaCategorias($conexao));
    $total_paginas_categorias = ceil($quantidade_categorias/$limite);
    $categorias = listaCategoriasPaginacao($conexao,$offset,$limite) ;

?>
    <div class="conteudo">
        <?php
            if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
                    echo "<p class='alert alert-success'>".$_SESSION['success']."</p>";
                    unset($_SESSION['success']);
            }
            if(isset($_SESSION['erro']) && !empty($_SESSION['erro'])){
                    echo "<p class='alert alert-danger'>".$_SESSION['erro']."</p>";
                    unset($_SESSION['erro']);
            }

        ?>
            <ul class="nav nav-tabs" id="myTabs" role='tablist'>
                <li class='active' role="presentation"><a href="#servicos" aria-controls="servicos" data-toggle="tab" role="tab">Serviços</a></li>
                <?php if(getNivel($_SESSION['logado'],$conexao) == 1) : ?>
                    <li role="presentation"><a href="#funcionarios" aria-controls="funcionarios" data-toggle="tab" role="tab">Funcionários</a></li>
                <?php
                    endif;
                ?>
                <li role="presentation"><a href="#categorias" aria-controls="categorias" data-toggle="tab" role="tab">Categorias</a></li>
            </ul>


        <section class="tab-content">
            <article id="servicos" class="tab-pane active" role="tabpanel">
                <h1>Serviços</h1>
                <a href="adiciona-servico.php" class="btn btn-adiciona">Adicionar Serviço</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                            foreach($servicos as $servico) : ?>
                            <tr>
                                <td><?=$servico['nome']?></td>
                                <td><?=$servico['descricao']?></td>
                                <td><?=$servico['categoria']?></td>
                                <td>
                                    <div class="acoes">
                                        <a href="altera-servico.php?id_servico=<?=$servico['id']?>" class="btn btn-editar">Editar</a>
                                        <a href="confirma-excluir-servico.php?id_servico=<?=$servico['id']?>" class="btn btn-excluir">Excluir</a>
                                    </div>

                                </td>

                            </tr>
                        <?php
                                endforeach;
                        ?>

                    </tbody>			
                </table>
                <?php
                    for($i=1;$i<=$total_paginas_servicos;$i++) :?>
                        <a href="painel-controle.php?p=<?=$i?>#servicos">[<?=$i?>]</a>
                <?php
                    endfor;
                ?>
        </article>
            <?php
                    if(getNivel($_SESSION['logado'],$conexao) == 1) {
                            $funcionarios = listaFuncionarios($conexao);
                    ?>
                            <article id="funcionarios" class="tab-pane" role="tabpanel">
                                    <h1>Funcionários</h1>
                                    <a href="cadastrar.php" class="btn btn-adiciona">Cadastrar Funcionário</a>
                                    <table class="table table-striped">
                                            <thead>
                                                    <tr>
                                                            <th>Foto</th>
                                                            <th>Nome Completo</th>
                                                            <th>Nome de usuário</th>
                                                            <th>Email</th>
                                                            <th>Ações</th>
                                                    </tr>

                                            </thead>
                                            <tbody>
                                                    <?php
                                                            foreach($funcionarios as $funcionario) : ?>
                                                            <tr>
                                                                    <td><img src="<?=$funcionario['imagem']?>" class="thumb-funcionario"></td>
                                                                    <td><?=$funcionario['nome']?></td>
                                                                    <td><?=$funcionario['username']?></td>
                                                                    <td><?=$funcionario['email']?></td>
                                                                    <td>
                                                                            <div class="acoes">
                                                                                    <a href="altera-usuario.php?id=<?=$funcionario['id']?>" class="btn btn-editar">Editar</a>
                                                                                    <a href="deletar-usuario.php?id=<?=$funcionario['id']?>" class="btn btn-excluir">Excluir</a>
                                                                            </div>

                                                                    </td>

                                                            </tr>
                                                    <?php
                                                            endforeach;
                                                    ?>

                                            </tbody>			
                                    </table>
                            </article>
            <?php
                    };
            ?>
            <article id="categorias" class="tab-pane" role="tabpanel">
                <h1>Categorias</h1>
                <a class="btn btn-adiciona" id="btn_add_categoria">Adicionar Categoria</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                            foreach($categorias as $categoria) : ?>
                                <tr>
                                    <td><?=$categoria['nome']?></td>
                                    <td>
                                        <div class="acoes">
                                            <a onclick = "alteraCategoria(<?=$categoria['id']?>,'<?=$categoria['nome']?>')" class="btn btn-editar" >Editar</a>
                                            <a href="excluir-categoria.php?id_categoria=<?=$categoria['id']?>" class="btn btn-excluir">Excluir</a>
                                        </div>

                                    </td>

                                </tr>
                        <?php
                            endforeach;
                        ?>

                    </tbody>			
                </table>
                <?php
                    for($i=1;$i<=$total_paginas_categorias;$i++) :?>
                        <a href="painel-controle.php?p=<?=$i?>#categorias">[<?=$i?>]</a>
                <?php
                    endfor;
                ?>
            </article>


        </section>

    </div>
<?php
    require_once 'rodape.php';
?>