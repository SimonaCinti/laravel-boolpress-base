<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Comment;
use Faker\Generator as Faker;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Get all posts  - 3x comments
        $posts =  Post::all();

        for ($i = 0; $i < 3; $i++){

            foreach ($posts as $post) {
                // Creazione istanza
                $newComment = new Comment();
                // Dati delle colonne 
                $newComment->post_id = $post->id; // foreing key 
                $newComment->author = $faker->userName();
                $newComment->text = $faker->sentence(10);

                // Salvataggio
                $newComment->save();
            }
        }
    }
}
