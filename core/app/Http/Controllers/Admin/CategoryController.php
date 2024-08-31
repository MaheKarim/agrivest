<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Category';
        $categories = Category::searchable(['name'])->orderBy('name')->paginate(getPaginate());

        return view('admin.category.index', compact('pageTitle', 'categories'));
    }

    public function store(Request $request, $id = 0)
    {
        $request->validate([
            'name' => 'required|unique:categories|string|max:255',
        ]);

        if ($id) {
            $category = Category::findOrFail($id);
            $notify[] = ['success', 'Category updated successfully'];
        } else {
            $category = new Category();
            $notify[] = ['success', 'Category added successfully'];
        }

        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.category.index')->withNotify($notify);
    }

    public function status($id)
    {
        return Category::changeStatus($id);
    }
}
