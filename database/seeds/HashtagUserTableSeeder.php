<?php

use Illuminate\Database\Seeder;

class HashtagUserTableSeeder extends Seeder
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
            ],
            'jamal@harvard.edu' => [
                'adele',
                'taylorswift',
                'carrieunderwood',
            ],
        ];

        // now loop through the above array, creating a new pivot for each user
        // to hashtag
        foreach ($users as $email => $hashtag_terms) {
            // first get the user
            $user = \App\User::where('email', 'like', $email)->first();

            // now loop through each hashtag for this user, adding the pivot
            foreach ($hashtag_terms as $term) {
                $hashtag = \App\Hashtag::where('term', 'like', $term)->first();

                // associate this hashtag to this user
                $user->hashtags()->save($hashtag);
            }

        }
    }
}
