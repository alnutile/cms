#!/bin/sh

TEST=$1
if [[ $TEST == 'all' ]]
then
  TEST=''
fi

echo Running tests app/tests/behat/features/$TEST
envoy run reseeed
vendor/bin/behat --config app/tests/behat/behat.yml --profile remote app/tests/behat/features/$TEST
