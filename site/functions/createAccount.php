<?php
include_once './bd.php';

session_start();

$cpf_cnpj = $_POST["cpf-cnpj"];
$nome = $_POST["nome"];
$numero = $_POST["numero"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$cep = $_POST["cep"];
$estado = $_POST["estado"];
$endereco = $_POST["endereco"];
$senha = hash('sha256', $_POST['senha']);

$bd = connection();

$sql = "INSERT INTO `cliente` (`cpf_cnpj_cli`, `nome_cli`, `numero_cli`, `bairro_cli`, `cidade_cli`, `cep_cli`, `estado_cli`, `endereco_cli`, `senha_cli`) 
        VALUES ('$cpf_cnpj', '$nome', '$numero', '$bairro', '$cidade', '$cep', '$estado', '$endereco', '$senha')";

echo $sql;

$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1){
    $bd->commit();
} else {
    $bd->rollBack();
};

$_SESSION['nome'] = $nome;
$_SESSION['cpf-cnpj'] = $cpf_cnpj;

header('Location: ../');