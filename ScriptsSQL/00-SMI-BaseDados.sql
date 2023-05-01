# Create data base
CREATE DATABASE IF NOT EXISTS `smi` CHARACTER SET utf8 COLLATE utf8_unicode_ci;

# Create user accessing from localhost
CREATE USER 'smi'@'localhost' IDENTIFIED BY 'segredo';

# Create user accessing from remote hosts
CREATE USER 'smi'@'%' IDENTIFIED BY 'segredo';

# Grant usages
GRANT USAGE ON * . * TO 'smi'@'localhost' IDENTIFIED BY 'segredo' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
GRANT USAGE ON * . * TO 'smi'@'%' IDENTIFIED BY 'segredo' WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;

# Grant privileges
GRANT ALL PRIVILEGES ON `smi` . * TO 'smi'@'localhost';
GRANT ALL PRIVILEGES ON `smi` . * TO 'smi'@'%';
