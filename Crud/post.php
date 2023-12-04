<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $db = "base_php";
    $user = "postgre";
    $pass = "";

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $var = $_POST['var'];
        $var2 = $_POST['var2'];
        $var3 = $_POST['var3'];
        $var4 = $_POST['var4'];

        $sql = 'INSERT INTO tabela (var, var2, var3, var4) VALUES(:var, :var2, :var3, :var4)';

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':var', $var, PDO::PARAM_STR);
        $stmt->bindParam(':var2', $var2, PDO::PARAM_STR);
        $stmt->bindParam(':var3', $var3, PDO::PARAM_STR);
        $stmt->bindParam(':var4', $var4, PDO::PARAM_STR);

        $stmt->execute();

        echo "Usuário inserido";
    }catch(PDOExeption $e){
        echo "Erro: " . $e->getMessage();
    }

}else{
    echo "Conexao nn estabelecida!";
}

?>