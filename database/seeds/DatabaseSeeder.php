<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  $this->call(UserTableSeeder::class);
   //   factory(CodePress\CodeCategory\Models\Category::class,5)->create();
        $this->call(CategoryTableSeeder::class);
        $this->call(PostTableSeeder::class);
    }
}
