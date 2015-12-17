<?php

use Illuminate\Database\Seeder;

class HashtagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // first, create an array of all the users we want to associate hashtags
        // with
        // the *key* will be the user email and the *value* will be an array of
        // hashtags
        $users =[
            'jill@harvard.edu' => [
                'taylorswift',
                'katyperry',
                'mileycyrus',
                'arrow',
                'jlaw',
                'forceawakens',
                'vsfashionshow',
                'xmenapocalypse',
                'flash',
                '1989tourmelbourne',
                'jessicajones',
                '1989worldtourlive',
            ],
            'jamal@harvard.edu' => [
                'adele',
                'taylorswift',
                'carrieunderwood',
                'flarrow',
                'starwars',
                'jenniferlawrence',
                'xmen',
                'supergirl',
                'batmanvsuperman',
                'grammys',
                'screamqueens',
                'girlsgeneration',
            ],
        ];

        // now loop through the above array, creating a new hashtag and
        // association with the user
        foreach ($users as $email => $hashtag_terms) {
            // first get the user
            $user = \App\User::where('email', 'like', $email)->first();

            // now loop through each hashtag and associate it with this user
            foreach ($hashtag_terms as $term) {
                $hashtag = new \App\Hashtag();
                $hashtag->term = $term;
                $hashtag->user_id = $user->id;
                $hashtag->save();
            }
        }
    }
}
