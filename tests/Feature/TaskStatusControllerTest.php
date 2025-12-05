<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('task_statuses.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['name' => 'Test Status'];
        $response = $this->actingAs($this->user)->post(route('task_statuses.store'), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testEdit(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->get(route('task_statuses.edit', $status));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $status = TaskStatus::factory()->create();
        $data = ['name' => 'Updated Status'];
        $response = $this->actingAs($this->user)->patch(route('task_statuses.update', $status), $data);
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroy(): void
    {
        $status = TaskStatus::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }

    public function testDestroyWithTasks(): void
    {
        $status = TaskStatus::factory()->create();
        Task::factory()->create(['status_id' => $status->id]);
        $response = $this->actingAs($this->user)->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id]);
    }

    public function testStoreRequiresAuth(): void
    {
        $response = $this->post(route('task_statuses.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }
}
