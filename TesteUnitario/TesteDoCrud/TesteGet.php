<?php

use PHPUnit\Framework\TestCase;

class DatabaseGetTest extends TestCase
{
    public function testSuccessfulGet()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando um ID válido para busca
        $_GET['id'] = 1;

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_GET['id'];

            $sql = 'SELECT * FROM tabela WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $this->assertNotNull($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            $this->fail("Erro durante a busca: " . $e->getMessage());
        }
    }

    public function testFailedGet()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando um ID inválido para busca
        $_GET['id'] = 9999;

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_GET['id'];

            $sql = 'SELECT * FROM tabela WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $stmt->execute();

            $this->assertNull($stmt->fetch(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            $this->fail("Erro durante a busca: " . $e->getMessage());
        }
    }
}
?>