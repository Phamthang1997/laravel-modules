#!/bin/bash

echo "startup.sh: stdout" >&1
echo "startup.sh: stderr" >&2

composer install
composer post-root-package-install

echo "stdout" >&1
echo "stderr" >&2
exit 1