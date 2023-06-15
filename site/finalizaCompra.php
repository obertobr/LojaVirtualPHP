<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compra Finalizada</title>
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <header id="navBar">
            <a href="./" id="titulo">ZACARIASTORE.com</a>
            <div id="usuario">
                <?php
                    session_start();
                    
                    if (!isset($_SESSION['cpf-cnpj'])) {
                        header('Location: ./');
                    } else {
                    ?>
                        <span><?= $_SESSION['nome']; ?></span>
                        <a href="carrinho.php"><img src="imgs/cart.svg"></a>
                    <?php
                    }
                ?>
            </div>
        </header>
        <?php
            $cpf_cnpj = $_SESSION["cpf-cnpj"];
            $nome = $_SESSION["nome"];
            
            include_once './functions/bd.php';
            $bd = connection();
            $sql = "SELECT * FROM compra co INNER JOIN cliente cl ON co.cpf_cnpj_cli = cl.cpf_cnpj_cli WHERE numero_compra = ".$_GET["id"];
            $result = $bd->query($sql);
            $row = $result->fetch();
        ?>
        <table id="danfe">
            <tbody>
                <tr>
                    <th colspan="4">
                        <span>Nome</span><br>
                        <div>
                            <span><?=$row["nome_cli"]?></span>
                        </div>
                    </th>
                    <th colspan="3">
                        <span>Cpf/Cnpj</span><br>
                        <div>
                            <span><?=$row["cpf_cnpj_cli"]?></span>
                        </div>
                    </th>
                    <th>
                        <span>Data</span><br>
                        <div>
                            <span><?=$row["data"]?></span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>
                        <span>Cep</span><br>
                        <div>
                            <span><?=$row["cep_cli"]?></span>
                        </div>
                    </th>
                    <th colspan="2">
                        <span>Endereco</span><br>
                        <div>
                            <span><?=$row["endereco_cli"]?></span>
                        </div>
                    </th>
                    <th>
                        <span>Estado</span><br>
                        <div>
                            <span><?=$row["estado_cli"]?></span>
                        </div>
                    </th>
                    <th colspan="2">
                        <span>Cidade</span><br>
                        <div>
                            <span><?=$row["cidade_cli"]?></span>
                        </div>
                    </th>
                    <th colspan="2">
                        <span>Bairro</span><br>
                        <div>
                            <span><?=$row["bairro_cli"]?></span>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th colspan="8">Produtos</th>
                </tr>
                <?php
                    $sql = "SELECT *, po.quantidade qtd FROM possui po INNER JOIN produto pr ON po.codigo_prod = pr.codigo_prod WHERE po.numero_compra = ".$_GET["id"];
                    $result = $bd->query($sql);
                    while ($products = $result->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <th>
                            <span>Nome</span><br>
                            <div>
                                <span><?=$products["nome_pro"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Descrição</span><br>
                            <div>
                                <span><?=$products["descricao"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Peso</span><br>
                            <div>
                                <span><?=$products["peso"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Dimensões</span><br>
                            <div>
                                <span><?=$products["dimensoes"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Unidade venda</span><br>
                            <div>
                                <span><?=$products["unidade_Venda"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Valor unitario</span><br>
                            <div>
                                <span>R$<?=$products["valor_unitario"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Quantidade</span><br>
                            <div>
                                <span><?=$products["qtd"]?></span>
                            </div>
                        </th>
                        <th>
                            <span>Valor total</span><br>
                            <div>
                                <span>R$<?=$products["valor_unitario"]*$products["qtd"]?></span>
                            </div>
                        </th>
                    </tr>
                    <?php
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>