#!/bin/bash

. Autorun/sh/head.sh

file="backend/.env"
if [ -f "$file" ]
then

    printf "${RED}where are you starting project? local or server? [l/s]${NC}\n"
    printf "${RED}проект запускается локально или на сервере? [l/s]${NC}\n"
    read -r -p "" response
    case "$response" in
        "l")
            user_permissions='sudo';
            ;;
        *)
            user_permissions='';
            ;;
    esac

    docker_file='docker-compose.yml';
    env=${folder_prod_name};

    printf ${env}
    #Start docker with command:
    ${user_permissions} touch backend/storage/logs/laravel.log
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} touch backend/storage/logs/laravel.log${NC}${N}"
    ${user_permissions} chmod 777 -R backend/storage/
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} chmod 777 -R backend/storage/${NC}${N}"
    ${user_permissions} chmod 777 -R backend/bootstrap/cache/
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} chmod 777 -R backend/bootstrap/cache/${NC}${N}"
    ${user_permissions} docker-compose -f ${docker_file} up -d
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker-compose -f $docker_file up -d --build${NC}${N}"

    #Up backend:
    ${user_permissions} docker exec -it ${env}_docker_composer_1 composer install
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_composer_1 composer install${NC}${N}"

    ${user_permissions} docker exec -it ${env}_docker_php_1 php artisan config:clear
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} exec -it ${env}_docker_php_1 php artisan config:clear${NC}${N}"

    ${user_permissions} docker exec -it ${env}_docker_php_1 php artisan cache:clear
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} exec -it ${env}_docker_php_1 php artisan cache:clear${NC}${N}"

    #show worked containers
    ${user_permissions} docker ps
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker ps${NC}${N}"

    printf "${RED}Containers worked? Continue up project [y/n]${NC}\n"
    printf "${RED}Контейнеры запущены? Продолжить запуск проекта[y/n]${NC}\n"
    read -r -p "" response
    case "$response" in
        "n")
                exit 1
            ;;
        *)
            #continue start project
            ;;
    esac

    #Make migrate
    ${user_permissions} docker exec -it ${env}_docker_php_1 php artisan migrate
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_php_1 php artisan migrate${NC}${N}"

    #Laravel passport:
    ${user_permissions} docker exec -it ${env}_docker_php_1 php artisan passport:install
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_php_1 php artisan passport:install${NC}${N}"

    #Up frontend:
    ${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-install.sh
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-install.sh${NC}${N}"
    ${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-build.sh
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-build.sh${NC}${N}"

    #Up admin frontend:
    ${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh admin-app-install.sh
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh admin-app-install.sh${NC}${N}"
    ${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh app-build.sh
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_nodejs_1 sh admin-app-build.sh${NC}${N}"

    #Laravel passport settings
    ${user_permissions} docker exec -it ${env}_docker_php_1 chmod 777 -R storage/
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_php_1 chmod 777 -R storage/${NC}${N}"
    ${user_permissions} docker exec -it ${env}_docker_php_1 sh script-rights.sh
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_php_1 sh script-rights.sh${NC}${N}"
    ${user_permissions} docker exec -it ${env}_docker_php_1 php artisan cache:clear
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} exec -it ${env}_docker_php_1 php artisan cache:clear${NC}${N}"
    ${user_permissions} docker exec -it ${env}_docker_php_1 chown www-data:www-data public/tmp/
    printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker exec -it ${env}_docker_php_1 chown www-data:www-data public/tmp/${NC}${N}"

else
	echo "${RED} WARNING! $file not found! Put file with tests environments ${NC}"
	echo "${RED} ВНИМАНИЕ! $file не найден! Положите файл .env в папку backend/ ${NC}"
	exit 1
fi