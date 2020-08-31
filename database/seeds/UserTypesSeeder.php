<?php

use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Regular', 'Editor', 'Admin'];

        foreach ($types as $t){
            \App\UserType::create(['name' => $t]);
        }
    }
}
