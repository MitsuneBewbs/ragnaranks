<?php

namespace Tests\Unit;

use App\Listings\Listing;
use App\Listings\ListingFilter;
use App\Mode;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingFilterTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_filter_mode()
    {
        factory(Listing::class, 2)->create(['mode_id' => 2]);

        factory(Listing::class, 3)->create(['mode_id' => 1]);

        $listings = new ListingFilter(app('listings'));

        $this->assertCount(3, $listings->filterMode('renewal')->all());
    }
    
    /**
     * @test
     */
    public function it_can_filter_by_group()
    {
        factory(Listing::class, 1)->create(['configs->base_exp_rate' => rand(101, 200)]);

        factory(Listing::class, 2)->create(['configs->base_exp_rate' => rand(1, 100)]);

        $listings = new ListingFilter(app('listings'));

        $this->assertCount(2, $listings->filterGroup('low-rate')->all());
    }

    /**
     * @test
     */
    public function it_can_order_the_filter_by_attribute()
    {
        $listing2 = factory(Listing::class)->create(['episode'  => 2]);

        $listing1 = factory(Listing::class)->create(['episode'  => 1]);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('episode');

        $this->assertEquals($listing1->episode, $collection->first()->episode);
    }

    /**
     * @test
     */
    public function is_can_order_the_filter_by_name()
    {
        $listing2 = factory(Listing::class)->create(['name' => 'B']);

        $listing1 = factory(Listing::class)->create(['name' => 'A']);

        $listings = new ListingFilter(app('listings'));

        $collection = $listings->filterSort('name');

        $this->assertEquals($listing1->name, $collection->first()->name);
    }
}
