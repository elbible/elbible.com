1. Modify Configuration 
 1) Encription Key
   - path : application\config\config.php 
   - $config['encryption_key'] = 'elbible_encryption_key';  // modify encryption key when use

 2) Database(mysql) Configuration
  - path : application\config\database.php
  - $db['default']['hostname'] = 'localhost';
  - $db['default']['username'] = 'elbible_db_username';  // modify your database configuration
  - $db['default']['password'] = 'elbible_db_password';	 // modify your database configuration
  - $db['default']['database'] = 'elbible_db';		 // modify your database configuration