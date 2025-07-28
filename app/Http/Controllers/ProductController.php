<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class ProductController extends Controller
{
    public function CategoryDrop()
    {
        $categories = Category::all();
        return view('products.register', compact('categories'));
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_code' => 'required|string|max:100|unique:products',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'product_stock' => 'required|integer|min:0',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = new Product();
        $product->name = $request->input('product_name');
        $product->product_code = $request->input('product_code');
        $product->purchase_price = $request->input('purchase_price');
        $product->sale_price = $request->input('sale_price');
        $product->stock = $request->input('product_stock');
        $product->description = $request->input('product_description');
        $product->category_id = $request->input('category_id');

        if ($request->hasFile('category_image')) {
            $path = $request->file('category_image')->store('products', 'public');
            $product->image = $path;
        }


        $product->save();
        session()->flash('new_product_id', $product->id);

        return redirect()->route('product.list')->with('success', 'Product added successfully!');
    }

    public function listProducts(Request $request)
    {
        $sort = $request->query('sort', 'id');
        $dir = $request->query('dir', 'desc');
        $allowedSorts = ['id', 'name', 'purchase_price', 'sale_price', 'stock'];
        $allowedDirs = ['asc', 'desc'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }
        if (!in_array($dir, $allowedDirs)) {
            $dir = 'desc';
        }
        $products = Product::with('category')->orderBy($sort, $dir)->paginate(5);
        $categories = Category::all();
        return view('products.list', compact('products', 'categories', 'sort', 'dir'));
    }


    public function inlineUpdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $field = $request->input('field');
        $value = $request->input('value');

        // Remove currency for numeric fields if exits
        if (in_array($field, ['purchase_price', 'sale_price'])) {
            $value = preg_replace('/[^\d.]/', '', $value); // Remove all non-numeric except dot
        }

        if (!in_array($field, ['name', 'purchase_price', 'sale_price', 'stock'])) {
            return response()->json(['success' => false, 'message' => 'Invalid field.']);
        }

        // For name, trim and validate length
        if ($field === 'name') {
            $value = trim($value);
            if ($value === '' || strlen($value) > 255) {
                return response()->json(['success' => false, 'message' => 'Name is required and must be less than 255 characters.']);
            }
        }

        //  num fields
        if (in_array($field, ['purchase_price', 'sale_price', 'stock'])) {
            if (!is_numeric($value)) {
                return response()->json(['success' => false, 'message' => 'Value must be numeric.']);
            }
        }

        $product->$field = $value;
        $product->save();

        return response()->json(['success' => true]);
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.detail', compact('product', 'categories'));
    }
    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            // Validate the input
            $request->validate([
                'product_name' => 'required|string|max:255',
                'product_description' => 'required|string',
                'purchase_price' => 'required|numeric|min:0',
                'sale_price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
                'stock' => 'required|integer|min:0',
                'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Update product fields
            $product->name = $request->input('product_name');
            $product->description = $request->input('product_description');
            $product->purchase_price = $request->input('purchase_price');
            $product->sale_price = $request->input('sale_price');
            $product->category_id = $request->input('category_id');
            $product->stock = $request->input('stock');


            if ($request->hasFile('product_image')) {
                $imagePath = $request->file('product_image')->store('products', 'public');
                $product->image = $imagePath;
            }

            // Save the product
            $product->save();

            return redirect()->route('product.list')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            \Log::error('Product update failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update product.']);
        }
    }
    public function delete($id)
    {
        $category = Product::findOrFail($id);
        $category->delete();
        return redirect()->route('product.list')->with('success', 'Category deleted successfully!');
    }
}
