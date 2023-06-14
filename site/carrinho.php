<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <header id="navBar">
            <a href="./" id="titulo">ZACARIASTORE.com</a>
            <div id="usuario">
                <?php
                    include_once './functions/bd.php';
                    session_start();
                    verify();
                    
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
        <main id="carrinho">
            <span>CARRINHO</span>
            <?php
                $bd = connection();
                $sql = "SELECT *, c.quantidade qtd FROM carrinho c INNER JOIN produto p ON c.codigo_prod = p.codigo_prod WHERE cpf_cnpj_cli = ".$_SESSION['cpf-cnpj'];
                $result = $bd->query($sql);

                while ($products = $result->fetch(PDO::FETCH_ASSOC)){
                ?>
                <div id="produto_carrinho">
                    <img src="imgs/products/<?=$products["codigo_prod"]; ?>">
                    <div>
                        <span><?=$products["nome_pro"]; ?></span>
                        <div id="quantida_produto_carrinho">
                            <span>Valor: R$<?=$products["valor_unitario"]; ?></span>
                            <div>
                                <span>Quantidade:</span>
                                <a href="functions/rmCart.php?codigo=<?=$products["codigo_prod"]; ?>"><input type="button" value="-"></a>
                                <span><?=$products["qtd"]; ?></span>
                                <a href="functions/addCart.php?codigo=<?=$products["codigo_prod"]; ?>"><input type="button" value="+"></a>
                            </div>
                            <span>Valor Total: R$<?=$products["valor_unitario"]*$products["qtd"]; ?></span>
                        </div>
                    </div>
                </div>
                <?php
                }
            ?>
            <div class="line"></div>
            <div>
                <a href="functions/buy.php" id="comprar">COMPRAR</a>
                <?php
                $bd = connection();
                $sql = "SELECT SUM(p.valor_unitario * c.quantidade) valor FROM carrinho c INNER JOIN produto p ON c.codigo_prod = p.codigo_prod WHERE cpf_cnpj_cli = ".$_SESSION['cpf-cnpj'];
                $result = $bd->query($sql);

                $row = $result -> fetch();
                ?>
                <div>
                    <span id="Total_produto">Produtos: R$<?=$row["valor"]; ?></span>
                    <span id="Total_produto">Frete: R$<?=$row["valor"]*0.14; ?></span>
                    <div class="line"></div>
                    <span id="Total_produto">Total: R$<?=$row["valor"]*0.14+$row["valor"]; ?></span>
                </div>
            </div>
        </main>
    </body>
</html>