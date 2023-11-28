<?php

use PHPUnit\Framework\TestCase;

class DatabaseConnectionTest extends TestCase
{
    public function testSuccessfulDatabaseConnection()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "postgre";
        $pass = "";

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
            $this->assertInstanceOf(PDO::class, $pdo);
        } catch (PDOException $e) {
            $this->fail("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function testFailedDatabaseConnection()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "user_invalido";
        $pass = "senha_invalida";

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
            $this->fail("A conexão deveria ter falhado, mas foi bem-sucedida.");
        } catch (PDOException $e) {
            $this->assertStringContainsString("does not exist", $e->getMessage());
        }
    }
}
?>