#!/bin/sh

TEST=$1
if [[ $TEST == 'all' ]]
then
  TEST=''
fi

STOP=$2 
if [[ $STOP == 'stop' ]]
then
  STOP='--stop-on-failure'
fi

echo Running tests app/tests/behat/features/$TEST
php artisan migrate:refresh --seed
#vendor/bin/behat --config app/tests/behat/behat.yml app/tests/behat/features/$TEST
vendor/bin/behat $STOP --config app/tests/behat/behat.yml app/tests/behat/features/$TEST

