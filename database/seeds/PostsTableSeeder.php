<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * ? Funzione di reset totale del database solo se richiesta
         * ? Post::truncate()
         */

        Post::truncate();
        
         /**
         * ! Basic way
         * Costruzione dati a mano
         */

         // Popolazione dei dati

         $posts = [
             [
                 'title' => 'My post lorem by Seed',
                 'body' => 'My body lorem by Seed. Lorem ipsum dolor',
             ],
             [
                 'title' => 'My post lorem by Seed 2',
                 'body' => 'My body lorem by Seed 2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem enim sint quia fugit maxime optio quae repudiandae dignissimos dicta voluptate excepturi dolor, maiores reprehenderit expedita?',
             ],
             [
                 'title' => 'My post lorem by Seed 3',
                 'body' => 'My body lorem by Seed 3. Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae animi debitis impedit ducimus maiores deleniti!',
             ],
         ];

         // Foreach sull'array $posts
        foreach ($posts as $post) {
            
            // Creazione istanza da modello 
                $newPost = new Post();
            
            // popolazione dell'istanza
                $newPost->title = $post['title'];
                $newPost->body = $post['body'];
                $newPost->slug= Str::slug($post['title'], '-');
            
            //save record nel db
                $newPost->save();
        }
    }
}
