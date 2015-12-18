<?php

use Illuminate\Database\Seeder;

class PostUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first, create an array of all the users we want to associate posts
        // with
        // the *key* will be the user email and the *value* will be an array of
        // post URIs
        $users =[
            'jill@harvard.edu' => [
                'https://twitter.com/AvrilLavigne/status/676145834073923584',
                'https://www.instagram.com/p/_VMOIoMxSM/',
                'https://www.instagram.com/p/_VP2-akr-5/',
                'https://www.instagram.com/p/_V9W_EuHen/',
                'https://www.instagram.com/p/_WApP6AmaV/',
                'https://twitter.com/giphy/status/676562118724870144',
                'https://www.instagram.com/p/_WEx0ypyJT/',
                'https://www.instagram.com/p/_WCDdVi1Hm/',
                'https://www.instagram.com/p/_XesJctYqn/',
                'https://twitter.com/VictoriasSecret/status/674434163894788096',
                'https://www.instagram.com/p/_XgAv8NYtr/',
                'https://www.instagram.com/p/_Xgv2aB21k/',
                'https://twitter.com/ScreamQueens/status/676945628711231491',
                'https://twitter.com/GalGadot/status/677171651528687616',
                'https://www.instagram.com/p/_X1vQFx4k2/',
                'https://twitter.com/IGN/status/676902260752814080',
                'https://twitter.com/Variety/status/677154500742799360',
                'https://twitter.com/sweetyhigh/status/677292269712621568',
                'https://www.instagram.com/p/_bRimhsNhO/',
                'https://twitter.com/taylorswift13/status/676085322061512704',
            ],
            'jamal@harvard.edu' => [
                'https://twitter.com/CapitalOfficial/status/676729488315666436',
                'https://twitter.com/taylornation13/status/675632059474317312',
                'https://www.instagram.com/p/_WCDdVi1Hm/',
                'https://twitter.com/taylornation13/status/675259625554485248',
                'https://www.instagram.com/p/_WD2ziRjZA/',
                'https://www.instagram.com/p/_V40ksFG6s/',
                'https://twitter.com/VictoriasSecret/status/674434163894788096',
                'https://www.instagram.com/p/_Vyaz1D2fA/',
                'https://www.instagram.com/p/_XdHBaOn6y/',
                'https://twitter.com/BatmanvSuperman/status/674045753606574082',
                'https://www.instagram.com/p/_Xj1-zGvr7/',
                'https://twitter.com/MaximMag/status/677150484357058560',
                'https://www.instagram.com/p/_Xt8UWTEYM/',
                'https://www.instagram.com/p/_XeP6PwiUj/',
                'https://twitter.com/ABCFpll/status/676533514225893378',
                'https://www.instagram.com/p/_a7joUxUDN/',
                'https://twitter.com/GalGadot/status/677171651528687616',
                'https://www.instagram.com/p/_Xgv2aB21k/',
                'https://www.instagram.com/p/_a_WlAgms-/',
                'https://www.instagram.com/p/_bRimhsNhO/',
            ],
        ];

        // now loop through the above array, creating a new pivot for each user
        // to post
        foreach ($users as $email => $post_uris) {
            // first get the user
            $user = \App\User::where('email', 'like', $email)->first();

            // now loop through each post for this user, adding the pivot
            foreach ($post_uris as $uri) {
                $post = \App\Post::where('uri', 'like', $uri)->first();

                // associate this hashtag to this user
                $user->posts()->save($post);
            }
        }
    }
}
