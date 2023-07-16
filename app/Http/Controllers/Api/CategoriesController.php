<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        CategoryResource::wrap('data');//为了和分页数据统一
        return CategoryResource::collection(Category::all());
        // return CategoryResource::collection(Category::paginate());
    }
}
