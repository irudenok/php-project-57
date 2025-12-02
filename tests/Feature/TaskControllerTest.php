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

    public function test_index(): void
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->actingAs($this->user)->get(route('tasks.create'));
        $response->assertOk();
    }

    public function test_store(): void
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

    public function test_show(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
    }

    public function test_edit(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->get(route('tasks.edit', $task));
        $response->assertOk();
    }

    public function test_update(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $data = ['name' => 'Updated Task', 'status_id' => $this->status->id];
        $response = $this->actingAs($this->user)->patch(route('tasks.update', $task), $data);
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => $data['name']]);
    }

    public function test_destroy(): void
    {
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($this->user)->delete(route('tasks.destroy', $task));
        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_destroy_only_by_creator(): void
    {
        $otherUser = User::factory()->create();
        $task = Task::factory()->create(['created_by_id' => $this->user->id]);
        $response = $this->actingAs($otherUser)->delete(route('tasks.destroy', $task));
        $response->assertForbidden();
    }

    public function test_store_requires_auth(): void
    {
        $response = $this->post(route('tasks.store'), ['name' => 'Test', 'status_id' => $this->status->id]);
        $response->assertRedirect(route('login'));
    }
}
