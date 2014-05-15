@servers(['cms' => 'jenkins@cms.stagingarea.us'])

@task('deploy', ['on'=> 'cms' ])
  cd /var/www/cms/site/current
  git pull origin development
  composer install 
  php artisan migrate:refresh --seed
@endtask

@task('pull', ['on'=> 'cms' ])
    cd /var/www/cms/site/current
    git pull origin development
@endtask

