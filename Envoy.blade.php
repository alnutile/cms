@servers(['cms' => 'forge@example1.corbettresearchgroup.com', 'dev' => 'forge@cms.zigbop.io'])


@task('deploy_blog', ['on' => 'dev'])
date
cd /home/forge/cms.zigbop.io
git reset --hard HEAD
git pull origin blog
composer dump-autoload
php artisan migrate
@endtask

@task('deploy_dev_full', ['on' => 'dev'])
date
cd /home/forge/cms.zigbop.io
git reset --hard HEAD
git pull origin blog
composer config -g github-oauth.github.com 3723ffba870537486bac02195feecaa85b6e7c3d
composer install
composer dump-autoload
php artisan dump-autoload
bower install
npm install
@endtask