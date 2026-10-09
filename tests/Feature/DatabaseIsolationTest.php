<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use PDO;
use PDOException;
use Tests\TestCase;

class DatabaseIsolationTest extends TestCase
{
    public function test_testing_connection_is_isolated_from_the_development_database(): void
    {
        $this->assertSame('testing', app()->environment());
        $this->assertSame('mysql', config('database.default'));

        $database = config('database.connections.mysql');

        $this->assertSame('saiwons_collection_test', $database['database']);
        $this->assertSame('saiwons_test', $database['username']);
        $this->assertSame('saiwons_collection_test', DB::selectOne('SELECT DATABASE() AS name')->name);

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=saiwons_collection',
            $database['host'],
            $database['port'],
        );

        try {
            new PDO($dsn, $database['username'], $database['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $this->fail('Testing credentials must not access the development database.');
        } catch (PDOException $exception) {
            $this->assertContains($exception->errorInfo[1] ?? null, [1044, 1045]);
        }
    }
}
