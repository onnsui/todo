<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CategoryRepository;
use App\Category;
use Illuminate\Support\Collection;

class CategoryRepositoryEloquent implements CategoryRepository
{
    /**
     * @param string $search
     * @return Category
     */
    public function whereSearch(string $search = null)
    {
        if (!$search) {
            return Category::all();
        }
        $categories = Category::where('title', 'like', "%${search}%")
            ->get();

        return $categories;
    }

    /**
     * @param Collection $data
     * @param int $userId
     * @return Category
     */
    public function storeCategory(Collection $data, int $userId)
    {
        $param = $data->merge(['user_id' => $userId]);
        return Category::create($param->all());
    }

    /**
     * @param Collection $data
     * @param int $userId
     * @param Category $category
     * @return Category
     */
    public function updateCategory(Collection $data, int $userId, Category $category)
    {
        \DB::transaction(function () use ($category, $data) {
            $category->fill($data->toArray())->save();
        });
        return $category;
    }

    /**
     * @param Category $category
     */
    public function deleteCategory(Category $category)
    {
        \DB::transaction(function () use ($category) {
            $category->tasks()->detach();
            $category->delete();
        });
    }

    /**
     * @param int $categoryId
     * @return Category
     */
    public function find(int $categoryId)
    {
        $task = Category::findOrFail($categoryId);
        return $task;
    }
}
