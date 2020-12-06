<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function getCategoryPage(){
        return view('category');
    }
    protected function createCategory(){
        $category =new Category;
        $category->category =request()->category;
        $category->save();
        return 'ok';
    }
    protected function getCategory(){
        $category =Category::paginate(10);
        return response()->json($category);
    }
    protected function editCategory($id){
        $category =Category::find($id);
        return response()->json($category);
    }
    protected function updateCategory(){
        $category =Category::find(request()->id);
        $category->category =request()->category;
        $category->update();
        return 'ok';
    }
    protected function deleteCategory($id){
        $category =Category::find($id)->delete();
        return 'ok';
    }
}
