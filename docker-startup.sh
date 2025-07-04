#!/bin/sh

sleep 10s
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve --host 0.0.0.0

