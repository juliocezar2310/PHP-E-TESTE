<?php

use PHPUnit\Framework\TestCase;

class DatabaseInsertionTest extends TestCase
{
    public function testSuccessfulInsertion()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Simulando dados para inserção
            $id = 1;
            $var = "Value1";
            $var2 = "Value2";
            $var3 = "Value3";
            $var4 = "Value4";

            $sql = 'UPDATE tabela SET var = :var, var2 = :var2, var3 = :var3, var4 = :var4 WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':var', $var, PDO::PARAM_STR);
            $stmt->bindParam(':var2', $var2, PDO::PARAM_STR);
            $stmt->bindParam(':var3', $var3, PDO::PARAM_STR);
            $stmt->bindParam(':var4', $var4, PDO::PARAM_STR);

            $this->assertTrue($stmt->execute());
        } catch (PDOException $e) {
            $this->fail("Erro durante a inserção: " . $e->getMessage());
        }
    }

    public function testFailedInsertion()
    {
        $host = "localhost";
        $db = "base_php";
        $user = "root";
        $pass = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Simulando dados para inserção com um ID inválido
            $id = 'invalid'; // Isso deve resultar em um erro durante a execução

            $sql = 'UPDATE tabela SET var = :var, var2 = :var2, var3 = :var3, var4 = :var4 WHERE id = :id';

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            $this->assertFalse($stmt->execute());
        } catch (PDOException $e) {
            $this->assertStringContainsString("invalid input syntax for integer", $e->getMessage());
        }
    }
}
