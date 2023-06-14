<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <header id="navBar">
            <a href="./" id="titulo">ZACARIASTORE.com</a>
            <div id="usuario">
                <?php
                    session_start();
                    
                    if (!isset($_SESSION['cpf-cnpj'])) {
                    ?>
                    <span><a href="#">Entrar</a> / <a href="cadastro.html">Cadastrar</a></span>
                    <?php
                    } else {
                    ?>
                    <span><?= $_SESSION['nome']; ?></span>
                    <?php
                    }
                ?>
            </div>
        </header>
        <main id="produto">
            <?php
                include_once './functions/bd.php';
                $bd = connection();
                $sql = "select * from produto where codigo_prod = ".$_GET["id"];
                $result = $bd->query($sql);

                $product = $result -> fetch();
            ?>

            <div>
                <img src="imgs/products/<?=$product["codigo_prod"]; ?>">
            </div>
            <div id="infos">
                <span id="nome"><?=$product["nome_pro"]; ?></span>
                <div class="line"></div>
                <span id="valor">R$<?=$product["valor_unitario"]; ?></span>
                <div>
                    <input id="addCarrinho" type="button" value="Adicionar ao carrinho">
                    <span id="quantidade"><?=$product["quantidade"]; ?> itens disponiveis</span>
                </div>
                <div class="line"></div>
                <span class="sub-titulo">Descrição</span>
                <span><?=$product["descricao"]; ?></span>
                <div class="line"></div>
                <span class="sub-titulo">Especificações</span>
                <span>Peso: <?=$product["peso"]; ?></span>
                <span>Dimensões: <?=$product["dimensoes"]; ?></span>
                <span>Unidade da venda: <?=$product["unidade_Venda"]; ?></span>
            </div>
        </main>
    </body>
</html>