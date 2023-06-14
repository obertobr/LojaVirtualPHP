<?php
include_once './bd.php';

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$peso = $_POST["peso"];
$dimensoes = $_POST["dimensoes"];
$unidade = $_POST["unidade"];

$bd = connection();

$sql = "INSERT INTO `produto` (`codigo_prod`, `nome_pro`, `descricao`, `valor_unitario`, `quantidade`, `peso`, `dimensoes`, `unidade_Venda`) VALUES (NULL, '$nome', '$descricao', '$valor', '$quantidade', '$peso', '$dimensoes', '$unidade')";

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $last_id = $bd->lastInsertId();
    echo "New record created successfully. Last inserted ID is: " . $last_id;

    $pasta_dir = "../imgs/products/";
    $arquivo_nome = $pasta_dir . $last_id;
    
    move_uploaded_file($_FILES["imagem"]['tmp_name'], $arquivo_nome);

    $bd->commit();
} else {
    $bd->rollBack();
};