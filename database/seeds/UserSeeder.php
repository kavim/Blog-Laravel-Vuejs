<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'email' => 'tester@tester.com',
            'name'  => 'tester',
            'lastname'  => 'testerson',
            'user_type_id' => 2,
            'password' => bcrypt('123123123')
        ]);

        // Exibe uma informação no console durante o processo de seed
        $this->command->info('User Create \n\n');
    }
}
