<?php

namespace Tests\Feature;

use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReviewRequestTest extends TestCase
{
    use WithFaker;

    use RefreshDatabase;

    /**
     * @var Listing
     */
    private $listing;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->listing = factory(Listing::class)->create();
    }


    /**
     * @test
     */
    public function a_review_can_be_added()
    {
        $this->signIn();

        $this->withoutExceptionHandling();

        $listing = factory(Listing::class)->create(['slug' => 'listing-name']);

        $review = factory(Review::class)->make(['message' => $this->faker->sentence(300)]);

        $this->post("/listing/listing-name/reviews", $review->toArray());

        $this->assertCount(1, $listing->reviews);

        $this->assertCount(1, Auth::user()->reviews);
    }

    /**
     * @test
     */
    public function a_review_can_be_destroyed()
    {
        $this->signIn();

        $this->listing->reviews()->save(factory(Review::class)->create());

        $this->delete("/listing/{$this->listing->slug}/reviews/{$this->listing->reviews()->first()->id}");

        $this->assertCount(0, $this->listing->reviews);
    }

    /**
     * @test
     */
    public function a_review_can_be_updated()
    {
        $this->signIn();

        $this->listing->reviews()->save(factory(Review::class)->create());

        $this->patch("/listing/{$this->listing->slug}/reviews/{$this->listing->reviews()->first()->id}", ['message' => "foo bar"]);

        $this->assertDatabaseHas('reviews', ['id' => $this->listing->reviews()->first()->getkey(), 'message' => 'foo bar']);
    }

    /**
     * @test
     */
    public function it_can_be_destroyed()
    {
        $this->signIn();

        $review = $this->listing->reviews()->save(factory(Review::class)->create());

        $this->delete("/listing/{$this->listing->slug}/reviews/{$review->getKey()}");

        $this->assertDatabaseMissing('reviews', ['id' => $review->getKey()]);
    }
}
