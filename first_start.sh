#!/bin/sh

if [ ! -e "/usr/bin/docker-compose" ] || [ ! -e "/usr/bin/docker-compose" ]; then
    printf "\n 'docker-compose' command wasn't found!\n Please install it and try again"
    exit 1
fi

# shellcheck disable=SC2046
sudo /usr/bin/chown -R 1000:33 $(pwd) || exit 1

docker-compose up -d

php_container_running=$(docker ps | grep '[-_]app');

if [ -n "$php_container_running" ]; then
    # shellcheck disable=SC2039
    echo -n "Composer update..."
    /usr/bin/docker exec -it app composer install >/dev/null;

    # shellcheck disable=SC2181
    if [ $? -ne 0 ] ; then
        echo "Some error occurred!"
        exit 1
    else
        echo 'Ok';
    fi
fi

echo "Generate application key"
/usr/bin/docker exec -it app php artisan key:generate --ansi || exit 1

#/usr/bin/docker exec -it app php artisan migrate || exit 1

echo "done."

#echo "NOTE: don't forget to run command 'docker exec -it app php artisan migrate'"
#echo

exit 0
