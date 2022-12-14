# Start dev environment
up:
	docker-compose -f .docker/docker-compose.yml up -d --remove-orphans;
	@echo 'App is running on http://localhost';

# Start dev environment with forced build
up\:build:
	docker-compose -f .docker/docker-compose.yml up -d --build;

# Stop dev environment
down:
	docker-compose -f .docker/docker-compose.yml down;

# Show logs - format it using less
logs:
	docker-compose -f .docker/docker-compose.yml logs -f --tail=10 | less -S +F;

# Exec sh on php container
exec\:php:
	docker-compose -f .docker/docker-compose.yml exec php sh;

init:
	docker-compose -f .docker/docker-compose.yml exec php composer install;
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:schema:drop --force;
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:database:drop --force;
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:database:create;
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:schema:create;
	docker-compose -f .docker/docker-compose.yml exec php bin/console -n doctrine:fixtures:load

diff:
	docker-compose -f .docker/docker-compose.yml exec php rm -rf temp/cache
	docker-compose -f .docker/docker-compose.yml exec php bin/console orm:schema-tool:drop --force --full-database;
	docker-compose -f .docker/docker-compose.yml exec php bin/console migrations:migrate --allow-no-migration --no-interaction;
	docker-compose -f .docker/docker-compose.yml exec php bin/console migrations:diff;
#	git add migrations/*
	make init

cache:
	docker-compose -f .docker/docker-compose.yml exec php rm -rf temp/cache

# rebuild database (containers etc.)
reset:
	docker-compose -f .docker/docker-compose.yml exec php rm -rf .docker/data/db
	make down
	make up
	make cache

# regenerate composer.json (use makefile or git alias)
load:
	docker-compose -f .docker/docker-compose.yml exec php composer dump-autoload

# first step after git clone
start:
	make up:build
	make up
	docker-compose -f .docker/docker-compose.yml exec php composer install
	docker-compose -f .docker/docker-compose.yml exec php chmod 777 bin/console
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:database:create;
	docker-compose -f .docker/docker-compose.yml exec php bin/console doctrine:schema:create;
	docker-compose -f .docker/docker-compose.yml exec php bin/console -n doctrine:fixtures:load
