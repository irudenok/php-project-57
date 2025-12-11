COMPOSE_FILE ?= docker-compose.yml

PORT ?= 8000

PHP_SERVICE ?= app

start:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

up:
	docker-compose -f $(COMPOSE_FILE) up -d

down:
	docker-compose -f $(COMPOSE_FILE) down

restart: down up

test:
	docker-compose -f $(COMPOSE_FILE) exec $(PHP_SERVICE) php artisan test

test-coverage:
	docker-compose -f $(COMPOSE_FILE) exec $(PHP_SERVICE) php artisan test --coverage