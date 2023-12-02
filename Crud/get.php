<?php

$var = $var2 = $var3 = $var4 = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $db = "base_php";
    $user = "postgre";
    $pass = "";

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];

        $sql = 'SELECT * FROM tabela WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $var = $row['var'];
            $var2 = $row['var2'];
            $var3 = $row['var3'];
            $var4 = $row['var4'];
        }else{
            $var = $var2 = $var3 = $var4 = '';
        }
    }catch(PDOExeption $e){
        echo "Erro: " . $e->getMessage();
    }

?>