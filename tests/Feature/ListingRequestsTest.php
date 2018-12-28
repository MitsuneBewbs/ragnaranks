<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingRequestsTest extends TestCase
{
    /**
     * @test
     */
    public function it_loads_the_homepage()
    {
        $this->withoutExceptionHandling();

        $this->createListing(['name' => 'third'], 2, 2);

        $this->createListing(['name' => 'second'], 6, 6);

        $this->createListing(['name' => 'first'], 10, 10);

        $response = $this->get('/');

        $response->assertOk()->assertViewIs('listing.index')->assertViewHas('listings');

        $this->assertEquals('first', $this->viewData($response)->first()->name);

        $this->assertEquals('third', $this->viewData($response)->last()->name);
    }

    /**
     * @test
     */
    public function it_loads_a_server_profile()
    {
        $this->withoutExceptionHandling();

        $listing = $this->createListing([], 0, 0);

        $response = $this->get("/listing/{$listing->slug}");

        $this->assertNotNull($response->original->listing->name);

        $response->assertOk()->assertViewIs('listing.show')->assertViewHas('listing');
    }
}
