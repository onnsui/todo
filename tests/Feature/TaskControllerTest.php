<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    /**
     * @test
     */
    public function タスク一覧取得のテスト()
    {
        $tasks = factory(Task::class, 5)->create();

        $res = $this->getJson(route('task-index'));
        $res->assertStatus(200);
    }
}
