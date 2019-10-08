#!/bin/bash

. Autorun/sh/head.sh

printf "${RED}Are you sure what you want down all agatefund containers and remove all agatefund docker-images? [y/N]${NC}\n"
read -r -p "" response
case "$response" in
    [yY][eE][sS]|[yY])

        printf "${RED}restart local or server? [l/s]${NC}\n"
        printf "${RED}перезапуск происходит локально или на сервере? [l/s]${NC}\n"
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

        ${user_permissions} docker-compose -f ${docker_file} down
        printf "${GREEN}DONE${NC} ${PURPLE}docker-compose down${NC}${N}"
        ${user_permissions} docker rmi ${env}_docker_nodejs
        printf "${GREEN}DONE${NC} ${PURPLE}docker rmi ${env}_docker_nodejs${NC}${N}"
        ${user_permissions} docker rmi -f ${env}_docker_web
        printf "${GREEN}DONE${NC} ${PURPLE}docker rmi -f ${env}_docker_web${NC}${N}"
        ${user_permissions} docker rmi -f ${env}_docker_php
        printf "${GREEN}DONE${NC} ${PURPLE}docker rmi -f ${env}_docker_php${NC}${N}"
        ${user_permissions} docker rmi ${env}_docker_composer
        printf "${GREEN}DONE${NC} ${PURPLE}docker rmi ${env}_docker_composer${NC}${N}"
        ${user_permissions} docker rmi ${env}_docker_mysql
        printf "${GREEN}DONE${NC} ${PURPLE}${user_permissions} docker rmi ${env}_docker_mysql${NC}${N}"
        ${user_permissions} docker rmi ${env}_docker_phpmyadmin
        printf "${GREEN}DONE${NC} ${PURPLE}docker rmi ${env}_docker_phpmyadmin${NC}${N}"
        ;;
    *)
        #do_something_else
        ;;
esac