#!/usr/bin/env bash
set -euo pipefail

: "${MYSQL_ROOT_PASSWORD:?}"
: "${MYSQL_USER:?}"
: "${MYSQL_PASSWORD:?}"
: "${MYSQL_TEST_PASSWORD:?}"

if [[ "${MYSQL_DATABASE:-}" != 'saiwons_collection' || "${MYSQL_TEST_DATABASE:-}" != 'saiwons_collection_test' || ! "${MYSQL_TEST_USER:-}" =~ ^[a-zA-Z0-9_]+$ || "$MYSQL_TEST_USER" == "$MYSQL_USER" || "$MYSQL_TEST_PASSWORD" == "$MYSQL_PASSWORD" ]]; then
    echo 'Invalid testing database configuration' >&2
    exit 1
fi

password_hex=$(printf '%s' "$MYSQL_TEST_PASSWORD" | od -An -tx1 | tr -d ' \n')

MYSQL_PWD="$MYSQL_ROOT_PASSWORD" mysql --user=root <<SQL
CREATE DATABASE IF NOT EXISTS \`$MYSQL_TEST_DATABASE\`;
SET @test_password = CONVERT(0x$password_hex USING utf8mb4);
SET @create_user = CONCAT("CREATE USER IF NOT EXISTS '$MYSQL_TEST_USER'@'%' IDENTIFIED BY ", QUOTE(@test_password));
PREPARE statement FROM @create_user;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @alter_user = CONCAT("ALTER USER '$MYSQL_TEST_USER'@'%' IDENTIFIED BY ", QUOTE(@test_password));
PREPARE statement FROM @alter_user;
EXECUTE statement;
DEALLOCATE PREPARE statement;
GRANT ALL PRIVILEGES ON \`$MYSQL_TEST_DATABASE\`.* TO '$MYSQL_TEST_USER'@'%';
SQL
