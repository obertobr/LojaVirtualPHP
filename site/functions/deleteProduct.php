<?php
include_once './bd.php';

$id = $_GET["id"];

$bd = connection();

$sql = "DELETE FROM produto WHERE codigo_prod = '$id'";

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};

header('Location: ../ARProdutos.php');