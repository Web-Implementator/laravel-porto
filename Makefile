.ONESHELL: ;
.NOTPARALLEL: ;
default: help;

FRMT_NORM=\033[0m
FRMT_INVRS=\033[7m

.PHONY: help
help: ## Информация о доступных командах
	@egrep -h '\s##\s' Makefile | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

.PHONY: up
up: ## Запустить сервер
	@echo "${FRMT_INVRS} Запуск сервера... ${FRMT_NORM}"
	docker-compose up -d

.PHONY: down
down: ## Остановить сервер
	@echo "${FRMT_INVRS} Остановка сервера... ${FRMT_NORM}"
	docker-compose down

.PHONY: console
console: ## Открыть консоль сервера
	@echo "${FRMT_INVRS} Открытие консоли сервера... ${FRMT_NORM}"
	docker-compose exec app bash

.PHONY: build
build: ## Сборка проекта
	@echo "${FRMT_INVRS} Сборка проекта... ${FRMT_NORM}"
	docker-compose up -d --no-deps --build

.PHONY: update
update: ## Обновить проект
	@echo "${FRMT_INVRS} Обновление проекта... ${FRMT_NORM}"
	git pull
	make build
	make up
	rm -fv ./bootstrap/cache/*.php
	docker-compose exec -T laravel_porto_app bash -c 'composer install'
	docker-compose exec -T laravel_porto_app bash -c 'php artisan optimize:clear'
	docker-compose exec -T laravel_porto_app bash -c 'php artisan migrate'
	docker-compose exec -T laravel_porto_app bash -c 'php artisan queue:restart'
