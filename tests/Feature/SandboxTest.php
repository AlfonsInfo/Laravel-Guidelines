<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SandboxTest extends TestCase
{
    //* php artisan make:test SandboxTest
    //* php artisan test --filter fileName
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
