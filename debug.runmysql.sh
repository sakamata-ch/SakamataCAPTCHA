#!/bin/bash
docker_pwd=`pwd`
docker run --rm -it --network host -e MYSQL_ROOT_PASSWORD=password -e MYSQL_DATABASE=captcha -v "$docker_pwd/_debugtmp/mysql:/var/lib/mysql" -v "$docker_pwd/db.sql:/docker-entrypoint-initdb.d/db.sql:ro" -p 3306:3306 mariadb:latest