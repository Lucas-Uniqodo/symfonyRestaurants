composer create-project symfony/skeleton my_project_name ^4.4.29
composer require logger symfony/orm-pack doctrine/annotations symfony/maker-bundle symfony/web-server-bundle
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
cat php.ini

symfony server:start