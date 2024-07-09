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
    public function test_authenticated_user_can_create_a_ticket(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        $ticketData = [
            'category_id' => $category->id,
            'subject' => $this->faker->sentence(),
            'body' => $this->faker->text(),
            'priority' => 1,
            'owner_id' => $user->id,
        ];

        $this->actingAs($user)
            ->post('/tickets', $ticketData);

        $this->assertDatabaseHas('tickets', $ticketData);
    }

}
