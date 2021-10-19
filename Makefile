setup:
	docker-compose run --rm composer install --ignore-platform-reqs --prefer-dist --no-suggest

run:
	docker-compose run --rm php-cli php ./bin/phpwarrior

clean:
	docker-compose down