-- TruckerWiew MySQL Setup
-- MySQL Command Line və ya phpMyAdmin-də işlət

-- 1. Database yarat
CREATE DATABASE IF NOT EXISTS truckerwiew CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 2. User yarat (əgər yoxdursa)
CREATE USER IF NOT EXISTS 'truckeruser'@'localhost' IDENTIFIED BY 'G7v!9pR2#xLq';
CREATE USER IF NOT EXISTS 'truckeruser'@'127.0.0.1' IDENTIFIED BY 'G7v!9pR2#xLq';

-- 3. İcazələr ver
GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'localhost';
GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'127.0.0.1';

-- 4. İcazələri tətbiq et
FLUSH PRIVILEGES;

-- 5. Database-i seç
USE truckerwiew;

-- Yoxlama
SELECT 'Database created successfully!' AS Status;
SHOW GRANTS FOR 'truckeruser'@'localhost';
