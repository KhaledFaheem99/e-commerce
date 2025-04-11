<?php

namespace App\Repositories\Admin\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryRepository extends Controller {

    public function categoryList () {
        return Category::get();
    }

    public function createCategory ($data) {
        return Category::create($data);
    }

    public function categoryView ($id) {
        return Category::find($id);
    }

    public function categoryUpdate ($id) {
        return Category::find($id);
    }

    public function categoryDelete ($id) {
        return Category::find($id);
    }

}