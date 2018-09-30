<?php

use App\ServerMode;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Server::class, function (Faker $faker) {

    $server = collect([
        [
            'name' => 'TalonRO',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000016173_d6713827.gif',
            'description' =>'5/5/3 ~ 8/8/3 • Stable/Lagfree/Balanced • No Wipes, Up for 10+ years • Ep 14.1 • 180+ Custom Hair • 1000+ Hats • 1400-1900 Players • Custom Dye/Pets/Q...',
        ],
        [
            'name' => 'Forsaken Ragnarok Online',
            'banner' => 'https://forsaken-ro.net/images/votebanners/hq/forsakenrobanner1.gif',
            'description' =>'6k/6k/100 max lvl 255/255 questable/votable donations guild/newbie packs up for 5+ years, no wipes, stable intense WOE/GVG/PVP',
        ],
        [
            'name' => 'Philippine Ragnarok Online Project Chaos',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000094148_fa37e810.jpeg',
            'description' => 'The server is on Pre-renewal Classic Trans server! - Max Level 99/70 - 1st Month Rates: 25x/25x/7x - Default Rate: 10x/10x/5x - No BOT - No Multi...',
        ],
        [
            'name' => 'Dreamer RO',
            'banner' => 'http://playdreamerro.com/img/bannertest.gif',
            'description' => 'Rates: 8k/8k/3k // MaxLvl: 500/120 // Renewal content with some Pre-RE mechanics // 3rd Jobs // Oboro, Kagerou, Rebellion, Dorams // Active PvP // Bat...',
        ],
        [
            'name' => 'Revival Online Private Server',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093763_37c9af60.gif',
            'description' => 'RevivalRO located in ASIA NO LAG Loki server Rates: 100x/100x/20x - Maximum Level: 255/120 1200+ Hats many Custom Instances/Monster/Items 300 to 550 p...',
        ],
        [
            'name' => 'Ragnarok Online Island',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000093898_5fa09420.png',
            'description' => 'ONLINE 1000+ | Launched: 13. June 2018 | International Mid-Rate (df server) | Pre-RE | Episode 13.3+ | Rates: 77x77x33x~99x99x44x | BattleGrounds 2.0...',
        ],
        [
            'name' => 'Estland Ragnarok Online',
            'banner' => 'https://www.top100arena.com/siteBanners/site_0000087155_778d886e.jpeg',
            'description' => '[ 500+ Players Online ] [ Low & Mid 99/70 - Pre-Re Servers ] [ Low: 13x13x5x ~ 15x15x7x ] [ Mid: 130x130x30x ~ 150x150x50x ] [ Stable working eAmod ] ...',
        ],
        [
            'name' => 'Melee-RO',
            'banner' => 'http://www.top100arena.com/siteBanners/site_0000093881_b48ddabe.gif',
            'description' => 'Pre-Renewal. Rates 75x/75x/50x. Cartas 0.16% y MvP 0.02%. Max 99/70. Sin CASH SHOP/ANTI Pay-2-Win. Gepard Shield 3.0. PACK DE BIENVENIDA y GUILD PACK!...',
        ],
        [
            'name' => 'Gathering RO',
            'banner' => 'https://premium.topg.org/511217/411824_7641.png',
            'description' => 'World Bosses • WoE Rewards • Legendary Gear/Quests • Daily Challenges & Quests • Login Rewards • Balanced 3rd Classes • Battleground Queue • 5k/5k/Dynamic • Level 250/120 • Stats 200 • WoE Castle Rotation • Service NPCs • No Wipe',
        ],
        [
            'name' => 'Limit RO',
            'banner' => 'https://www.limitro.com/images/limitrobanner2017.png',
            'description' => 'Rates: 100/100/25 - MaxLevel: 175/60 - Stable/Lagfree/Balanced - Since 2009, no wipes - Episode 16 - Great GMs and Players - Many Minigames - WoE/BG/PvP Intesnse - Daily Quests - Most close to official renewal gaming with Star Emperor / Soul Reaper',
        ],
        [
            'name' => 'RebirthRO',
            'banner' => 'http://rebirthro.com/images/hotlink-ok/468x60.gif',
            'description' => 'RebirthRO 1000 + Hats many Custom Instances New renewal 3rd jobs Rebellion - Kagerou - Oboro server named Thor 100/100/10/2 Two classic servers: Loki 100/100/20 and Eir 5/5/3 1000+ players online 100,000+ active players 100 secure website Free Pokemon pets 24/7 uptime Active WoE and BG',
        ],
        [
            'name' => 'Chapter R [ Now Open ]',
            'banner' => 'https://chapter-ragnarok.net/static/img/banner-small.png',
            'description' => 'Chapter R is back after 7 years We didnt change over the years: 8/9/10 rates, Pre-renewal with adjusted and balanced 3rd classes for a full content without abuse Unique RP instances and much more',
        ],
        [
            'name' => 'Liberation Ragnarok Online',
            'banner' => 'https://www.arena-top100.com/images/users/libro2k18.png',
            'description' => 'PLAYABLE IN MOBILE ANDROIDJoin us and experience the MIDRATE classic days server for Job Transcendent class. Max Level 9970 MidRate 100x10050x - up to 250x250x50x FloatingHappy hour Rates Pre-Renewal Episode 13.2 with Free JOB PACKAGE',
        ],
        [
            'name' => 'Shinning Moon',
            'banner' => 'https://www.arena-top100.com/images/users/fr0sty123456789.gif',
            'description' => 'Renewal Pre-Renewal. Set your own EXP-rates between 1-100 20x droprates Class Change, Soul System, Monster Hunter, Treasure Caches, Over 400 custom headgears, Warper warp, BufferHealer, Weapon Evolution, Daily Rewards, Automated Events and much more features. Active Development Join us',
        ],
        [
            'name' => 'No Mercy RO',
            'banner' => 'https://www.arena-top100.com/images/users/Smusmus.jpg',
            'description' => 'German P Server Gaming Community! 3 RO Servers: lowrate 5/5/5 L99/70 Pre-Renewal | midrate 50/50/50 L175 Renewal | highrate 5k/5k/1k L999 Renewal | 24/7 Uptime German/English Support! Visit Our Site for more info!',
        ],
        [
            'name' => 'Core Ragnarok Online',
            'banner' => 'https://www.arena-top100.com/images/users/coreragnarok.gif',
            'description' => 'Server Rates 8k8kModified -REAL MONEY TRADING IS ALLOWED- Guild Package Ready To PVP Server More On Quest Up to 255120 Transcendent Class Only Guild Capacity 3636 PK Unfrozen-Server Features Modified Soul link effects Dark RO Based Modified Lhz Cards effect Dark RO Based Fixed Cast delay for some skills for balancing purpose Purely balanced server Wing and Weapon quest enabled Break the Seal quest Mini WOE Event Invasion Event Token Quest hunting Gold Room Deadbranch Room Hourly System...',
        ],
        [
            'name' => 'Explosive RO',
            'banner' => 'https://www.arena-top100.com/images/users/explosivero.png',
            'description' => '255-120 - 5k-5k-1k - 255 Max Stat - 195 Max ASPD - Hunt, Quest, PK Oriented Server - Protected from DDoS - Gepard Protection - Hosted in Asia',
        ],
        [
            'name' => 'Domina Ragnarok Online',
            'banner' => 'https://www.arena-top100.com/images/users/marksalvania.jpg',
            'description' => 'SERVER INFORMATION 255 300 all stats High rate PICK Server. 20k20k10k and 10 MVP Card drop. All items are obtainable by just farminghuntingvoting and NO OP Donation. This is not a business TYPE Server. Our goal is to make our players enjoy everything and make the community grow up to have more. Youll gain more friends here and encounter generous players that is willing to help you for your good start. Anyone can enjoy the game and PK like a boss. All fair for all players.',
        ],
        [
            'name' => 'Imperial RO Best Asian Server',
            'banner' => 'https://www.arena-top100.com/images/users/imperialro.png',
            'description' => 'Imperial RO Best Asian Ragnarok Server Lag-Free Lots of in-game events Tons of things to do Join Now Imperial Warriors',
        ],
        [
            'name' => 'Selcouth Ragnarok Online',
            'banner' => 'https://www.arena-top100.com/images/users/xxdervyxx.gif',
            'description' => 'Selcouth Ragnarok Online is a Super High Rate private server customized for unique player vs player and monster vs player experience! Woe friendly! Crazy PvP! Insane MvPs! Max level 500/150. Max Stats 400. Rates: 5000/5000/custom. Custom MVPS drop fantastic items! To keep them rare, equip drops are .25 or .5 with gum. Balanced 3rd jobs. Customized produce database for Mechanics to forge uber weapons. Many custom pets! Awesome custom gears. Friendly community, friendl',
        ],
        [
            'name' => 'Harmony RO - Deva',
            'banner' => 'https://www.arena-top100.com/images/users/deva.png',
            'description' => 'Midrate 25x 25x 10x - Keine Donates - Renewal 16.1 - Doram und Rebellion - Achievement System',
        ],
        [
            'name' => 'RoyalRO - Become part of the story',
            'banner' => 'https://www.arena-top100.com/images/users/RoyalRO.jpg',
            'description' => '5x 5x 3x 1x Quests Exp Max Lv 9970 Pre-Renewall Episode 13.2 no 3rd Job very balanced and farmable Donations Achivements request-Support-System Daily selectable Events over 80 Monster Kill-Quests Share 20 LVL',
        ],
    ]);

    $server = $server->random();

    return [
        'name' => $server['name'],
        'user_id' => factory('App\User')->create()->id,
        'website' => $faker->url,
        'mode_id' => ServerMode::inRandomOrder()->first(),
        'description' => $server['description'],
        'episode' => collect([13.10, 13.09, 13.05, 12.11])->random(),
        'votes_count' => $faker->numberBetween(1, 5000),
        'clicks_count' => $faker->numberBetween(1, 5000),
        'banner_url' => $server['banner'],
    ];
});

