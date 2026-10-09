<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_homepage_uses_the_saiwons_storefront_foundation(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Saiwons Collection')
            ->assertSee('Simplicity is the best style and so it is our style.')
            ->assertSee('images/saiwons-collection-logo.png')
            ->assertSee('Fashion')
            ->assertSee('Electronics')
            ->assertSee('Search')
            ->assertSee('Account')
            ->assertSee('Cart')
            ->assertSee('coming soon');
    }
}
