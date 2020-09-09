<?php

function createTabelProducts($conn)
{
    $sql = "CREATE TABLE IF NOT EXISTS products (
    idProd int(50) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nameProd varchar(50) NOT NULL,
    descriptionProd text NOT NULL,
    priceProd int(50) NOT NULL)";
    if ($conn->query($sql) != TRUE)
        echo "Erro na criação da tabela: " . $conn->error;
}

function createTabelUsers($conn)
{
    $sql = "CREATE TABLE IF NOT EXISTS users (
    emailUser varchar(50) NOT NULL PRIMARY KEY,
    nameUser varchar(50) NOT NULL,
    passwordUser varchar(50) NOT NULL,
    userType varchar(50) NOT NULL)";
    if ($conn->query($sql) != TRUE)
        echo "Erro na criação da tabela: " . $conn->error;
}

?>
