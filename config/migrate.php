<?php

$host = DB_HOST;
$port = DB_PORT;
$dbname = DB_NAME;
$user = DB_USER;
$password = DB_PASS;

$dsn = "pgsql:host=$host;port={$port};dbname=$dbname;user=$user;password=$password";

$dbconn = new PDO($dsn);

$sql = file_get_contents('migrate.sql');

$result = $dbconn->exec($sql);

if ($result === false) {
    echo "An error occurred while executing the SQL.: " . $dbconn->errorInfo()[2];
} else {
    echo "SQL executed successfully!";
}

$dbconn = null;
