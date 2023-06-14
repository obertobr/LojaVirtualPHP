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
    $bd->commit();
} else {
    $bd->rollBack();
};