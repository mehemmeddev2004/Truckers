<?php
// Test database connection

require __DIR__.'/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "=== .env Database Config ===\n";
echo "DB_CONNECTION: " . ($_ENV['DB_CONNECTION'] ?? 'NOT SET') . "\n";
echo "DB_HOST: " . ($_ENV['DB_HOST'] ?? 'NOT SET') . "\n";
echo "DB_PORT: " . ($_ENV['DB_PORT'] ?? 'NOT SET') . "\n";
echo "DB_DATABASE: " . ($_ENV['DB_DATABASE'] ?? 'NOT SET') . "\n";
echo "DB_USERNAME: " . ($_ENV['DB_USERNAME'] ?? 'NOT SET') . "\n";
echo "DB_PASSWORD: " . (isset($_ENV['DB_PASSWORD']) ? '****' : 'NOT SET') . "\n";
echo "\n";

// Try MySQL connection
if ($_ENV['DB_CONNECTION'] === 'mysql') {
    try {
        $pdo = new PDO(
            "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']}",
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']
        );
        echo "✅ MySQL Connection Successful!\n";
        
        // Check if database exists
        $stmt = $pdo->query("SHOW DATABASES LIKE '{$_ENV['DB_DATABASE']}'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Database '{$_ENV['DB_DATABASE']}' exists!\n";
        } else {
            echo "❌ Database '{$_ENV['DB_DATABASE']}' does NOT exist!\n";
            echo "Run: CREATE DATABASE {$_ENV['DB_DATABASE']};\n";
        }
    } catch (PDOException $e) {
        echo "❌ MySQL Connection Failed: " . $e->getMessage() . "\n";
    }
} else {
    echo "⚠️  DB_CONNECTION is not 'mysql' - currently: {$_ENV['DB_CONNECTION']}\n";
}
