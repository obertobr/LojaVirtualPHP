<?php
include_once './bd.php';
session_start();

$cpf_cnpj = $_POST["cpf-cnpj"];
$senha = hash('sha256', $_POST['senha']);

$bd = connection();

$sql = "SELECT * FROM cliente WHERE cpf_cnpj_cli = '$cpf_cnpj' AND senha_cli = '$senha'";
$result = $bd->query($sql);

if ($result->rowCount() > 0) {
    $row = $result -> fetch();

    $_SESSION['nome'] = $row['nome_cli'];
    $_SESSION['cpf-cnpj'] = $row['cpf_cnpj_cli'];
    echo "login";
    header('Location: ../');
} else {
    echo "nao achado";
    header('Location: ../login.html');
}