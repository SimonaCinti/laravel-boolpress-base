<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\InfoPost;
use Faker\Generator as Faker;

class InfoPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Create a record for everypost
        $posts = Post::all();

        foreach ($posts as $post) {
            // creazione istanza
            $newInfo = new InfoPost();

            // set valori colonne
            $newInfo->post_id = $post->id; 
            $newInfo->post_status = $faker->randomElement(['public','draft','private']);
            $newInfo->comment_status = $faker->randomElement(['public', 'private', 'close']);
            // salvataggio
            $newInfo->save();
        }
    }
}
