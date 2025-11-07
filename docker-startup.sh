#!/bin/sh

sleep 10s
php artisan config:clear
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan serve --host 0.0.0.0 --port 8000

