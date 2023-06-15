<?php
include_once './bd.php';

$id = $_POST["id"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$valor = $_POST["valor"];
$quantidade = $_POST["quantidade"];
$peso = $_POST["peso"];
$dimensoes = $_POST["dimensoes"];
$unidade = $_POST["unidade"];

$bd = connection();

$sql = "UPDATE produto SET nome_pro = '$nome', descricao = '$descricao', valor_unitario = '$valor', quantidade = '$quantidade', peso = '$peso', dimensoes = '$dimensoes', unidade_Venda = '$unidade' WHERE codigo_prod = '$id'";

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};

header('Location: ' . $_SERVER['HTTP_REFERER']);