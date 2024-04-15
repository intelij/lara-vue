<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Todo;
use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a user for authentication
        $this->user = User::factory()->create();
    }

    /** @test */
    public function authenticated_user_can_create_todo()
    {
        /* Remove this line once the issue is resolved */
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'New Todo',
            'description' => 'Add any other fields you want to include in the request',
            'completed' => false,
        ];

        $response = $this->actingAs($this->user)
                        ->postJson('/api/todos', $data);

        $response->assertStatus(201)
                // ->assertJson($data)
                ->assertJsonStructure([
                    'message',
                    'todo' => [
                        'id',
                        'title',
                        'completed',
                        'description',
                    ]
                ]);

        $responseContent = $response->getContent();
        $this->assertNotNull($responseContent, 'Response content is null');
        $this->assertJson($responseContent, 'Response is not valid JSON');
    }

    /** @test */
    public function authenticated_user_can_update_todo()
    {
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);

        $updatedData = [
            'title' => 'Updated Todo',
            'completed' => false,
        ];

        $response = $this->actingAs($this->user)
                         ->putJson("/api/todos/{$todo->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJson($updatedData);
    }

    /** @test */
    public function authenticated_user_can_show_todo()
    {
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
                         ->getJson("/api/todos/{$todo->id}");

        $response->assertStatus(200)
                 ->assertJson($todo->toArray());
    }

    /** @test */
    public function authenticated_user_can_delete_todo()
    {
        $todo = Todo::factory()->create(['user_id' => $this->user->id]);

        $response = $this->actingAs($this->user)
                         ->deleteJson("/api/todos/{$todo->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
