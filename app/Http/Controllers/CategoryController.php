<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function Symfony\Component\String\b;

class CategoryController extends Controller
{
    //The category page
    public function categoryHandler()
    {
        if (Gate::allows('admin', Auth::user())) {
            $categories = Category::all();
            return view('category', compact('categories'));
        } else {
            return redirect()->route('main');
        }
    }

    //New category page
    public function newCategory()
    {
        if (Gate::allows('admin', Auth::user())) {
            return view('category-new');
        } else {
            return redirect()->route('main');
        }
    }

    //Adds category to database
    public function addCategory(Request $request)
    {
        if (Gate::allows('admin', Auth::user())) {
            $validatedData = $request->validate([
                'category_name' => 'required',
            ]);
            $name = $request->get('category_name');
            if (Category::where('name', $name)->first() == null) {
                Category::create([
                    'name' => $name,
                ]);
                return redirect()->route('category')->with('added', true);
            } else {
                return redirect()->route('category.new')->with('exists', true);
            }
        } else {
            return redirect()->route('main');
        }
    }

    public function addCategoryGet() {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('category');
        } else {
            return redirect()->route('main');
        }
    }

    //Edit category page
    public function edit($id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $category = Category::find($id);
            if ($category == null) {
                return redirect()->route('category')->with('exists', false);
            } else {
                $exists = true;
                return view('category-edit', compact('category', 'exists'));
            }
        } else {
            return redirect()->route('main');
        }
    }

    //Updates the category in database
    public function update(Request $request, $id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $validatedData = $request->validate([
                'category_name' => 'required',
            ]);
            $name = $request->get('category_name');
            $foundCategory = Category::find($id);
            if ($foundCategory == null) {
                return redirect()->route('category')->with('updated', false);
            } else {
                $foundCategory->name = $name;
                $foundCategory->save();
                return redirect()->route('category')->with('updated', true);
            }
        } else {
            return redirect()->route('main');
        }
    }

    public function delete(Request $request)
    {
        if (Gate::allows('admin', Auth::user())) {
            $id = $request->get('cat_id');
            $cat = Category::find($id);
            if ($cat == null) {
                return redirect()->route('category');
            }
            $name = $cat->name;
            $cat->delete();
            return redirect()->route('category')->with('category_deleted', $name);
        } else {
            return redirect()->route('main');
        }
    }

    public function deleteGet()
    {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('category');
        } else {
            return redirect()->route('main');
        }
    }
    public function updateGet()
    {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('category');
        } else {
            return redirect()->route('main');
        }
    }
}
