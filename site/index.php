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
                    <span><a href="login.html">Entrar</a> / <a href="cadastro.html">Cadastrar</a></span>
                    <?php
                    } else {
                    ?>
                    <span><?= $_SESSION['nome']; ?></span>
                    <a href="carrinho.php"><img src="imgs/cart.svg"></a>
                    <?php
                    }
                ?>
            </div>
        </header>
        <main id="produtos">
            <?php
                include_once './functions/bd.php';
                $bd = connection();
                $sql = "select * from produto";
                $result = $bd->query($sql);

                while ($products = $result->fetch(PDO::FETCH_ASSOC)){
                ?>
                <a href="produto.php?id=<?=$products["codigo_prod"]; ?>">
                    <div id="item_produto">
                        <img src="imgs/products/<?=$products["codigo_prod"]; ?>" id="img_produto" alt="Imagem do produto">
                        <span id="nome_produto"><?=$products["nome_pro"]; ?></span>
                        <span id="valor_produto">R$<?=$products["valor_unitario"]; ?></span>
                    </div>
                </a>
                <?php
                    }
            ?>
        </main>
    </body>
</html>