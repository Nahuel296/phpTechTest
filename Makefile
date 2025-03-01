.PHONY: up down logs test install

ifneq (,$(wildcard .env))
    include .env
    export
endif

DB_NAME ?= myapp
DB_USER ?= user
DB_PASSWORD ?= password
DB_HOST ?= mysql_db

up:
	docker-compose up --build -d

install:
	@if [ ! -f .env ]; then cp .env.example .env; fi
	docker-compose run --rm php composer install

test:
	docker-compose run --rm php vendor/bin/phpunit

down:
	docker-compose down

logs:
	docker-compose logs -f
