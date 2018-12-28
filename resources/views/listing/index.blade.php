@extends('layouts.frame')

@section('content')

    @component('slots.spotlight')
        @slot('content')
            <div class="row">
                <div class="col-10 server-rates">
                    <div id="filter" class="d-flex py-4">
                        <h3 class="d-flex align-items-center mb-0 mr-4">I'm Looking for:</h3>

                        <select class="form-control-sm mr-2">
                            <option value="all">Any Rates</option>
                            <option value="">Official Rates</option>
                            <option value="">Low Rates</option>
                            <option value="">Mid Rates</option>
                            <option value="">High Rates</option>
                            <option value="">Super Rates</option>
                            <option value="">Instant Rates</option>
                        </select>

                        <select class="form-control-sm mr-2">
                            <option value="all">Any Mode</option>
                            @foreach(\App\Mode::all() as $mode)
                                <option value="">{{ ucfirst($mode->name) }} Mode</option>
                            @endforeach
                        </select>

                        <select class="form-control-sm mr-2">
                            <option value="all">With Any Tags</option>
                            @foreach(\App\Tag::all() as $tag)
                                <option>With {{ ucfirst($tag->name) }}</option>
                            @endforeach
                        </select>

                        <select class="form-control-sm mr-2">
                            <option>Sorted by Score</option>
                            <option>Sorted by Rank Position</option>
                            <option>Sorted by Date added</option>
                            <option>Sorted by Online since</option>
                        </select>

                        <select class="form-control-sm">
                            <option>And show 50 servers</option>
                            <option>And show 100 servers</option>
                            <option>And show 250 servers</option>
                            <option>And show 500 servers</option>
                        </select>
                    </div>
                </div>
                <div class="col-2 justify-content-end align-self-center text-right">
                    Search Servers
                    <a class="text-muted" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mx-3"><circle cx="10.5" cy="10.5" r="7.5"></circle><line x1="21" y1="21" x2="15.8" y2="15.8"></line></svg>
                    </a>
                </div>
            </div>
        @endslot
    @endcomponent

    @component('slots.stage')
        @slot('content')
            <h4 class="title text-muted mb-0">Sponsored <i class="fas fa-info-circle"></i></h4>
            <div class="listings-stage">
                @foreach(app('listings')->take(3) as $listing)
                    <div class="carousel-cell mr-3">@include('partials.cards.preview', ['listing' => $listing])</div>
                @endforeach
            </div>
        @endslot
    @endcomponent

    <div class="container">

        <div class="row">

            <div class="col-8 py-5">

                @foreach($listings as $listing)

                    @include('partials.cards.normal', ['listing' => $listing])

                @endforeach

            </div>

            <div id="sidebar" class="col-4 py-5" sticky-container>
                <div v-sticky sticky-offset="offset" sticky-side="top">
                    <div class="content">
                        <h3 class=" text-orange">Site Messages</h3>
                        <p class="subheading">We are always interested in listening to feedback and improving our
                            service, let your voice be heard at our subrredit <a href="https://www.reddit.com/r/RagnaRanks">r/Ragnaranks</a>
                        </p>
                    </div>

                    {{--<div class="heading">--}}
                        {{--<h3>Weekly Mentions</h3>--}}
                    {{--</div>--}}
                    {{--<div id="awards" class="content py-0">--}}
                        {{--@include('partials.sidebar.statistic', [--}}
{{--                            {{-listinger' => App\Listings::HighestVoteTrend()->first(),--}}{{----}}
                            {{--'message' => "Top Trending Votes",--}}
                            {{--'column' => 'votes_trend',--}}
                        {{--])--}}
                        {{--@include('partials.sidebar.statistic', [--}}
{{--                            {{-listinger' => App\Listings::HighestClickTrend()->first(),--}}{{----}}
                            {{--'message' => "Top Trending Visits",--}}
                            {{--'column' => 'clicks_trend',--}}
                        {{--])--}}
                    {{--</div>--}}

                    <div class="heading">
                        <h3>Newest Additions</h3>
                    </div>

                    <div id="additions" class="content py-0">
                        @foreach (app('listings')->filterSort('created_at')->take(4) as $listing)
                            <div class="microcard">
                                <div class="information d-flex flex-row py-3">
                                    <div class="details flex-grow-1">
                                        <h3 class="mb-0">{{ $listing->name }}</h3>
                                        <p class="mt-1">Created {{ $listing->created_at->format('dS F Y') }}</p>
                                    </div>
                                    <div class="buttons w-25 d-flex align-items-center justify-content-end">
                                        <a href="" tabindex="0" class="btn btn btn-primary btn-sm">Visit <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="heading">
                        <h3>Latest Reviews</h3>
                    </div>

                    <div id="reviews" class="content py-0">
                        <?php /** @var \App\Review $review */ ?>
                        @foreach (App\Review::latest()->with('listing')->take(5)->get() as $review)
                            <div class="card card-basic listing d-flex flex-row">
                                <div class="detail flex-fill">
                                    <div class="top">
                                        <a href="">{{ $review->listing->name }}</a>
                                    </div>
                                    <div class="bottom">
                                        <i class="fas fa-server"></i> {{ $review->listing->expRateTitle }}
                                        <i class="ml-2 fas fa-clock"></i> {{ $review->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="show-counter bg-light text-info d-flex align-items-center justify-content-center rounded">
                                    {{ $review->average_score }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection