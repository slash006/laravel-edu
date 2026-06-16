#!/bin/bash

# ./run-tests.sh tests/Browser/ExampleBrowserTest.php
# adjust vite.config.js
# set APP_URL=http://localhost:8028 (.env)
# add     app(\Illuminate\Foundation\Vite::class)->useHotFile(storage_path('vite.hot.does.not.exist'));



xhost +local:docker >/dev/null 2>&1

echo "Build frontend...\n";
docker compose exec vite npm run build

echo "Run tests..";
docker compose exec pest ./vendor/bin/pest "$@"
