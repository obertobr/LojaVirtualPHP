<?php

function connection(){
    $dsn = "mysql:host=localhost;dbname=loja";
    $username = "root";
    $password = "";
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
    return $conn;
    
}

function verify() {
    if (!isset($_SESSION['cpf-cnpj'])) {
        header('Location: ../login.html');
        exit;
    }
}