<html>
    <head>
        <link rel="stylesheet" href="style/style.css">
        <script src="script/script.js"></script>
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
                    <a href="carrinho.php"><img src="imgs/cart.svg"></a>
                    <?php
                    }
                ?>
            </div>
        </header>
        <form id="produto" action="functions/addProduct.php" method="post" enctype="multipart/form-data">
            <form>
            <div>
                <label for="file-upload" class="custom-file-upload">
                    <img src="imgs/importImg.png" for="file-upload" id="importImg">
                </label>
                <input id="file-upload" name="imagem" type="file" hidden onchange="getImg(event)"/>
            </div>
            <div id="infos">
                <span id="nome">Nome: <input type="text" name="nome"></span>
                <div class="line"></div>
                <span id="valor">Valor: R$<input type="text" name="valor"></span>
                <span>quantidade: <input type="text" name="quantidade"></span>
                <div class="line"></div>
                <span class="sub-titulo">Descrição</span>
                <input type="text" name="descricao">
                <div class="line"></div>
                <span class="sub-titulo">Especificações</span>
                <span>Peso: <input type="text" name="peso"></span>
                <span>Dimensões: <input type="text" name="dimensoes"></span>
                <span>Unidade da venda: <input type="text" name="unidade"></span>
                <input type="submit" value="CRIAR">
            </div>
        </form>
    </body>
</html>