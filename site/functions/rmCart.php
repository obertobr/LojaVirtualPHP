<?php
include_once './bd.php';

session_start();
verify();

$codigo = $_GET["codigo"];

$sql = "SELECT * FROM carrinho WHERE cpf_cnpj_cli = '".$_SESSION['cpf-cnpj']."' AND codigo_prod = '$codigo'";
$result = $bd->query($sql);

if ($result->rowCount() > 0) {
    $row = $result -> fetch();
    if($row["quantidade"] > 1){
        $sql = "UPDATE carrinho SET quantidade = ".($row["quantidade"]-1)." WHERE cpf_cnpj_cli = '".$_SESSION['cpf-cnpj']."' AND codigo_prod = '$codigo'";
    } else {
        $sql = "DELETE carrinho WHERE cpf_cnpj_cli = '".$_SESSION['cpf-cnpj']."' AND codigo_prod = '$codigo'";
    }
}

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};