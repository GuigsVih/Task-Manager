<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name      = 'Guilherme';
        $user->lastname  = 'Vilela Oliveira';
        $user->email     = 'guivo11@gmail.com';
        $user->password  = bcrypt('123456');
        $user->save();
    }
}
