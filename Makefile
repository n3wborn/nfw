UID = $(shell id -u)
GID = $(shell id -g)
PWD = $(shell pwd)
COMPOSER = composer:2

.PHONY: docker_build
docker_build:
	docker-compose build

.PHONY: docker_up
docker_up:
	docker-compose up

.PHONY: composer_install
composer_install:
	# use standalone container to avoid root owned vendor directory
	docker run --rm -ti -v $(PWD):/app --user $(UID):$(GID) $(COMPOSER) install
