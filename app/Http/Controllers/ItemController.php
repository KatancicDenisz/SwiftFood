<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;

class ItemController extends Controller
{
    public function item() {
        if (Gate::allows('admin', Auth::user())) {
            $items = Item::withTrashed()->get();
            return view('item', compact('items'));
        } else {
            return redirect()->route('main');
        }
    }

    public function new()
    {
        if (Gate::allows('admin', Auth::user())) {
            $categories = Category::all();
            return view('item-new',compact('categories'));
        } else {
            return redirect()->route('main');
        }
    }

    //Adds item to database
    public function storePost(Request $request)
    {
        if (Gate::allows('admin', Auth::user())) {
            $data = $request->validate([
                'item_name' => 'required',
                'item_price' => 'integer|min:1|required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:4096',
                'categories' => 'required_without_all',
                'item_desc' => 'required',
            ],[
                'categories.required_without_all' => 'Legalább egy kategóriát ki kell választani!',
                'item_name.required' => 'Az item nevének megadása kötelező!',
                'item_price.integer' => 'Az item ára szám kell, hogy legyen!',
                'item_price.min' => 'Az item ára legalább 1 kell hogy legyen!',
                'item_price.required' => 'Az item árának megadása kötelező!',
            ],
             );

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $hashName = $file->getClientOriginalName();
                Storage::disk('public')->put('images/'.$hashName, file_get_contents($file));
                $data['image_url'] = $hashName;
            }

            $data['name'] = $request->get('item_name');
            $data['price'] = $request->get('item_price');
            $data['description'] = $request->get('item_desc');


            $createdItem = Item::create($data);
            $createdItem->categories()->attach($request->categories);
            return redirect()->route('item')->with('added', true);
        } else {
            return redirect()->route('main');
        }
    }

    public function storeGet() {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('item');
        } else {
            return redirect()->route('main');
        }
    }

    public function delete(Request $request)
    {
        if (Gate::allows('admin', Auth::user())) {
            $id = $request->get('item_id');
            $item = Item::find($id);
            if ($item == null) {
                return redirect()->route('item');
            }
            $name = $item->name;
            $item->delete();
            return redirect()->route('item')->with('item_deleted', $name);
        } else {
            return redirect()->route('main');
        }
    }

    public function deleteGet()
    {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('item');
        } else {
            return redirect()->route('main');
        }
    }

    public function restore($id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $item = Item::withTrashed()->find($id);
            $name = $item->name;
            $item->restore();
            return redirect()->route('item')->with('item_restored', $name);
        } else {
            return redirect()->route('main');
        }
    }

    public function restoreGet($id) {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('item');
        } else {
            return redirect()->route('main');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $item = Item::find($id);
            $category_ids = [];
            $categories = Category::all();
            if ($item == null) {
                return redirect()->route('item')->with('exists', false);
            } else {
                $category_ids =  $item->categories->pluck('id')->toArray();
                $exists = true;
                return view('item-edit', compact('item', 'exists','category_ids','categories'));
            }
        } else {
            return redirect()->route('main');
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $item = Item::find($id);
            $data = $request->validate([
                'item_name' => 'required',
                'item_price' => 'numeric|min:1|required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:4096',
                'categories' => 'required_without_all',
                'item_desc' => 'required',
            ],[
                'categories.required_without_all' => 'Legalább egy kategóriát ki kell választani!',
                'item_name.required' => 'Az item nevének megadása kötelező!',
                'item_price.integer' => 'Az item ára szám kell, hogy legyen!',
                'item_price.min' => 'Az item ára legalább 1 kell hogy legyen!',
                'item_price.required' => 'Az item árának megadása kötelező!',
                'item_desc.required' => 'Az item leírásának megadása kötelező!',
            ],);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $hashName = $file->getClientOriginalName();
                Storage::disk('public')->put('images/'.$hashName, file_get_contents($file));
                $data['image_url'] = $hashName;
            }

            $data['name'] = $request->get('item_name');
            $data['price'] = $request->get('item_price');
            $data['description'] = $request->get('item_desc');
            $foundItem = Item::find($id);
            if ($foundItem == null) {
                return redirect()->route('item')->with('updated', false);
            } else {
                $item->update($data);
                $item->categories()->sync($request->categories);
                return redirect()->route('item')->with('updated', true);
            }
        } else {
            return redirect()->route('main');
        }
    }

    public function updateGet()
    {
        if (Gate::allows('admin', Auth::user())) {
            return redirect()->route('item');
        } else {
            return redirect()->route('main');
        }
    }

}
