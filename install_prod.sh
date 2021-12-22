#!/bin/bash
yarn install --production=true --check-files --no-bin-links --link-duplicates
composer dump-env prod
composer install
yarn run encore production
composer install --no-dev