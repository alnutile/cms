@servers(['cms' => 'jenkins@cms.stagingarea.us'])

@task('deploy', ['on'=> 'cms' ])
  cd /var/www/cms/site/current
  git pull origin development
  composer update
  php artisan migrate:refresh --seed
@endtask

