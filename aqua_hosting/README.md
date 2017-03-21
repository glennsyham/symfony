composer install
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

import symfony_vps_data_new.sql

login and password are in fixtures.yml

localhost:8000/vps

localhost:8000/admin/vps
using sass, react, jquery 