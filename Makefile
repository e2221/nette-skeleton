# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help startup up upr ps log down downr exec

.DEFAULT_GOAL := help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

## Start containers and configure to run
up: docker-up permissions

## Start and build containers and configure to run
upb: docker-build cacher permissions


ps: ## Containers overview
	sudo docker-compose ps

##Log of container
log: $(NAME)
	sudo docker-compose logs -f $(NAME)

down: ## Down containers
	sudo docker-compose down

downr: ## Down containers and remove
	sudo docker-compose down --remove-orphans

##Connect to container	(CTRL + SHIFT + D)
exec: $(NAME)
	sudo docker-compose exec $(NAME) bash

permissions: ## Permissions to folders
	sudo docker-compose exec web mkdir -p temp
	sudo docker-compose exec web mkdir -p log
	sudo docker-compose exec web chmod -R 0777 temp/ log/

docker-up: ## Up containers
	sudo docker-compose up -d

docker-build: ## Build up and build
	sudo docker-compose up -d --build

ubuntu-ip: ## Get ip address ubuntu
	hostname -I

cacher: ## Remove cache
	sudo docker-compose exec web rm -rf temp/cache/

cacher-latte: ## Remove latte cache
	sudo docker-compose exec web rm -rf temp/cache/latte/