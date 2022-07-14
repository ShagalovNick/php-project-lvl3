start:
	php artisan serve --host 0.0.0.0

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	touch database/database.sqlite
	php artisan migrate
	php artisan db:seed
	npm ci
	npm run dev

test:
	php artisan test

test-coverage:
	XDEBUG_MODE=coverage php artisan test --coverage-clover build/logs/clover.xml

lint:
	phpcs --standard=PSR12 resources/views/urls app/Http/Controllers routes tests