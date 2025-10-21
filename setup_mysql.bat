@echo off
echo Creating MySQL Database...
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS truckerwiew CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root -p -e "CREATE USER IF NOT EXISTS 'truckeruser'@'localhost' IDENTIFIED BY 'G7v!9pR2#xLq';"
mysql -u root -p -e "GRANT ALL PRIVILEGES ON truckerwiew.* TO 'truckeruser'@'localhost';"
mysql -u root -p -e "FLUSH PRIVILEGES;"
echo Done!
pause
