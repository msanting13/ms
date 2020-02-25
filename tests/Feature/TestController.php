<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Traits\PublisherTrait;
use App\News;

class TestController extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use PublisherTrait;

    public function testExample()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);
        return $this->publisher(new News);
    }



}
