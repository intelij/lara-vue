<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Todo;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function it_returns_all_todos_for_authenticated_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Authenticate as the user

        $todos = Todo::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->get('/api/todos');

        $response->assertStatus(200)
            ->assertJsonCount(3, 'todos');
    }

    /** @test */
    public function it_returns_single_todo()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Authenticate as the user

        $todo = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->get("/api/todos/{$todo->id}");

        $response->assertStatus(200)
            ->assertJson($todo->toArray());
    }

    /** @test */
    public function it_creates_new_todo()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Authenticate as the user

        $data = Todo::factory()->raw(['user_id' => $user->id, 'completed' => true]);

        $response = $this->post('/api/todos', $data);

        $response->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_updates_existing_todo()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Authenticate as the user

        $todo = Todo::factory()->create(['user_id' => $user->id]);
        $updatedData = ['title' => 'Updated Todo', 'completed' => true];

        $response = $this->put("/api/todos/{$todo->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson($updatedData);
    }

    /** @test */
    public function it_deletes_existing_todo()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // Authenticate as the user

        $todo = Todo::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/api/todos/{$todo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
