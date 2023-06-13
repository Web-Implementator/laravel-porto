ENV_FILE=.env

include $(ENV_FILE)

ARTISAN = php artisan

DOCKER_COMPOSE=docker-compose --env-file $(ENV_FILE)
DOCKER_PHP=$(DOCKER_COMPOSE) exec app

dc-build:
	$(DOCKER_COMPOSE) build

dc-up:
	$(DOCKER_COMPOSE) up -d

dc-down:
	$(DOCKER_COMPOSE) down

dc-restart:
	make dc-down
	make dc-up

# Project installation
project-install:
	#cp .env.example .env
	composer install
	make dc-up
	$(DOCKER_PHP) $(ARTISAN) key:generate
	make migrate
	make swagger

# Running Autotests
project-test:
	$(DOCKER_PHP) $(ARTISAN) test

# Project routes list
project-routes:
	$(DOCKER_PHP) $(ARTISAN) route:list

# Creating Fake Data
seed:
	$(DOCKER_PHP) $(ARTISAN) db:seed

# Running migrations
migrate:
	$(DOCKER_PHP) $(ARTISAN) migrate

# Horizon launch
horizon:
	$(DOCKER_PHP) $(ARTISAN) horizon

# L5 Swagger documentation generation
api-docs:
	$(DOCKER_PHP) $(ARTISAN) l5-swagger:generate
