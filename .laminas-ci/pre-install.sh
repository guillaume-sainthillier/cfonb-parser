#!/bin/bash

set -ex

JOB=$3
COMMAND=$(echo "${JOB}" | jq -r '.command')
if [[ ${COMMAND} =~ "phpunit" ]];then
  PACKAGES_TO_REMOVE="friendsofphp/php-cs-fixer phpstan/phpstan rector/rector vimeo/psalm"
elif [[ ${COMMAND} =~ "php cs fixer" ]];then
  PACKAGES_TO_REMOVE="phpunit/phpunit phpstan/phpstan rector/rector vimeo/psalm"
elif [[ ${COMMAND} =~ "phpstan" ]];then
  PACKAGES_TO_REMOVE="friendsofphp/php-cs-fixer rector/rector vimeo/psalm"
elif [[ ${COMMAND} =~ "psalm" ]];then
  PACKAGES_TO_REMOVE="friendsofphp/php-cs-fixer phpstan/phpstan rector/rector"
else
  exit 0
fi

# shellcheck disable=SC2086
composer remove --dev $PACKAGES_TO_REMOVE
