<?php
include_once './bd.php';

session_start();

verify();

$codigo = $_GET["codigo"];

$bd = connection();

$sql = "SELECT * FROM produto WHERE codigo_prod = '$codigo'";
$result = $bd->query($sql);
$row = $result -> fetch();
$quantidade = $row["quantidade"];


$sql = "SELECT * FROM carrinho WHERE cpf_cnpj_cli = '".$_SESSION['cpf-cnpj']."' AND codigo_prod = '$codigo'";
$result = $bd->query($sql);

if ($result->rowCount() > 0) {
    $row = $result -> fetch();
    if($row["quantidade"] < $quantidade){
        $sql = "UPDATE carrinho SET quantidade = ".($row["quantidade"]+1)." WHERE cpf_cnpj_cli = '".$_SESSION['cpf-cnpj']."' AND codigo_prod = '$codigo'";
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
} else {
    $sql = "INSERT INTO `carrinho` (`cpf_cnpj_cli`, `codigo_prod`, `quantidade`) VALUES ('".$_SESSION['cpf-cnpj']."', '$codigo', 1)";
}

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};

header('Location: ' . $_SERVER['HTTP_REFERER']);