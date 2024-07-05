<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
        ]);


        $users = User::factory(100)->create();

        foreach ($users as $user) {
            if ($user->role === 'user') {
                Ticket::factory()->create(['owner_id' => $user->id]);
            }
        }

    }
}
