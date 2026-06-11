#!/bin/bash

# ./run-tests.sh tests/Browser/ExampleBrowserTest.php


xhost +local:docker >/dev/null 2>&1

docker compose exec pest ./vendor/bin/pest "$@"
