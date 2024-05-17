#!/bin/sh

docker-compose up -d

php_container_running=$(docker ps | grep '_php');

if [ -n "$php_container_running" ]; then
    /usr/bin/docker-compose run --rm app composer update >/dev/null;
fi

# shellcheck disable=SC2181
if [ $? -ne 0 ] ; then
    echo "Some error occurred!"
else
    echo 'Ok';
fi

