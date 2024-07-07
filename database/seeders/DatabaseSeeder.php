<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Reply;
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
        User::factory(25)->create();

        Category::factory(7)->create();

        $randomUsers = User::getRandomUsers(5);

        foreach ($randomUsers as $user) {
            $ticket = Ticket::factory()->create([
                'owner_id' => $user->id
            ]);

            $replies = Reply::factory(1)->create([
                'user_id' => $user->id,
                'ticket_id' => $ticket->id
            ]);

            foreach ($replies as $reply) {
                $ticket->status = 'open';
                $ticket->save();
            }
        }
    }
}
