#!/bin/bash
composer install
composer dump-env dev
yarn install --check-files --no-bin-links --link-duplicates
yarn run build
composer dump-env prod
composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction
yarn install --check-files --no-bin-links --link-duplicates --production
