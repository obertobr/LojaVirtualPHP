<?php
include_once './bd.php';

session_start();

verify();

$bd = connection();

$sql = "SELECT SUM(p.valor_unitario * c.quantidade) valor FROM carrinho c INNER JOIN produto p ON c.codigo_prod = p.codigo_prod WHERE cpf_cnpj_cli = ".$_SESSION['cpf-cnpj'];
$result = $bd->query($sql);

$row = $result -> fetch();
$valor = $row["valor"];

$sql = "INSERT INTO `compra` (`numero_compra`, `data`, `valor_comissao`, `valor_transporte`, `cpf_cnpj_vend`, `cpf_cnpj_transp`, `cpf_cnpj_cli`) VALUES ('', '".date("Y-m-d")."', '".($valor*0.1)."', '".($valor*0.15)."', '21312341232', '2983012341', '".$_SESSION['cpf-cnpj']."')";

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $last_id = $bd->lastInsertId();
    $bd->commit();
} else {
    $bd->rollBack();
};

$sql = "SELECT *, c.quantidade qtd FROM carrinho c INNER JOIN produto p ON c.codigo_prod = p.codigo_prod WHERE cpf_cnpj_cli = ".$_SESSION['cpf-cnpj'];
$result = $bd->query($sql);

$sql = "";
while($products = $result->fetch(PDO::FETCH_ASSOC)){
    $sql = $sql . "INSERT INTO `possui` (`numero_compra`, `codigo_prod`, `valor`, `quantidade`) VALUES ($last_id, '".$products["codigo_prod"]."', '".$products["valor_unitario"]."', '".$products["qtd"]."');";
    $sql = $sql . "UPDATE produto SET quantidade=quantidade-".$products["qtd"]." WHERE codigo_prod =".$products["codigo_prod"];
}

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();

    $sql = "DELETE FROM carrinho WHERE cpf_cnpj_cli = ".$_SESSION['cpf-cnpj'];
    $result = $bd->query($sql);
} else {
    $bd->rollBack();
};

header('Location: ../finalizaCompra.php?id='.$last_id);

