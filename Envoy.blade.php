@servers(['cms' => 'jenkins@cms.stagingarea.us'])

@task('deploy', ['on'=> 'cms' ])
  cd /var/www/cms/site/current
  chmod 777 public/img
  chmod 777 public/img/banners
  git pull origin development
  composer install 
  php artisan migrate:refresh --seed
@endtask

