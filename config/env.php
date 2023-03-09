<?php

$env_file = fopen('.env', 'r');

$env_data = [];

while (($line = fgets($env_file)) !== false) {
    $line = trim($line);

    if (strpos($line, '=') !== false) {
        $parts = explode('=', $line, 2);
        $name = trim($parts[0]);
        $value = trim($parts[1]);

        if (substr($value, 0, 1) == '"' && substr($value, -1) == '"') {
            $value = substr($value, 1, -1);
        }

        $env_data[$name] = $value;
    }
}

fclose($env_file);

$host = $env_data['DB_HOST'];
$port = $env_data['DB_PORT'];
$dbname = $env_data['DB_NAME'];
$user = $env_data['DB_USER'];
$password = $env_data['DB_PASS'];

$dsn = "pgsql:host=$host;port={$port};dbname=$dbname;user=$user;password=$password";
$dbconn = new PDO($dsn);
