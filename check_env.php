<?php

// Direct file read to check .env content
$envFile = __DIR__ . '/.env';

if (!file_exists($envFile)) {
    die("❌ .env file not found!\n");
}

echo "Reading .env file directly...\n\n";

$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($lines as $line) {
    if (strpos(trim($line), 'DB_') === 0) {
        echo $line . "\n";
    }
}
