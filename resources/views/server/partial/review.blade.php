
<div class="review px-3 py-2">
    <div class="row">
        <div class="avatar mr-2">
            <span class="font-weight-bold">{{ fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F', 'G']) }}</span>
        </div>
        <div class="col bg-white p-3 ml-3 content">
            <div class="info d-flex align-items-center">
                <span class="user mr-2" style="color: #ff194d;">{{ fake()->firstName . " " . fake()->lastName }}</span>
                <small class="mr-2">‣</small>
                <small>Posted 22 Hours ago</small>
        </span>
            </div>
            <div class="description">
                {{ fake()->sentence(120) }}
            </div>
            <div class="scores d-flex flex-row">
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Donation Balance : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Update Balance : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Class Balance : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Item Balance : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Support : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Content : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Hosting : <span class="font-weight-bold">{{ $score }}</span>
                </div>
                <?php $score = rand(1, 10) ?>
                <div class="score score-is-{{ $score >= 7 ? "good" : ($score >= 4 ? "ok" : "bad") }}">
                    Events : <span class="font-weight-bold">{{ $score }}</span>
                </div>
            </div>
        </div>
        <div class="rating p-3 bg-white">
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
            </div>
            <span class="text-center">
                3.5 out of 5
            </span>
        </div>
    </div>
</div>