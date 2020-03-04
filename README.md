## **INSTALL INSTRUCTIONS**

How to running this project.

1) Symfony Server
       
      This option require a little bit more from you.
      
      1) You need to have ready instance with database `userstory` with access credentials `root / password` (login/password).
      2) `.env:` file contains URL to database, update your DB access informations in this file the same way as it is now, e.g.
         `mysql://root:password@host:port/db_name` and comment previous one
      3) You also need to have
           - PHP CLI >= 7.2 (extensions: xml, mysql, pdo-mysql)
           - Composer
      4) Commands sequence (all in main project directory)
           - `composer install` 
           - `php bin/console doctrine:migrations:migrate`
           - `curl -sS https://get.symfony.com/cli/installer | bash`
           - `export PATH="$HOME/.symfony/bin:$PATH"`
           - `symfony server:start -d`
           
       Congratulations! Your project is now available at `http://127.0.0.1:8000`
      