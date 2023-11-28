<?php

if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $host = "localhost";
    $db = "base_php";
    $user = "postgre";
    $pass = "";

    parse_str(file_get_contents("php://input"), $_PUT);

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_PUT['id'];
        $var = $_PUT['var'];
        $var2 = $_PUT['var2'];
        $var3 = $_PUT['var3'];
        $var4 = $_PUT['var4'];

        $sql = 'UPDATE tabela SET var = :var, var2 = :var2, var3 = :var3, var4 = :var4 WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':var', $var, PDO::PARAM_STR);
        $stmt->bindParam(':var2', $var2, PDO::PARAM_STR);
        $stmt->bindParam(':var3', $var3, PDO::PARAM_STR);
        $stmt->bindParam(':var4', $var4, PDO::PARAM_STR);

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo "Conexão não estabelecida!";
}
?>
