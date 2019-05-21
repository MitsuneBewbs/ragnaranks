<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Interactions\Interaction;
use App\Interactions\Vote;
use App\Listings\Listing;
use App\Interactions\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreReviewRequest $request
     * @param Listing $listing
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreReviewRequest $request, Listing $listing)
    {
        if (!$listing->reviews()->publishedBy(auth()->user())->count())
        {
            $listing->reviews()->create($request->validated());
        }

        return redirect()->back()->with(['flash' => 'You already made a review on this listing.']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Listing $listing
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Listing $listing, Review $review)
    {
        $listing->reviews->find($review->id)->update($request->all());

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Listing $listing
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Listing $listing, Review $review)
    {
        $listing->reviews->find($review->id)->delete();

        return redirect()->back();
    }
}
