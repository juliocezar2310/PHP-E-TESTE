<?php

use PHPUnit\Framework\TestCase;

class DatabaseDeleteTest extends TestCase
{
    public function testSuccessfulDelete()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando dados para exclusão
        $_DELETE = [
            'id' => 1,
        ];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_DELETE['id'];

            $sql = 'DELETE FROM tabela WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $this->assertTrue($stmt->execute());
        } catch (PDOException $e) {
            $this->fail("Erro durante a exclusão: " . $e->getMessage());
        }
    }

    public function testFailedDelete()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando dados para exclusão com um ID inválido
        $_DELETE = [
            'id' => 'invalid',
        ];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $id = $_DELETE['id'];

            $sql = 'DELETE FROM tabela WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $this->assertFalse($stmt->execute());
        } catch (PDOException $e) {
            $this->assertStringContainsString("invalid input syntax for integer", $e->getMessage());
        }
    }
}
