<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategory;
use App\Repositories\Contracts\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Auth\Access\AuthorizationException;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository $categoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function index(request $request): Collection
    {
        $categories = $this->categoryRepository
            ->whereSearch($request->input('search'));

        return $categories;
    }

    /**
     * @param CreateCategory $request
     * @return Category
     */
    public function store(CreateCategory $request): Category
    {
        $userId = auth()->id();
        $data = $request->validated();
        $category = $this->categoryRepository->storeCategory(collect($data), $userId);

        return $category;
    }

    /**
     * @param CreateCategory $request
     * @param int $categoryId
     * @return Category
     */
    public function update(CreateCategory $request, int $categoryId): Category
    {
        $userId = auth()->id();
        $data = $request->validated();
        $category = $this->categoryRepository->find($categoryId);

        if ($userId !== $category->user_id) {
            throw new AccessDeniedHttpException('access forbidden.');
        }

        $categoryData = $this->categoryRepository->updateCategory(collect($data), $userId, $category);

        return $category;
    }

    /**
     * @param int $categoryId
     * @return resource
     * @throws AuthorizationException
     */
    public function delete(int $categoryId)
    {
        $userId = auth()->id();
        $category = $this->categoryRepository->find($categoryId);

        if ($userId !== $category->user_id) {
            throw new AuthorizationException('Cannot delete yourself.');
        }

        $this->categoryRepository->deleteCategory($category);

        return response([], 204);
    }
}
