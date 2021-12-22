#!/bin/bash
composer install
composer dump-env dev
yarn install --no-bin-links --link-duplicates
composer dump-env dev
bin/console d:d:c
bin/console d:m:m
yarn run dev
