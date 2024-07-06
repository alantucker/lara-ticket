<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use withFaker, RefreshDatabase;


    /**
     * Test that an authenticated user can view the tickets page.
     *
     * @return void
     */
    public function test_authenticated_user_can_view_tickets_page(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/tickets');

        $response->assertOk();
    }


    /**
     * Test that an authenticated user can create a new ticket.
     *
     * @return void
     */
    public function test_authenticated_user_can_create_ticket(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(["id" => 1, "name" => "Bug"]);

        $this->actingAs($user)
            ->post('/tickets', [
                'owner_id' => $user->id,
                'category_id' => $category->id,
                'body' => $this->faker->sentence(),
                'subject' => $this->faker->paragraph(),
            ]);

        $this->assertDatabaseHas('tickets', [
            "owner_id" => $user->id,
            "category_id" => $category->id,
        ]);
    }
}
