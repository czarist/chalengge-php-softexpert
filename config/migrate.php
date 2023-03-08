<?php

require_once 'database.php';

use config\Database;

$pdo = Database::getInstance()->getConnection();

$sql = file_get_contents('migrate.sql');

// Executa a query
$pdo->exec($sql);

echo "Arquivo SQL executado com sucesso!";
