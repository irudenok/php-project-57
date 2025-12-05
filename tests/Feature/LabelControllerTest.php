<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelControllerTest extends TestCase
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
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = ['name' => 'Test Label'];
        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $data);
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $data = ['name' => 'Updated Label'];
        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDestroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }

    public function testDestroyWithTasks(): void
    {
        $label = Label::factory()->create();
        $task = Task::factory()->create();
        $task->labels()->attach($label);
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }

    public function testStoreRequiresAuth(): void
    {
        $response = $this->post(route('labels.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }
}
