<?php
require_once 'env.php';

$sql = file_get_contents('sql/seeds.sql');

$result = $dbconn->exec($sql);

if ($result === false) {
    echo "An error occurred while executing the SQL.: " . $dbconn->errorInfo()[2];
} else {
    echo "SQL executed successfully!";
}

$dbconn = null;
