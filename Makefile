.PHONY: install start test db-migrate db-seed

install:
	composer install
	cp .env.example .env
	php artisan key:generate

start:
	php -S localhost:8000 -t public

test:
	vendor/bin/phpunit --testdox

db-migrate:
	php bin/console doctrine:migrations:migrate

db-seed:
	php bin/console doctrine:fixtures:load
