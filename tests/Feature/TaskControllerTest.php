<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $status;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = [
            'name' => 'Test Task',
            'description' => 'Test Description',
            'status_id' => $this->status->id,
        ];
        $response = $this->actingAs($this->user)->post(route('tasks.store'), $data);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'name' => $data['name'],
            'created_by_id' => $this->user->id,
        ]);
    }

    public function testShow(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
    }

    public function testEdit(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $data = ['name' => 'Updated Task', 'status_id' => $this->status->id];
        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $data);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => $data['name']]);
    }

    public function testDestroy(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function testDestroyOnlyByCreator(): void
    {
        $otherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($otherUser)->delete(route('tasks.destroy', $task));
        $response->assertForbidden();
    }

    public function testStoreRequiresAuth(): void
    {
        $response = $this->post(route('tasks.store'), ['name' => 'Test', 'status_id' => $this->status->id]);
        $response->assertRedirect(route('login'));
    }
}
