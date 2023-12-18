<?php

use PHPUnit\Framework\TestCase;

class DatabaseUpdateTest extends TestCase
{
    public function testSuccessfulUpdate()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando dados para atualização
        $_PUT = [
            'id' => 1,
            'var' => 'NewValue1',
            'var2' => 'NewValue2',
            'var3' => 'NewValue3',
            'var4' => 'NewValue4'
        ];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

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

            $this->assertTrue($stmt->execute());
        } catch (PDOException $e) {
            $this->fail("Erro durante a atualização: " . $e->getMessage());
        }
    }

    public function testFailedUpdate()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        // Simulando dados para atualização com um ID inválido
        $_PUT = [
            'id' => 'invalid',
            'var' => 'NewValue1',
            'var2' => 'NewValue2',
            'var3' => 'NewValue3',
            'var4' => 'NewValue4'
        ];

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

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

            $this->assertFalse($stmt->execute());
        } catch (PDOException $e) {
            $this->assertStringContainsString("invalid input syntax for integer", $e->getMessage());
        }
    }
}
?>