<?php

use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Categoria 1', 'Categoria 2', 'Categoria 3'];

        foreach ($types as $t){
            \App\PostCategory::create([
                'name' => $t,
                'user_id' => 1
            ]);
        }
    }
}
