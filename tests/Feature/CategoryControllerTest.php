<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\Category;

class CategoryControllerTest extends TestCase
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
    public function カテゴリ一覧取得のテスト()
    {
        $categories = factory(Category::class, 5)->create();

        $res = $this->getJson(route('category-index'));
        $res->assertStatus(200);

        $this->assertEquals($categories->count(), count(json_decode($res->content(), true)));
    }

    /**
     * @test
     */
    public function 検索条件付きカテゴリ一覧取得のテスト()
    {
        $searchKeyword = '12345678';
        $categories = factory(Category::class, 2)->create([
            'title' => $searchKeyword,
        ]);

        //　検索でヒットしないCompany
        factory(Category::class, 2)->create([
            'title' => 'zzzzzzzz'
        ]);

        $res = $this->getJson(route('category-index', [
            'search' => $searchKeyword
        ]));
        $res->assertStatus(200);

        $this->assertEquals($categories->count(), count(json_decode($res->content(), true)));
    }

    /**
     * @test
     */
    public function カテゴリ作成のテスト()
    {
        $category = factory(Category::class)->make()->toArray();
        $params = [
            'title' => $category['title'],
        ];
        $res = $this->postJson(route('category-store'), $params);

        $res->assertStatus(201);
        $createdCategory = Category::first();

        $this->assertEquals($category['title'], $createdCategory->title);
    }

    /**
     * @test
     */
    public function カテゴリ編集のテスト()
    {
        $category = factory(Category::class)->create([
            'user_id' => $this->user->id,
        ]);
        $params = [
            'title' => str_repeat('a', 255),
        ];
        $res = $this->putJson(route('category-update', $category->id), $params);

        $res->assertStatus(200);
        $editedCategory = Category::first();

        $this->assertEquals($params['title'], $editedCategory->title);
    }

    /**
     * @test
     */
    public function タスク削除のテスト()
    {
        $category = factory(Category::class)->create([
            'user_id' => $this->user->id,
        ]);
        $res = $this->delete(route('category-delete', $category->id));

        $res->assertStatus(204);

        $this->assertNull(Category::find($category->id));
    }
}
