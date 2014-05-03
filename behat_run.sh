#!/bin/sh

TEST=$1
if [[ $TEST == 'all' ]]
then
  TEST=''
fi

echo Running tests app/tests/behat/features/$TEST
php artisan db:seed
#vendor/bin/behat --config app/tests/behat/behat.yml app/tests/behat/features/$TEST
vendor/bin/behat --config behat.yml app/tests/behat/features/$TEST
