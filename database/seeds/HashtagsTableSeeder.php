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
        $hashtag_terms = [
            'taylorswift',
            'carrieunderwood',
            'katyperry',
            'adele',
            'mileycyrus',
        ];

        foreach ($hashtag_terms as $term) {
            $hashtag = new \App\Hashtag();
            $hashtag->term = $term;
            $hashtag->save();
        }
    }
}
