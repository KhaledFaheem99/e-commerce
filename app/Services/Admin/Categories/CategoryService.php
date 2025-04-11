<?php

namespace App\Services\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Categories\CategoryRepository;

class CategoryService extends Controller {

    protected $categoryRepository;

    public function __construct (CategoryRepository $categoryRepository) {
        return $this->categoryRepository = $categoryRepository;
    }

    public function categoryList () {
        $categories = $this->categoryRepository->categoryList();
        if ($categories->isEmpty()) {
            return null;
        }
        return $categories;
    }

    public function categoryCreate ($request) {
        $data = $request->validated();
        return $this->categoryRepository->createCategory($data);
    }

    public function categoryView ($id) {
        $category = $this->categoryRepository->categoryView($id);
        if (!$category) {
            return null;
        }
        return $category;
    }

    public function categoryUpdate ($request , $id) {
        $category = $this->categoryRepository->categoryUpdate($id);
        if (!$category){
            return null;
        }
        $category->update($request->only(['name' , 'description']));
        return $category;
    }

    public function categoryDelete ($id) {
        $category = $this->categoryRepository->categoryDelete($id);
        if (!$category) {
            return null;
        }
        $category->delete();
        return $category;
    }
}