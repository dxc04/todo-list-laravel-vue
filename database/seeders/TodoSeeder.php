<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'tester',
            'email' => 'test@test.com'
        ]);

        Todo::factory()
            ->times(20)
            ->for($user)
            ->create();

    }
}
