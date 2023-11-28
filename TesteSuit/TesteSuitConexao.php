<?php

require_once 'TesteUnitario/TesteDeConexao/TesteDeConexao.php';

$suite = new PHPUnit\Framework\TestSuite();
$suite->addTestSuite(DatabaseConnectionTest::class);

$result = new PHPUnit\Framework\TestResult();
$suite->run($result);

echo "Number of tests: " . $result->count() . "\n";
echo "Number of failures: " . count($result->failures()) . "\n";
?>