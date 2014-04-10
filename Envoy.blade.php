@server(['demo' => 'jenkins@cms.stagingarea.us'])

@task('dep', ['on'=>'demo'])
  cd /var/www/cms/site/current
  git pull origin development
  php artisan migrate:refresh --seed
@endtask

