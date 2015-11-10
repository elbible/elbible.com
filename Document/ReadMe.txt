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

 3) init Bible Data 
  - path : Document\DB.sql
  - mysql [dbname] Document\DB.sql
  
   * reference code table : https://goo.gl/ZUUgF6 
   

 4) insert bible book
  - path : tools\ENG_KJV-txt.sql
  - mysql [dbname] tools\ENG_KJV-txt.sql
  - another translate book is same way insert query
  - if you want new translate book, you use 'tools\txtToSql.php' that is txtType book converting batch to insert query.
