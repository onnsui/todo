<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Task;
use App\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->actingAs($this->user);
    }
    /**
     * @test
     */
    public function タスク一覧取得のテスト()
    {
        $tasks = factory(Task::class, 5)->create();

        $res = $this->getJson(route('task-index'));
        $res->assertStatus(200);

        $this->assertEquals($tasks->count(), count(json_decode($res->content(), true)));
    }

    /**
     * @test
     */
    public function 検索条件付き一覧取得のテスト()
    {
        $searchKeyword = '12345678';
        $tasks = factory(Task::class, 2)->create([
            'title' => $searchKeyword,
        ]);

        //　検索でヒットしないCompany
        factory(Task::class, 2)->create([
            'title' => 'zzzzzzzz'
        ]);

        $res = $this->getJson(route('task-index', [
            'search' => $searchKeyword
        ]));
        $res->assertStatus(200);

        $this->assertEquals($tasks->count(), count(json_decode($res->content(), true)));
    }

    /**
     * @test
     */
    public function タスク作成のテスト()
    {
        $task = factory(Task::class)->make()->toArray();
        $categoryA = factory(Category::class)->create();
        $categoryB = factory(Category::class)->create();
        $params = [
          'title' => $task['title'],
          'content' => $task['content'],
          'due_date' => $task['due_date'],
          'status' => $task['status'],
          'category_ids' => [$categoryA->id, $categoryB->id],
        ];
        $res = $this->postJson(route('task-store'), $params);

        $res->assertStatus(201);
        $createdTask = Task::first();

        $this->assertEquals($params['title'], $createdTask->title);
        $this->assertEquals($params['content'], $createdTask->content);
        $this->assertEquals($params['due_date'], $createdTask->due_date);
        $this->assertEquals($params['status'], $createdTask->status);
        $this->assertEquals($this->user->id, $createdTask->user_id);
    }
}
