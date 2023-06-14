<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra Finalizada</title>
</head>
<body>
    <?php
        session_start();
        $cpf_cnpj = $_SESSION["cpf-cnpj"];
        $nome = $_SESSION["nome"];
        
        include_once './functions/bd.php';
        $bd = connection();
        $sql = "SELECT * FROM possui where numero_compra = ".$_GET["id"];
        $result = $bd->query($sql);

        echo '<thead>';
        echo    '<tr>';
        echo        '<th><label for="cpf-cnpj">CPF/CNPJ: </label></th>';
        echo        '<th><label for="cpf-cnpj">'.$cpf_cnpj.'</label></th>';
        echo    '</tr>';
        echo    '<tr>';
        echo        '<th><label for="nome">Nome: </label></th>';
        echo        '<th><label for="nome">'.$nome.'</label></th>';
        echo    '</tr>';
        echo '</thead>';

        while ($products = $result->fetch(PDO::FETCH_ASSOC)){
            echo '<tbody>';
            echo    '<tr>';
            echo        '<th><label for=""produto">Produtos: </th>';
            echo        '<th><label for=""produto">'.$products["codigo_prod"].' </th>';
            echo    '</tr>';
            echo '</tbody>';
        }
        

    ?>
</body>
</html>