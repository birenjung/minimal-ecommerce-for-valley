# Saiwons Collection

Saiwons Collection is a Laravel 13 application developed with Laravel Sail, MySQL 8.4, Blade, Tailwind CSS 4, and Vite.

## Local setup

Docker and Docker Compose are required. On a fresh checkout, run `composer install` to obtain Sail and copy `.env.example` to `.env`. Set unique, nonempty `DB_PASSWORD`, `MYSQL_ROOT_PASSWORD`, and `DB_TEST_PASSWORD` values in `.env`. Keep `.env` and `.env.testing` out of Git.

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate  # Fresh .env only
```

Create an ignored `.env.testing` with the local `APP_KEY`, `APP_ENV=testing`, `DB_CONNECTION=mysql`, `DB_HOST=mysql`, `DB_PORT=3306`, `DB_DATABASE=saiwons_collection_test`, `DB_USERNAME=saiwons_test`, and `DB_PASSWORD` equal to `DB_TEST_PASSWORD` from `.env`. PHPUnit also fixes the test database name and username, so missing test credentials cause tests to fail instead of using the development database.

```bash
./vendor/bin/sail npm ci
./vendor/bin/sail artisan migrate
```

The application is at http://localhost:8001, phpMyAdmin is at http://localhost:8081, and MySQL listens on localhost port 3307. `DB_HOST=mysql` and `DB_PORT=3306` are the connection settings inside Sail.

## Development commands

```bash
./vendor/bin/sail ps
./vendor/bin/sail artisan migrate:status
./vendor/bin/sail test
./vendor/bin/sail pint --test
./vendor/bin/sail npm run dev
./vendor/bin/sail npm run build
./vendor/bin/sail logs
./vendor/bin/sail stop
```

Sail's named MySQL volume persists between stops. On a new, empty volume, MySQL creates `saiwons_collection`; `database/docker/create-testing-database.sh` creates `saiwons_collection_test` and grants its separate account access to that database. Initialization scripts do not rerun on an existing volume. Review migrations before running them, and do not remove the volume to rerun initialization.
