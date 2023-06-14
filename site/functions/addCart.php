<?php
include_once './bd.php';

verify();

$codigo = $_GET["codigo"];

$bd = connection();

$sql = "SELECT * FROM carrinho WHERE cpf_cnpj_cli = '".$_SESSION['nome']."' AND codigo_prod = '$codigo'";
$result = $bd->query($sql);

if ($result->rowCount() > 0) {
    $row = $result -> fetch();
    $sql = "UPDATE carrinho SET quantidade = ".($row["quantidade"]+1)." WHERE cpf_cnpj_cli = '".$_SESSION['nome']."' AND codigo_prod = '$codigo'";
} else {
    $sql = "INSERT INTO `carrinho` (`cpf_cnpj_cli`, `codigo_prod`, `quantidade`) VALUES ('".$_SESSION['nome']."', '$codigo', 1)";
}

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};