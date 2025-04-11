<?php

namespace App\Http\Controllers\API\v1\Admin\Categories;

use App\Http\Controllers\ApiResponse\ApiController;
use App\Http\Requests\Category\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\Admin\Categories\CategoryService;

class CategoryController extends ApiController {
    protected $categoryService;

    public function __construct (CategoryService $categoryService) {
        return $this->categoryService = $categoryService;
    }

    public function index () {
        $categories = $this->categoryService->categoryList();
        if (!$categories) {
            return $this->failedResponse('No Categories To Show' , 400);
        }
            return $this->successResponse('Categoris Listed Successfully' , CategoryResource::collection($categories) , 200);
    }

    public function store (CategoryRequest $request) {
        $category = $this->categoryService->categoryCreate($request);
        return $this->successResponse('Category Created Successfully' , $category , 201);
    }

    public function show ($id) {
        $category = $this->categoryService->categoryView($id);
        if (!$category) {
            return $this->failedResponse('Category Is Not Found' , 404);
        }
            return $this->successResponse('Category Is Viewed Successfully' , $category , 200);
    }

    public function update (CategoryRequest $request,$id) {
        $category = $this->categoryService->categoryUpdate($request , $id);
        if (!$category) {
            return $this->failedResponse('Category Is Not Found' , 404);
        }
            return $this->successResponse('Category Updated Is Successfully', $category , 200);
    }

    public function destroy ($id) {
        $category = $this->categoryService->categoryDelete($id);
        if (!$category) {
            return $this->failedResponse('Category Is Not Found' , 404);
        }
            return $this->successResponse('Category Deleted Successfully', $category , 200);
    }
}
