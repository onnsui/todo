<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Task;
use App\Category;
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
        $category = factory(Category::class)->create();
        $params = [
          'title' => $task['title'],
          'content' => $task['content'],
          'due_date' => $task['due_date'],
          'status' => $task['status'],
          'category_id' => $category->id,
        ];
        $res = $this->postJson(route('task-store'), $params);

        $res->assertStatus(201);
        $task = Task::find(1);
        foreach ($params as $key => $param)
        {
            $this->assertEquals($params[$key], $task->$key);
        }
        $this->assertEquals(1, $task->user_id);
    }
}

