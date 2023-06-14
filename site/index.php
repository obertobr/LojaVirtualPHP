<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <header id="navBar">
            <span id="titulo">ZACARIASTORE.com</span>
            <div id="usuario">
                <?php
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
        <main id="produtos">
            <?php
                include_once './functions/bd.php';
                $bd = connection();
                $sql = "select * from produto";
                $result = $bd->query($sql);

                while ($products = $result->fetch(PDO::FETCH_ASSOC)){
                ?>
                <a href="#">
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