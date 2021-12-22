#!/bin/bash
composer install
php bin/console secrets:set APP_SECRET --env=prod
php bin/console secrets:set DATABASE_PASSWORD --env=prod
composer dump-env prod
