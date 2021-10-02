<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create()->each(function ($user) {
            Todo::factory(5)->create([
               'user_id' => $user->id
           ])->each(function ($todo) {
               Item::factory(10)->create([
                   'todo_id' => $todo->id
                ]);
           });
        });
    }
}
