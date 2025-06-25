<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request)
    {
        $name = $request->input('category_name');
        $description = $request->input('category_description');

        // Validate the input data
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'required|string',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('category_image')) {
            $imagePath = $request->file('category_image')->store('categories', 'public');
        }


        $category = new Category();
        $category->name = $name;
        $category->description = $description;
        $category->image = $imagePath;
        $category->save();
        session()->flash('new_category_id', $category->id);

        return redirect()->route('category.list')->with('success', 'Category added successfully!');
    }

    public function listCategories()
    {
        // Sorting
        $allowedSorts = ['name', 'description', 'id'];
        $allowedDirs = ['asc', 'desc'];
        $sort = request('sort', 'id');
        $dir = request('dir', 'desc');
        if (!in_array($sort, $allowedSorts))
            $sort = 'id';
        if (!in_array($dir, $allowedDirs))
            $dir = 'desc';

        $categories = Category::orderBy($sort, $dir)->paginate(6);
        return view('categories.list', compact('categories'));
    }
    public function inlineUpdate(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        if (!in_array($field, ['name', 'description'])) {
            return response()->json(['success' => false, 'message' => 'Invalid field.']);
        }

        $category->$field = $value;
        $category->save();

        return response()->json(['success' => true]);
    }
    public function detail($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.detail', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'required|string',
        ]);
        $category->name = $request->input('category_name');
        $category->description = $request->input('category_description');
        $category->save();

        return redirect()->route('category.detail', $category->id)->with('success', 'Category updated successfully!');
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.list')->with('success', 'Category deleted successfully!');
    }

}
