<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_task()
    {
        $response = $this->post('/tasks', [
            'title' => 'New Task',
            'status' => 'pending',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'status' => 'pending',
        ]);
    }
}
