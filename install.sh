#!/bin/bash
composer install
yarn install
composer dump-env dev
bin/console d:d:c
bin/console d:m:m