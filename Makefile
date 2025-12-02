PORT ?= 8000

start:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

