<?php

namespace App\Repositories\Contracts;

use App\Category;
use Illuminate\Support\Collection;

/**
 * Interface CategoryRepository
 *
 * @package namespace App\Repositories\Contracts;
 */
interface CategoryRepository
{

    /**
     * カテゴリーをフリーワード検索をする
     * 検索フィールドはtitle
     *
     * @param string $search
     * @return Category
     */
    public function whereSearch(string $search = null);

    /**
     * カテゴリを作成する
     *
     * @param Collection $data
     * @param int $userId
     * @return Category
     */
    public function storeCategory(Collection $data, int $userId);

    /**
     * カテゴリを編集する
     *
     * @param Collection $data
     * @param int $userId
     * @param Category $category
     * @return Category
     */
    public function updateCategory(Collection $data, int $userId, Category $category);

    /**
     * カテゴリを削除する
     *
     * @param Category $category
     * @return Category
     */
    public function deleteCategory(Category $category);

    /**
     * カテゴリをID検索する
     *
     * @param int $categoryId
     * @return Category
     */
    public function find(int $categoryId);
}
