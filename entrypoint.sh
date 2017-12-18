#!/bin/bash

if [ -z "$TZ" ]; then
   TZ=Asia/Shanghai
fi
ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo "${TZ}" > /etc/timezone

cd /root

if [ ! -z "$ENV" ]; then
 cp app/config/parameters_${ENV}.yml.dist app/config/parameters.yml
fi

php app/console cache:clear --env=prod

php app/console server:run 0.0.0.0:80

#tail -f /dev/null