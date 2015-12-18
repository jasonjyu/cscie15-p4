<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // posts data exported using phpMyAdmin
        $posts_data = [
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/AvrilLavigne/status/676145834073923584', 'source_time' => '2015-12-13 21:05:03'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_VMOIoMxSM/', 'source_time' => '2015-12-15 23:35:41'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_VP2-akr-5/', 'source_time' => '2015-12-16 00:07:29'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/CapitalOfficial/status/676729488315666436', 'source_time' => '2015-12-15 11:44:17'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/taylornation13/status/675632059474317312', 'source_time' => '2015-12-12 11:03:30'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/taylornation13/status/675259625554485248', 'source_time' => '2015-12-11 10:23:35'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_V9W_EuHen/', 'source_time' => '2015-12-16 06:45:04'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_WApP6AmaV/', 'source_time' => '2015-12-16 07:13:46'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/giphy/status/676562118724870144', 'source_time' => '2015-12-15 00:39:13'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_WEx0ypyJT/', 'source_time' => '2015-12-16 07:49:54'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_WCDdVi1Hm/', 'source_time' => '2015-12-16 07:26:05'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_WD2ziRjZA/', 'source_time' => '2015-12-16 07:41:50'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_V40ksFG6s/', 'source_time' => '2015-12-16 06:05:25'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/VictoriasSecret/status/674434163894788096', 'source_time' => '2015-12-09 03:43:29'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_Vyaz1D2fA/', 'source_time' => '2015-12-16 05:09:28'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_XdHBaOn6y/', 'source_time' => '2015-12-16 20:41:45'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_XesJctYqn/', 'source_time' => '2015-12-16 20:55:33'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_XgAv8NYtr/', 'source_time' => '2015-12-16 21:07:06'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_Xgv2aB21k/', 'source_time' => '2015-12-16 21:13:32'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/ScreamQueens/status/676945628711231491', 'source_time' => '2015-12-16 02:03:09'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/GalGadot/status/677171651528687616', 'source_time' => '2015-12-16 17:01:17'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/BatmanvSuperman/status/674045753606574082', 'source_time' => '2015-12-08 02:00:05'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_Xj1-zGvr7/', 'source_time' => '2015-12-16 21:40:35'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/MaximMag/status/677150484357058560', 'source_time' => '2015-12-16 15:37:10'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_Xt8UWTEYM/', 'source_time' => '2015-12-16 23:08:50'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_XeP6PwiUj/', 'source_time' => '2015-12-16 20:51:42'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_X1vQFx4k2/', 'source_time' => '2015-12-17 00:16:57'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/IGN/status/676902260752814080', 'source_time' => '2015-12-15 23:10:49'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/Variety/status/677154500742799360', 'source_time' => '2015-12-16 15:53:08'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/sweetyhigh/status/677292269712621568', 'source_time' => '2015-12-17 01:00:35'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/taylorswift13/status/676085322061512704', 'source_time' => '2015-12-13 17:04:36'],
            // ['provider' => 'twitter', 'uri' => 'https://twitter.com/ABCFpll/status/676533514225893378', 'source_time' => '2015-12-14 22:45:33'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_a7joUxUDN/', 'source_time' => '2015-12-18 05:05:31'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_a_WlAgms-/', 'source_time' => '2015-12-18 05:38:41'],
            // ['provider' => 'instagram', 'uri' => 'https://www.instagram.com/p/_bRimhsNhO/', 'source_time' => '2015-12-18 08:17:37'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/AvrilLavigne/status/676145834073923584','source_time' => '2015-12-13 21:05:03','text' => 'Happy 26th Birthday to the sweetest sweetheart taylorswift xoxoxo <a href="https://www.instagram.com/p/_PxZA1I4CD/" target="_blank" rel="nofollow">instagram.com/...p/_PxZA1I4CD/</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_VMOIoMxSM/','source_time' => '2015-12-15 23:35:41','text' => 'How is she so beautiful?♡♡♡
          (I\'m going to Target now to buy wrapping paper)
          #bambi #pastel #like4like #selenagomez #taylorswift #arianagrande #indie #pastel #pinkbambi #flowers #onedirection #mitam #madeintheam  #littlemix #arianagrande #grande #ariana'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_VP2-akr-5/','source_time' => '2015-12-16 00:07:29','text' => '{ #KatyPerry } *me when someone bumps into me and says sorry
          '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/CapitalOfficial/status/676729488315666436','source_time' => '2015-12-15 11:44:17','text' => '@katyperry has been nominated for Best Female in the '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/taylornation13/status/675632059474317312','source_time' => '2015-12-12 11:03:30','text' => 'Long live... '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/taylornation13/status/675259625554485248','source_time' => '2015-12-11 10:23:35','text' => 'Dancing, castles, heartbreak... All a part of THE DREAM that is life as a new romantic! ❤️ <a href="https://twitter.com/search?q=%231989TourMelbourne" target="_blank">#1989TourMelbourne</a> <a href="https://pbs.twimg.com/ext_tw_video_thumb/675259111848693760/pu/img/T2o5frXxqYhcjYO2.jpg" target="_blank">pic.twitter.c...om/J9VeBThru7</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_V9W_EuHen/','source_time' => '2015-12-16 06:45:04','text' => 'Shake it off '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_WApP6AmaV/','source_time' => '2015-12-16 07:13:46','text' => '#wcw '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/giphy/status/676562118724870144','source_time' => '2015-12-15 00:39:13','text' => 'The red carpet can be a little overwhelming for new, young stars like BB-8 <a href="https://twitter.com/search?q=%23ForceAwakens" target="_blank">#ForceAwakens</a> <a href="https://twitter.com/search?q=%23giphycam" target="_blank">#giphycam</a> <a href="http://twitter.com/giphy/status/676562118724870144/photo/1" target="_blank" rel="nofollow">pic.twitter.c...om/fNT9CkXSCE</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_WEx0ypyJT/','source_time' => '2015-12-16 07:49:54','text' => 'I am SO excited for Legends of Tomorrow '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_WCDdVi1Hm/','source_time' => '2015-12-16 07:26:05','text' => 'Unnnnngghhhh this girl. #wcw #womancrushwednesday #willaholland #speedy #arrow'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_WD2ziRjZA/','source_time' => '2015-12-16 07:41:50','text' => '❤️ #victoriassecret #vsfashionshow #style #instastyle #fashionable #fashion #fashionblogger #styleblogger #love #loveit #hair #makeup #candiceswanepoel #angels #angel'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_V40ksFG6s/','source_time' => '2015-12-16 06:05:25','text' => 'Miranda at the vsfashionshow 2008 fittings, she\'s so lovely! '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/VictoriasSecret/status/674434163894788096','source_time' => '2015-12-09 03:43:29','text' => 'You\'re up, <a href="https://twitter.com/angelcandice" target="_blank">@angelcandice</a>!! <a href="https://twitter.com/search?q=%23VSFashionShow" target="_blank">#VSFashionShow</a> <a href="https://pbs.twimg.com/media/CVwSSyHWcAA3A7u.jpg" target="_blank">pic.twitter.c...om/Uj8gbq5NBM</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_Vyaz1D2fA/','source_time' => '2015-12-16 05:09:28','text' => '#xmenapocalypse #xmen #sequeal #2016'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_XdHBaOn6y/','source_time' => '2015-12-16 20:41:45','text' => 'Today I\'m going to Melbourne! I stopped by the beach resort & Albury for two days '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_XesJctYqn/','source_time' => '2015-12-16 20:55:33','text' => 'Gigi on Exotic Butterflies segment with a performance of Ellie Goulding. '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_XgAv8NYtr/','source_time' => '2015-12-16 21:07:06','text' => 'Alessandra on Fireworks segment with a performance of The Weeknd. '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_Xgv2aB21k/','source_time' => '2015-12-16 21:13:32','text' => 'We had, a beautiful magic love there, what a sad beautiful tragic love affair. #taylorswift #taylurking'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/ScreamQueens/status/676945628711231491','source_time' => '2015-12-16 02:03:09','text' => 'Going a bit insane without a new <a href="https://twitter.com/search?q=%23ScreamQueens" target="_blank">#ScreamQueens</a> today? Here\'s something to calm the madness: <a href="http://fox.tv/WatchScrmQns" target="_blank" rel="nofollow">fox.tv/WatchScrmQns</a> <a href="http://twitter.com/ScreamQueens/status/676945628711231491/photo/1" target="_blank" rel="nofollow">pic.twitter.c...om/byc1pjldc9</a>'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/GalGadot/status/677171651528687616','source_time' => '2015-12-16 17:01:17','text' => 'I welcome you into my dream. Here\'s an exclusive new Wonder Woman banner for <a href="https://twitter.com/BatmanvSuperman" target="_blank">@BatmanvSuperman</a>. <a href="https://pbs.twimg.com/media/CWXL_lVUwAAtvr8.jpg" target="_blank">pic.twitter.c...om/3wYP2KfWI4</a>'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/BatmanvSuperman/status/674045753606574082','source_time' => '2015-12-08 02:00:05','text' => 'The battle begins March 2016. <a href="https://twitter.com/search?q=%23BatmanvSuperman" target="_blank">#BatmanvSuperman</a> <a href="http://twitter.com/BatmanvSuperman/status/674045753606574082/photo/1" target="_blank" rel="nofollow">pic.twitter.c...om/RODmw0l2xq</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_Xj1-zGvr7/','source_time' => '2015-12-16 21:40:35','text' => 'Oooooh que bella '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/MaximMag/status/677150484357058560','source_time' => '2015-12-16 15:37:10','text' => 'Arrow\'s Katrina Law talks girl crushes, Chinese food, and getting her attention <a href="http://MAXIMM.AG/lWsGR7O" target="_blank" rel="nofollow">MAXIMM.AG/lWsGR7O</a> <a href="https://pbs.twimg.com/media/CWW4xwHXIAEr6rG.jpg" target="_blank">pic.twitter.c...om/2YntBFvZ5y</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_Xt8UWTEYM/','source_time' => '2015-12-16 23:08:50','text' => 'Official \'CW\'s Legends Of Tomorrow\' Character Posters!'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_XeP6PwiUj/','source_time' => '2015-12-16 20:51:42','text' => '#katiecassidy #Coltonhaynes #arrow #flarrow #fandom #oliverqueen #laurellance #arsenal #royharper'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_X1vQFx4k2/','source_time' => '2015-12-17 00:16:57','text' => 'Jensen and Jared fangirling over Arrow. '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/IGN/status/676902260752814080','source_time' => '2015-12-15 23:10:49','text' => 'BB-8 wasn\'t the only droid rocking the red carpet last night! Check out this dynamic duo. <a href="https://twitter.com/search?q=%23StarWars" target="_blank">#StarWars</a> <a href="https://twitter.com/search?q=%23ForceAwakens" target="_blank">#ForceAwakens</a> <a href="https://amp.twimg.com/v/08a8222b-ecb5-4a3e-94b8-bc56334d9e72" target="_blank" rel="nofollow">amp.twimg.com/v/08a8222b-ecb…</a>'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/Variety/status/677154500742799360','source_time' => '2015-12-16 15:53:08','text' => 'WATCH: <a href="https://twitter.com/search?q=%23ForceAwakens" target="_blank">#ForceAwakens</a> cast, <a href="https://twitter.com/jimmyfallon" target="_blank">@jimmyfallon</a>, <a href="https://twitter.com/theroots" target="_blank">@theroots</a> sing <a href="https://twitter.com/search?q=%23StarWars" target="_blank">#StarWars</a> theme music <a href="http://bit.ly/1RRHNQS" target="_blank" rel="nofollow">bit.ly/1RRHNQS</a> <a href="https://pbs.twimg.com/media/CWW77HsUsAIaDKS.jpg" target="_blank">pic.twitter.c...om/RIxrJUzoqr</a>'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/sweetyhigh/status/677292269712621568','source_time' => '2015-12-17 01:00:35','text' => 'TSWIFT DOPPELGANGER || Can you believe she looks as good as <a href="https://twitter.com/search?q=%23TaylorSwift" target="_blank">#TaylorSwift</a>? '],
            ['provider' => 'twitter','uri' => 'https://twitter.com/taylorswift13/status/676085322061512704','source_time' => '2015-12-13 17:04:36','text' => 'Thank you so much for all the birthday wishes. I have a little surprise for you. <a href="https://twitter.com/search?q=%231989WorldTourLIVE" target="_blank">#1989WorldTourLIVE</a> <a href="https://twitter.com/applemusic" target="_blank">@applemusic</a> <a href="https://amp.twimg.com/v/8bd5ae39-20c8-43f2-aa49-aaedfce0441e" target="_blank" rel="nofollow">amp.twimg.com/v/8bd5ae39-20c…</a>'],
            ['provider' => 'twitter','uri' => 'https://twitter.com/ABCFpll/status/676533514225893378','source_time' => '2015-12-14 22:45:33','text' => 'They’re all hiding something. But what? Find out <a href="https://twitter.com/search?q=%23January12" target="_blank">#January12</a>, <a href="https://twitter.com/search?q=%235YearsForward" target="_blank">#5YearsForward</a> with the <a href="https://twitter.com/search?q=%23PrettyLittleLiars" target="_blank">#PrettyLittleLiars</a>! <a href="https://amp.twimg.com/v/806664f7-13c7-401e-9dc7-5be8166d87bf" target="_blank" rel="nofollow">amp.twimg.com/v/806664f7-13c…</a>'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_a7joUxUDN/','source_time' => '2015-12-18 05:05:31','text' => '@caradelevingne ❤️'],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_a_WlAgms-/','source_time' => '2015-12-18 05:38:41','text' => 'Who\'s your fav Angel? '],
            ['provider' => 'instagram','uri' => 'https://www.instagram.com/p/_bRimhsNhO/','source_time' => '2015-12-18 08:17:37','text' => 'Happy Birthday to Miss Ashley Victoria Benson, a real sunshine in many people\'s life ❤️ I love you for who you are, absolutely beautiful and kind with your fans. More than that, you are the funniest idol I\'ve ever seen. '],
        ];

        // create a new post for each item in the data array
        foreach ($posts_data as $post_data) {
            \App\Post::firstOrCreate($post_data);
        }
    }
}
