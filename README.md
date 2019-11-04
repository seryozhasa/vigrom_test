Для деплоя в линуксе при наличии утилиты make просто выполнить "make init"

Иначе выполнять:
- docker-compose pull
- docker-compose build
- docker-compose up -d
- docker-compose run --rm app-php-cli composer install
- docker-compose run --rm app-php-cli php bin/console doctrine:migrations:migrate --no-interaction
- docker-compose run --rm app-php-cli php bin/console doctrine:fixtures:load --no-interaction
- docker-compose run --rm app-php-cli php bin/console currency:quote:update

Командой в консоли "make update-currency" или "docker-compose run --rm app-php-cli php bin/console currency:quote:update" выполняется обновление курса доллара по отношению к рублю с сайта ЦБР.

Запуск тестов "make test"

На главной странице http://0.0.0.0:8080/ представлены примеры с ссылками к апи
