
up:
	docker-compose up -d

down:
	docker-compose down

install:
	docker-compose exec --user=1000 php-fpm ./bin/console d:d:d --force
	docker-compose exec --user=1000 php-fpm ./bin/console d:d:c
	docker-compose exec --user=1000 php-fpm ./bin/console d:s:c

fixtures:
	docker-compose exec --user=1000 php-fpm ./bin/console hautelook:fixtures:load -n


php:
	docker-compose exec --user=1000 php-fpm bash