@servers(['cms' => 'jenkins@cms.stagingarea.us'])

@task('deploy', ['on'=> 'cms' ])
  cd /var/www/cms/site/current
  chmod 777 public/img/projects
  chmod 777 public/img/settings
  chmod 777 public/img/banners
  git pull origin development
  composer install 
  php artisan migrate:refresh --seed
@endtask

@task('pull', ['on'=> 'cms' ])
    cd /var/www/cms/site/current
    git pull origin development
@endtask

@task('reseed', ['on'=> 'cms' ])
    cd /var/www/cms/site/current
    php artisan migrate:refresh --seed
@endtask
