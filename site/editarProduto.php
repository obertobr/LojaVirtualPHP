<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
        <script src="script/script.js"></script>
        <title>Editar produto</title>
    </head>
    <body>
        <header id="navBar">
            <a href="./ARProdutos.php" id="titulo">ZACARIASTORE.com</a>
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
                    <a href="carrinho.php"><img src="imgs/cart.svg"></a>
                    <?php
                    }
                ?>
            </div>
        </header>
        <form id="produto" action="functions/editProduct.php" method="post">
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
                <span id="nome">Nome: <input type="text" name="nome" value="<?=$product["nome_pro"]; ?>"></span>
                <div class="line"></div>
                <span id="valor">Valor: R$<input type="text" name="valor" value="<?=$product["valor_unitario"]; ?>"></span>
                <span>quantidade: <input type="text" name="quantidade" value="<?=$product["quantidade"]; ?>"></span>
                <div class="line"></div>
                <span class="sub-titulo">Descrição</span>
                <input type="text" name="descricao" value="<?=$product["descricao"]; ?>">
                <div class="line"></div>
                <span class="sub-titulo">Especificações</span>
                <span>Peso: <input type="text" name="peso" value="<?=$product["peso"]; ?>"></span>
                <span>Dimensões: <input type="text" name="dimensoes" value="<?=$product["dimensoes"]; ?>"></span>
                <span>Unidade da venda: <input type="text" name="unidade" value="<?=$product["unidade_Venda"]; ?>"></span>
                <input type="hidden" name="id" value="<?=$product["codigo_prod"]; ?>">
                <input type="submit" value="SALVAR">
            </div>
        </form>
        <button onclick="if(confirm('Tem certeza que deseja deletar o produto ?')){window.location.href = 'functions/deleteProduct.php?id=<?=$product["codigo_prod"]; ?>'}" id="deletarProd">DELETAR PRODUTO</button>
    </body>
</html>