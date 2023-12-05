<?php

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $host = "localhost";
    $db = "base_php";
    $user = "postgre";
    $pass = "";

    parse_str(file_get_contents("php://input"), $_DELETE);

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_DELETE['id'];

        $sql = 'DELETE FROM tabela WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        echo "Exclusão bem-sucedida!";
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Conexão não estabelecida!";
}
