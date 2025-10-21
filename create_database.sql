-- TruckerWiew Database və User yaratma
-- MySQL-də işlətmək üçün

-- Database yarat
CREATE DATABASE IF NOT EXISTS truckerwiew CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- User yarat və icazələr ver
CREATE USER IF NOT EXISTS 'truckeruser'@'localhost' IDENTIFIED BY 'G7v!9pR2#xLq';
CREATE USER IF NOT EXISTS 'truckeruser'@'127.0.0.1' IDENTIFIED BY 'G7v!9pR2#xLq';
CREATE USER IF NOT EXISTS 'truckeruser'@'%' IDENTIFIED BY 'G7v!9pR2#xLq';

-- İcazələr ver
GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'localhost';
GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'127.0.0.1';
GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'%';

-- İcazələri tətbiq et
FLUSH PRIVILEGES;

-- Yoxla
SELECT User, Host FROM mysql.user WHERE User = 'truckeruser';
SHOW DATABASES LIKE 'truckerwiew';
