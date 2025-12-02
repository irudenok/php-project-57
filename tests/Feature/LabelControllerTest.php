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

    public function test_index(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function test_create(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function test_store(): void
    {
        $data = ['name' => 'Test Label'];
        $response = $this->actingAs($this->user)->post(route('labels.store'), $data);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $data);
    }

    public function test_edit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function test_update(): void
    {
        $label = Label::factory()->create();
        $data = ['name' => 'Updated Label'];
        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', $data);
    }

    public function test_destroy(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseMissing('labels', ['id' => $label->id]);
    }

    public function test_destroy_with_tasks(): void
    {
        $label = Label::factory()->create();
        $task = Task::factory()->create();
        $task->labels()->attach($label);
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertRedirect(route('labels.index'));
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }

    public function test_store_requires_auth(): void
    {
        $response = $this->post(route('labels.store'), ['name' => 'Test']);
        $response->assertRedirect(route('login'));
    }
}