$factory->afterCreating(\App\Server::class, function ($server, $faker) {
    $server->config()->save(factory(\App\ServerConfig::class)->make());
});

$factory->define(App\ServerMode::class, function (Faker $faker) {
    return [
        'tag' => $faker->text(5),
        'name' => $faker->text(9),
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\ServerClick::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\ServerVote::class, function (Faker $faker) {
    return [
        'ip_address' => $faker->ipv4,
        'created_at' => $faker->dateTimeThisMonth,
    ];
});

$factory->define(App\ServerConfig::class, function (Faker $faker) {
    return [
        'max_base_level' => rand(config('filter.exp.low-rate.min'), config('filter.exp.high-rate.max')),
        'max_job_level' => rand(99, 255),
        'max_stats' => rand(150, 255),
        'max_aspd' => rand(150, 195),
        'base_exp_rate' => rand(1, 5000),
        'job_exp_rate' => rand(1, 5000),
        'instant_cast_stat' => rand(100, 150),
        'drop_base_rate' => rand(5, 10000),
        'drop_card_rate' => rand(5, 10000),
        'drop_base_mvp_rate' => rand(20, 10000),
        'drop_card_mvp_rate' => rand(20, 10000),
        'drop_base_special_rate' => rand(20, 10000),
        'drop_card_special_rate' => rand(20, 10000),
    ];
});

$factory->define(\App\ServerReport::class, function (Faker $faker) {
    return [
        'server_id' => factory(\App\Server::class)->create()->id,
        'vote_count' => $faker->numberBetween(1, 25000),
        'click_count' => $faker->numberBetween(1, 25000),
    ];
});