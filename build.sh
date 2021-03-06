#!/bin/bash
# Warning: This is NOT a productive script, but for local dev envs only!

echo "### INSTALL/UPDATE ###";
[ ! -f composer.phar ] && curl -sS https://getcomposer.org/installer | php
php composer.phar selfupdate

git pull

php composer.phar install --prefer-dist --no-dev --optimize-autoloader --no-interaction

chmod +x bin/cake

mkdir -p ./tmp
mkdir -p ./logs
mkdir -p ./webroot/js/cjs/
mkdir -p ./webroot/css/ccss/

echo "### DB MIGRATION ###";
bin/cake Migrations migrate -p Captcha
bin/cake Migrations migrate

echo "### ASSETS ###";
bower install --allow-root

mkdir -p ./webroot/css/fonts
cp -R ./webroot/assets/bootstrap/dist/fonts/* ./webroot/css/fonts/
cp -R ./webroot/assets/font-awesome/fonts/* ./webroot/css/fonts/

bin/cake AssetCompress.AssetCompress build

echo "### CLEANUP ###";
rm -rf ./tmp/cache/models/*
rm -rf ./tmp/cache/persistent/*
rm -rf ./tmp/cache/views/*

chown -R www-data:www-data *
chmod -R 0770 ./tmp
chmod -R 0770 ./logs
chmod -R 0770 ./webroot/js/cjs/
chmod -R 0770 ./webroot/css/ccss/

echo "### DONE ###";
