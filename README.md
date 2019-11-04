Для деплоя в линуксе при наличии утилиты make просто выполнить "make init"

Инача выполнять:
- docker-compose pull
- docker-compose build
- docker-compose up -d
- docker-compose run --rm app-php-cli composer install
- docker-compose run --rm app-php-cli php bin/console doctrine:migrations:migrate --no-interaction
- docker-compose run --rm app-php-cli php bin/console doctrine:fixtures:load --no-interaction
- docker-compose run --rm app-php-cli php bin/console currency:quote:update

Запуск тестов "make test"
