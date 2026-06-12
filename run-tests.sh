#!/bin/bash

# ./run-tests.sh tests/Browser/ExampleBrowserTest.php
# adjust vite.config.js
# set APP_URL=http://localhost:8028 (.env)

xhost +local:docker >/dev/null 2>&1

#docker compose exec vite npm run build

docker compose exec pest ./vendor/bin/pest "$@"
