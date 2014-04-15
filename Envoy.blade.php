@server(['cms' => 'jenkins@cms.stagingarea.us'])

@task('deploy', ['on'=>'demo'])
  cd /var/www/cms/site/current
  git pull origin development
  php artisan migrate:refresh --seed
@endtask

