<?php

use Illuminate\Database\Seeder;
use CodePress\CodePost\Models\Post;
use CodePress\CodePost\Models\Comment;

class PostTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        factory(Post::class, 10)->create()->each(function($post){
            foreach(range(1, 10) as $value){
                $post->comments()->save(factory(Comment::class)->make());
            }
        });
        $this->command->info("Finished Seeders!");
    }

}
